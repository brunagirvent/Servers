//
// TCP server.
//

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
//#include <winsock.h>
#include <winsock.h>
#include <process.h>
//#include <sys/socket.h>
#include <WS2tcpip.h>
#include <unistd.h>
#include <wininet.h>
//#include <netinet/in.h>

#include "msg.h"

/**
 * Handle a client connection.
 *
 * @param sk Socket.
 */
static int
handle_conn(int sk)
{
	// Receive an init message.
	msg m;
	if (recv_data(sk, (char *) &m, sizeof(m))) {
		perror("recv");
		return 1;
	}

	if (m.type != MSG_TYPE_INIT) {
		fprintf(stderr, "ERROR: received invalid message\n");
		return 1;
	}

	int cont = 1;
	while (cont) {
		// Receive a message.
		if (recv_data(sk, (char *) &m, sizeof(m))) {
			fprintf(stderr, "ERROR: unable to receive message\n");
			return 1;
		}

		switch (m.type) {
			case MSG_TYPE_PING:
				fprintf(stderr, "# received ping message [%.*s]\n", m.u.ping.len, m.u.ping.data);

				m.type = MSG_TYPE_PONG;
				if (send_data(sk, (char *) &m, sizeof(m))) {
					perror("send");
					return 1;
				}

				break;

			case MSG_TYPE_EXIT:
				fprintf(stderr, "# received exit message\n");
				cont = 0;
				break;

			default:
				fprintf(stderr, "ERROR: received invalid message\n");
				return 1;
		}
	}

	return 0;
}

/**
 * Main.
 *
 * @param argc Argument count.
 * @param argv Argument vector.
 * @return Zero if successful.
 */
int main(int argc, char **argv)
{
	// Check arguments.
	if (argc < 2) {
		printf("usage: %s <port>\n", argv[0]);
		return 1;
	}

	fprintf(stderr, "# initializing tcp server\n");

	// Create a new server socket.
	int ssk = socket(PF_INET, SOCK_STREAM, 0);
	if (ssk < 0) {
		perror("socket");
		return 1;
	}

	// Reuse address.
	int opt = 1;
	if (setsockopt(ssk, SOL_SOCKET, SO_REUSEADDR, &opt, sizeof(opt)) < 0) {
		perror("setsockopt");
		return 1;
	}

	// Set up bind address.
	struct sockaddr_in addr;
	memset(&addr, 0, sizeof(addr));
	addr.sin_family = PF_INET;
	addr.sin_addr.s_addr = 0x0100007f;
	addr.sin_port = htons(strtoul(argv[1], NULL, 10));

	// Bind address to socket.
	if (bind(ssk, (struct sockaddr *) &addr, sizeof(addr)) < 0) {
		perror("bind");
		return 1;
	}

	// Listen on socket.
	if (listen(ssk, 1) < 0) {
		perror("listen");
		return 1;
	}

	while (1) {
		// Accept a new connection
		socklen_t addr_len = sizeof(addr);
		int sk = accept(ssk, (struct sockaddr *) &addr, &addr_len);
		if (sk < 0) {
			perror("accept");
			break;
		}

		// Handle the client connection.
		handle_conn(sk);
		close(sk);
	}

	// Close the server socket
	close(ssk);

	return 0;
}

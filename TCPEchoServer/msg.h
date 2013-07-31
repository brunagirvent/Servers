//
// Message definitions.
//

#ifndef MSG_H
#define MSG_H

/**
 * Message type.
 */
typedef enum {
	MSG_TYPE_INIT = 1,
	MSG_TYPE_PING,
	MSG_TYPE_PONG,
	MSG_TYPE_EXIT,
	MSG_TYPE_MAX,
} msg_type;

/**
 * Message data.
 */
typedef struct {
	uint8_t len;
	char data[256];
} __attribute__((packed)) msg_data;

/**
 * Message.
 */
typedef struct {
	msg_type type;
	union {
		msg_data ping;
		msg_data pong;
	} u;
} __attribute__((packed)) msg;

/**
 * Send all data.
 *
 * @param sk Socket.
 * @param buf Buffer.
 * @param len Length.
 * @return Zero if successful.
 */
static ssize_t
send_data(int sk, const char *buf, const size_t len) {
	size_t sent = 0;
	while (sent < len) {
		ssize_t ret = send(sk, buf + sent, len - sent, 0);
		if (ret < 0)
			return 1;
		sent += ret;
	}

	return 0;
}

/**
 * Receive all data.
 *
 * @param sk Socket.
 * @param buf Buffer.
 * @param len Length.
 * @return Zero if successful.
 */
static ssize_t
recv_data(int sk, char *buf, const size_t len) {
	ssize_t recvd = 0;
	while (recvd < len) {
		ssize_t ret = recv(sk, buf + recvd, len - recvd, 0);
		if (ret < 0)
			return 1;
		recvd += ret;
	}

	return 0;
}

#endif // MSG_H

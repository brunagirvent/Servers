Functions to adapt an streaming video server to the iPhone's HTTP Streaming Protocol. 

-adaptVideoMultirate: codes the video in 3 qualities (high, std, low) to play on the iPhone depending on the network's speed. 

-adaptVideoiPhone: adapt the video to the HTTP Streaming Protocol. Divides the video on frames and generate the headers. 

-generateXML: connects to the SQL database and generates an XML file containing all the videos metadata and videos locations. 

-medatata.xml: example of the file containing all the metadata from the database. The file is parsed on the iPhone to read the metadata, generate categories and colums and know the video's location in the server. 
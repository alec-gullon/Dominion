let Request = require('request');

// Set a title to identify the process
process.title = 'node-chat';

// Server port
let port = 1337;

// record of currently connected clients (users)
let clients = [];

/**
 * We will use the HTTP server to support our WebSocket server
 */
let http = require('http');
let httpServer = http.createServer(function(request, response) {});

httpServer.listen(port, function() {
    console.log((new Date()) + " Server is listening on port " + port);
});

/**
 * We now extend the http server to include WebSocket functionality
 */
let webSocket = require('websocket').server;
let webSocketServer = new webSocket({httpServer: httpServer});

webSocketServer.on('request', function(request) {

    // @todo check request.origin to ensure the connection is coming from the right place
    let connection = request.accept(null, request.origin);
    connection.id = Math.random().toString(36).substring(7);
    clients.push(connection);

    connection.on('message', function(message) {
        message = JSON.parse(message.utf8Data);

        if (message.setGuid) {
            connection.guid = message.data.guid;
        }

        Request.post(
            {
                url: 'http://localhost:8000' + message.route,
                form: message.data
            },
            function (error, response, body) {
                try {
                    body = JSON.parse(body);
                } catch(e) {
                    let ts = new Date();
                    console.log(ts.toGMTString());
                    console.log('Something went wrong, saving error to file');

                    const fs = require('fs');
                    fs.writeFile('error.log', body, function(err) {
                        if (err) {
                            return console.log(err);
                        }
                    })
                    return;
                }

                if (message.route === '/user/set-name/') {
                    connection.guid = body.guid;
                }

                if (body.distributedResponse) {
                    for (let i = 0; i < body.responses.length; i++) {
                        for (let j = 0; j < clients.length; j++) {
                            if (clients[j].guid === body.responses[i].guid) {
                                let response = JSON.stringify(body.responses[i].response);
                                clients[j].sendUTF(response);
                            }
                        }
                    }
                } else {
                    let json = JSON.stringify(body);
                    connection.sendUTF(json);
                }
            }
        );
    });

    connection.on('close', function() {
        let index = null;
        for (let j = 0; j < clients.length; j++) {
            if (connection.id === clients[j].id) {
                index = j;
                break;
            }
        }
        clients.splice(index,1);
    });
});
// On page load, set up a connection to the websocket server

import InboundRouter from './routers/InboundRouter.js';
import OutboundRouter from './routers/OutboundRouter.js';

export default function setupWebSocketConnection() {
    window.WebSocket = window.WebSocket || window.MozWebSocket;

    let connection = new WebSocket('ws://127.0.0.1:1337');
    window.dominion.connection = connection;

    connection.onopen = function() {
        let message = new OutboundRouter(window.dominion.route).message();
        connection.send(JSON.stringify(message));
    };

    connection.onmessage = function (message) {
        try {
            message = JSON.parse(message.data);
            let controller = new InboundRouter(message.action, message);
            controller.respond();
        } catch (e) {
            console.log(e);
        }
    };
}
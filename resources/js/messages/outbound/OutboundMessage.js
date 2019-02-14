export default class OutboundMessage {

    send(route, data) {
        window.dominion.connection.send(route, data);
    }

}
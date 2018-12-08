import Game from '../messages/inbound/Game.js';

export default class InboundRouter {

    constructor(route, message) {
        this.route = route;
        this.message = message;
        this.routes = {
            'home': 'Game@default',
            'refreshView': 'Game@refreshView'
        }
    }

    respond() {
        let method = 'Game@refreshView';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }

        let parts = method.split('@');

        let controller = new Game(this.message);
        return controller[parts[1]]();
    }

}
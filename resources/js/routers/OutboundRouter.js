import Game from '../messages/outbound/Game.js';

export default class OutboundRouter {

    constructor(route) {
        this.route = route;
        this.routes = {
            'refreshView': 'Game@default',
            'publicGameJoin': 'Game@publicGameJoin'
        }
    }

    message() {
        let method = 'Game@default';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }

        let parts = method.split('@');

        let controller = new Game();
        return controller[parts[1]]();
    }

}
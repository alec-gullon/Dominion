export default class Router {

    constructor(route, message) {
        this.route = route;
        this.message = message;
        this.routes = {
            'outbound': {
                'home': 'Game@default',
                'public-game-join': 'Game@publicGameJoin'
            },
            'inbound': {
                '': ''
            }
        }
    }

    message() {
        let method = 'default';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }
        return this[method]();
    }

}
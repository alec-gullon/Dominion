export default class InitialMessageRouter {

    constructor(route) {
        this.route = route;
        this.routes = {
            'home': 'Game@default',
            'public-game-join': 'Game@publicGameJoin'
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
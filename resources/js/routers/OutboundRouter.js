import Home from '../messages/outbound/Home.js';
import Game from '../messages/outbound/Game.js';
import User from '../messages/outbound/User.js';

export default class OutboundRouter {

    constructor(route) {
        this.route = route;
        this.routes = {
            'home': 'Home@refresh',
            'submitName': 'User@submitName',
            'createGame': 'Game@create',
            'joinGameIfPossible': 'Game@joinIfPossible',
            'submitNameThenJoin': 'Game@submitNameThenJoin',
            'joinGame': 'Game@join'
        }
        this.classMap = {
            'Home': Home,
            'Game': Game,
            'User': User
        }
    }

    message() {
        let method = 'Game@default';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }

        let parts = method.split('@');

        console.log(parts[0]);
        console.log(parts[1]);

        let controller = new this.classMap[parts[0]]();
        return controller[parts[1]]();
    }

}
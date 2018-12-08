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
            'joinGame': 'Game@join',
            'playTreasure': 'Game@playTreasure',
            'buyCard': 'Game@buyCard',
            'endTurn': 'Game@endTurn',
            'playCard': 'Game@playCard'
        };
        this.classMap = {
            'Home': Home,
            'Game': Game,
            'User': User
        }
    }

    message(data) {
        let method = 'Game@default';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }

        let parts = method.split('@');

        let controller = new this.classMap[parts[0]]();
        return controller[parts[1]](data);
    }

}
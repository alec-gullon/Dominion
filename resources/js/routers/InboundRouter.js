import Game from '../messages/inbound/Game.js';
import Home from '../messages/inbound/Home.js';
import User from '../messages/inbound/User.js';

export default class InboundRouter {

    constructor(route, message) {
        this.route = route;
        this.message = message;
        this.routes = {
            'home': 'Game@default',
            'refreshView': 'Home@refresh',
            'setGuid': 'User@setGuid',
            'joinGameAfterSettingName': 'User@joinGameAfterSettingName'
        }
        this.classMap = {
            'Home': Home,
            'Game': Game,
            'User': User
        }
    }

    respond() {
        let method = 'Game@refreshView';
        if (this.routes[this.route]) {
            method = this.routes[this.route];
        }

        let parts = method.split('@');

        console.log(parts[0]);
        console.log(parts[1]);

        let controller = new this.classMap[parts[0]](this.message);
        return controller[parts[1]]();
    }

}
import refreshBindings from "../game";

export default class OnMessageRouter {

    constructor(message) {
        this.message = message;
    }

    respond() {
        if (this.message.action === 'refreshView') {
            document.getElementById('root').innerHTML = this.message.view;
            refreshBindings();
        }

        if (this.message.action === 'setGuid') {
            window.cookies.set('guid', this.message.guid);
        }

        if (this.message.action === 'joinedGame') {
            window.cookies.set('guid', this.message.guid);
            setTimeout(function() {
                let message = {
                    route: "/user/join-game/",
                    data: {
                        guid: window.cookies.get('guid'),
                        gameHash: window.dominion.gameHash
                    },
                    setGuid: true
                };
                connection.send(JSON.stringify(message));
                document.location.pathname = '/';
            }, 1000);
        }
    }

}
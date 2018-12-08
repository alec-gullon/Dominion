import refreshBindings from "../../game";

export default class Game {

    constructor(message) {
        this.message = message;
    }

    refreshView() {
        document.getElementById('root').innerHTML = this.message.view;
        refreshBindings();
    }

    setGuid() {
        window.cookies.set('guid', this.message.guid);
    }

    joinedGame() {
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
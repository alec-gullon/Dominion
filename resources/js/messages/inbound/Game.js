export default class Game {

    constructor(message) {
        this.message = message;
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
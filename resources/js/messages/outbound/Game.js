import $ from "jquery";

export default class Game {

    create() {
        let message = {
            route: "/game/create/",
            data: {
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    createAIGame() {
        let message = {
            route: "/game/create-ai-game/",
            data: {
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    joinIfPossible() {
        if (window.cookies.get('guid') === null) {
            let message = {
                route: "/user/get-name-form/",
                data: {},
            };
            window.dominion.connection.send(JSON.stringify(message));
        } else {
            this.join();
        };
    }

    join() {
        let message = {
            route: "/user/join-game/",
            data: {
                guid: window.cookies.get('guid'),
                gameHash: window.dominion.gameHash
            },
            setGuid: true
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    submitNameThenJoin() {
        let message = {
            route: "/user/set-name/",
            data: {
                name: $('#submit-name--name').val(),
                responseAction: 'joinGameAfterSettingName'
            }
        }
        window.dominion.connection.send(JSON.stringify(message));
    }

    playTreasure(treasureStub) {
        let message = {
            route: "/game/update/",
            data: {
                action: 'play-treasure',
                input: treasureStub,
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    buyCard(cardStub) {
        let message = {
            route: '/game/update',
            data: {
                action: 'buy',
                input: cardStub,
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    endTurn() {
        let message = {
            route: '/game/update',
            data: {
                action: 'end-turn',
                input: null,
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    playCard(cardStub) {
        let message = {
            route: '/game/update/',
            data: {
                action: 'play-card',
                input: cardStub,
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

    provideInput(input) {
        let message = {
            route: '/game/update/',
            data: {
                action: 'provide-input',
                input: input,
                guid: window.cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    }

}
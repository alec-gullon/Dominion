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
        console.log('joining');
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

}
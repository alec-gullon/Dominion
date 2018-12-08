import $ from "jquery";

export default class User {

    submitName() {
        let message = {
            route: "/user/set-name/",
            data: {
                name: $('#submit-name--name').val(),
                responseAction: 'setGuid'
            }
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
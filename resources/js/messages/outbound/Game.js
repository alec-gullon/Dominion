export default class Game {

    default() {
        if (typeof window.cookies.get('guid') === 'undefined') {
            return {
                route: "/user/get-name-form/",
                data: {},
            };
        }
        return {
            route: "/user/refresh-page/",
            data: {
                guid: window.cookies.get('guid')
            },
            setGuid: true
        };
    }

    joinGame() {
        if (typeof window.cookies.get('guid') === 'undefined') {
            return {
                route: "/user/get-name-form/",
                data: {},
            };
        }
        return {
            route: "/user/join-game/",
            data: {
                guid: window.cookies.get('guid'),
                gameHash: window.dominion.gameHash
            },
            setGuid: true
        };
    }

}
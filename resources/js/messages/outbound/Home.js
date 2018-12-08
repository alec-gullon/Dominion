export default class Home {

    refresh() {
        let message = {};
        if (window.cookies.get('guid') === null) {
            message = {
                route: "/user/get-name-form/",
                data: {},
            };
        } else {
            message = {
                route: "/user/refresh-page/",
                data: {
                    guid: window.cookies.get('guid')
                },
                setGuid: true
            }
        }
        window.dominion.connection.send(JSON.stringify(message));
    }

    // joinGame() {
    //     if (typeof window.cookies.get('guid') === 'undefined') {
    //         return {
    //             route: "/user/get-name-form/",
    //             data: {},
    //         };
    //     }
    //     return {
    //         route: "/user/join-game/",
    //         data: {
    //             guid: window.cookies.get('guid'),
    //             gameHash: window.dominion.gameHash
    //         },
    //         setGuid: true
    //     };
    // }

}
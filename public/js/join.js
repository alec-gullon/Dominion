// On page load, set up a connection to the websocket server
window.WebSocket = window.WebSocket || window.MozWebSocket;

var connection = new WebSocket('ws://127.0.0.1:1337');

connection.onopen = function () {
    if (typeof Cookies.get('guid') === 'undefined') {
        let message = {
            route: "/user/get-name-form/",
            data: {},
        };
        connection.send(JSON.stringify(message));
    } else {
        let message = {
            route: "/user/join-game/",
            data: {
                guid: Cookies.get('guid'),
                gameHash: window.dominion.gameHash
            },
            setGuid: true
        };
        connection.send(JSON.stringify(message));
    }
};

connection.onmessage = function (message) {
    try {
        message = JSON.parse(message.data);

        if (message.view) {
            document.getElementById('root').innerHTML = message.view;
            refreshBindings();
        }

        if (message.joinedGame) {
            Cookies.set('guid', message.guid);
            setTimeout(function() {
                let message = {
                    route: "/user/join-game/",
                    data: {
                        guid: Cookies.get('guid'),
                        gameHash: window.dominion.gameHash
                    },
                    setGuid: true
                };
                connection.send(JSON.stringify(message));
                document.location.pathname = '/';
            }, 1000);
        }
    } catch (e) {
        console.log(e);
    }
};

function refreshBindings() {
    $('#submit-name').click(function() {
        let message = {
            route: "/user/set-name/",
            data: {
                name: $('#submit-name--name').val()
            }
        };
        connection.send(JSON.stringify(message));
    });
    $('#start-game').click(function() {
        let message = {
            route: "/game/create/",
            data: {
                guid: Cookies.get('guid')
            }
        };
        connection.send(JSON.stringify(message));
    })
}

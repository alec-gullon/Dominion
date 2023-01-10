import $ from "jquery";
import OutboundMessage from './OutboundMessage';

export default class Game extends OutboundMessage {

    send(route, data) {
        window.dominion.connection.send(route, data);
    }

    new() {
        if (window.cookies.get('guid') === null) {
            this.send('user/name-form', {});
        } else {
            let data =  {
                guid: window.cookies.get('guid')
            };
            this.send('user/player-lobby', data);
        }
    }

    create() {
        let data = {
            guid: window.cookies.get('guid')
        };
        this.send('game/create', data);
    }

    createAIGame() {
        let data = {
            guid: window.cookies.get('guid')
        };
        this.send('game/create/ai', data);
    }

    joinIfPossible() {
        if (window.cookies.get('guid') === null) {
            this.send('user/name-form', {});
        } else {
            this.join();
        }
    }

    join() {
        let data = {
            guid: window.cookies.get('guid'),
            gameHash: window.dominion.gameHash,
            setGuid: true
        };
        this.send('user/join-game', data);
    }

    submitNameThenJoin() {
        let data = {
            name: $('#submit-name--name').val(),
            responseAction: 'joinGameAfterSettingName'
        };
        this.send('user/set-name', data);
    }

    playTreasure(treasureStub) {
        let data = {
            action: 'play-treasure',
            input: treasureStub,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    buyCard(cardStub) {
        let data = {
            action: 'buy',
            input: cardStub,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    endTurn() {
        let data = {
            action: 'end-turn',
            input: null,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    playCard(cardStub) {
        let data = {
            action: 'play-card',
            input: cardStub,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    provideInput(input) {
        let data = {
            action: 'provide-input',
            input: input,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    submitChoice(input) {
        let data = {
            action: 'provide-input',
            input: input,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    submitChoices(input) {
        let data = {
            action: 'provide-input',
            input: input,
            guid: window.cookies.get('guid')
        };
        this.send('game/update', data);
    }

    playAllTreasures() {
        let data = {
            action: 'play-all-treasures',
            input: null,
            guid: window.cookies.get('guid')
        }
        this.send('game/update', data);
    }

}

import refreshBindings from "../../game/bindings/index.js";
import OutboundRouter from './../../routers/OutboundRouter.js';

export default class User {

    constructor(message) {
        this.message = message;
    }

    setGuid() {
        document.getElementById('root').innerHTML = this.message.view;
        refreshBindings();
        window.cookies.set('guid', this.message.guid);
    }

    joinGameAfterSettingName() {
        window.cookies.set('guid', this.message.guid);

        new OutboundRouter('joinGame').message();
    }
}
import refreshBindings from "../../game/bindings/index.js";

export default class Home {

    constructor(message) {
        this.message = message;
    }

    refresh() {
        document.getElementById('root').innerHTML = this.message.view;
        refreshBindings();
    }
}
import $ from "jquery";
import OutboundMessage from './OutboundMessage';

export default class User extends OutboundMessage {

    submitName() {
        let data =  {
            name: $('#submit-name--name').val(),
            responseAction: 'setGuid'
        };
        this.send('user/set-name', data);
    }

    submitNameThenJoin() {
        let data = {
            name: $('#submit-name--name').val(),
            responseAction: 'joinGameAfterSettingName'
        };
        this.send('user/set-name', data);
    }

}

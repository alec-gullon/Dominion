import OutboundMessage from './OutboundMessage';

export default class Home extends OutboundMessage {

    refresh() {
        if (window.cookies.get('guid') === null) {
            this.send('user/name-form', {});
        } else {
            let data =  {
                guid: window.cookies.get('guid')
            };
            this.send('user/refresh-page', data);
        }
    }

}
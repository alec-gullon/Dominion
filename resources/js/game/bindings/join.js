import $ from 'jquery';
import OutboundRouter from './../../routers/OutboundRouter.js';

export default function refreshBindings() {

    $('.join-root').find('.submit-name').click(function() {
        new OutboundRouter('submitNameThenJoin').message();
    });

}
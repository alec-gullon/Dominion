import $ from 'jquery';
import OutboundRouter from './../../routers/OutboundRouter.js';

export default function refreshBindings() {

    $('.home-root').find('.submit-name').click(function() {
        $(this).addClass('loading');
        new OutboundRouter('submitName').message();
    });

    $('.home-root').find('[data-action="start-game"]').click(function() {
        new OutboundRouter('createGame').message();
    });

    $('.home-root').find('.submit-card').click(function() {
        let message = {
            route: "/game/update/",
            data: {
                guid: Cookies.get('guid'),
                action: 'play-treasure',
                input: 'copper'
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    });

    $('.home-root').find('[data-action="start-ai-game"]').click(function() {
        $(this).addClass('loading');
        new OutboundRouter('createAIGame').message();
    })

}
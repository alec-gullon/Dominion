import $ from 'jquery';
import OutboundRouter from './../../routers/OutboundRouter.js';

export default function refreshBindings() {

    $(document).ready(function(){
        $('.card').hover(function(){
            $(this).mousemove(function(event) {
                $(this).find('.card__description').css({
                    top: event.pageY + 3,
                    left: event.pageX + 3
                });
            });
        });
        $('.card').mouseenter(function(){
            $(this).find('.card__description').show();
        });
        $('.card').mouseleave(function(){
            $(this).find('.card__description').hide();
        });
    });

    $('.home-root').find('.submit-name').click(function() {
        $(this).addClass('is-loading');
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
        new OutboundRouter('createAIGame').message();
    })

}
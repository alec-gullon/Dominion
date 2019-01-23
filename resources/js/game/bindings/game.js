import $ from 'jquery';
import OutboundRouter from './../../routers/OutboundRouter.js';

export default function refreshBindings() {

    $('.game-root').find('[data-action="play-treasure"]').click(function() {
        new OutboundRouter('playTreasure').message($(this).data('stub'));
    });

    $('.game-root').find('[data-action="buy-card"]').click(function() {
        new OutboundRouter('buyCard').message($(this).data('stub'));
    });

    $('.game-root').find('[data-action="end-turn"]').click(function() {
        new OutboundRouter('endTurn').message();
    });

    $('.game-root').find('[data-action="play-card"]').click(function() {
        new OutboundRouter('playCard').message($(this).data('stub'));
    });

    $('.game-root').find('[data-action="select-option"]').click(function() {
        new OutboundRouter('provideInput').message($(this).data('stub'));
    });

}
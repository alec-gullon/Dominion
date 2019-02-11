import $ from 'jquery';
import OutboundRouter from './../../routers/OutboundRouter.js';

export default function refreshBindings() {

    $('.game-root').find('[data-action="play-treasure"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('playTreasure').message($(this).data('stub'));
        }
    });

    $('.game-root').find('[data-action="buy-card"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('buyCard').message($(this).data('stub'));
        }
    });

    $('.game-root').find('[data-action="end-turn"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('endTurn').message();
        }
    });

    $('.game-root').find('[data-action="play-card"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('playCard').message($(this).data('stub'));
        }
    });

    $('.game-root').find('[data-action="select-option"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('submitChoice').message($(this).data('option'));
        }
    });

}

function sendMessageIfNotBusy(object) {
    if (window.dominion.messageInProgress) {
        return false;
    }
    window.dominion.messageInProgress = true;
    $(object).addClass('active');
    return true;
}
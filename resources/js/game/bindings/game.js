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

    $('.game-root').find('[data-action="submit-choices"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            let choices = [];
            $(this).parent().children('.player-area-option').each(function() {
                if ($(this).is(':checked')) {
                    choices.push($(this).data('option'));
                }
            });
            new OutboundRouter('submitChoices').message(choices);
        }
    });

}

function sendMessageIfNotBusy(object) {
    if (window.dominion.messageInProgress) {
        return false;
    }
    window.dominion.messageInProgress = true;
    $(object).addClass('--loading');
    return true;
}
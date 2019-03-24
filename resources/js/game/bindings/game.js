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
            $(this).parent().parent().find('.__input').each(function() {
                if ($(this).prop('checked')) {
                    choices.push($(this).data('option'));
                }
            });
            new OutboundRouter('submitChoices').message(choices);
        }
    });

    $('.game-root').find('[data-action="play-all-treasures"]').click(function() {
        if (sendMessageIfNotBusy($(this))) {
            new OutboundRouter('playAllTreasures').message();
        }
    });

    $('.game-root').find('.__kingdom-card-name').mousemove(function(event) {
        let description = $(this).siblings('.__kingdom-card-description');
        description.show();
        description.css('left', event.pageX+5);
        description.css('top', event.pageY+5-$(document).scrollTop());
    });

    $('.game-root').find('.__kingdom-card-name').mouseleave(function() {
        let description = $(this).siblings('.__kingdom-card-description');
        description.hide();
    });

    $('.common-card').find('.__letter').mousemove(function(event) {
        let description = $(this).siblings('.__common-card-description');
        description.show();
        description.css('left', event.pageX+5);
        description.css('top', event.pageY+5-$(document).scrollTop());
    });

    $('.common-card').find('.__letter').mouseleave(function() {
        let description = $(this).siblings('.__common-card-description');
        description.hide();
    });

    $('.game-root').find('.militia-discard-options').each(function() {
        let militiaDiscardOptions = $(this);
        let submit = $(this).find('[data-action="submit-choices"]');

        $(this).find('.__input').each(function() {
            $(this).click(function() {
                let uncheckedOptions = 0;
                militiaDiscardOptions.find('.__input').each(function() {
                    if (!$(this).is(':checked')) {
                        uncheckedOptions++;
                    }
                });

                if (uncheckedOptions === 3) {
                    submit.show();
                } else {
                    submit.hide();
                }
            });
        });
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
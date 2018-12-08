import $ from 'jquery';

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

    $('#submit-name').click(function() {
        let message = {
            route: "/user/set-name/",
            data: {
                name: $('#submit-name--name').val()
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    });

    $('#start-game').click(function() {
        let message = {
            route: "/game/create/",
            data: {
                guid: Cookies.get('guid')
            }
        };
        window.dominion.connection.send(JSON.stringify(message));
    });

    $('.submit-card').click(function() {
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

}
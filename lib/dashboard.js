$(document).ready(main);

function main() {
    pg_card_animation();
}

function pg_card_animation() {
    $(".progress-card").on('mouseover',function () {

        $(this).parent().on('mouseover',function(){
            $(this).css({ 'color': '#582f21'})
        });

        $(this).addClass('animated pulse');
    }).on('mouseout',function(){
        $(this).removeClass('animated pulse');
    });
}
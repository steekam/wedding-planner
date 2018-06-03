function main() {
    $("input[type = 'text']").attr('autocomplete','off');

    //Animation feature for the labels on the forms
    $("input").on("keyup", function(){
        $(this).removeAttr("placeholder");
        var label = $("label[for='" + $(this).attr('id') + "']");
        label.slideDown(50);
    });

    $("input").focusout(function () {
        var value = $(this).val();
        
        if (!value) {
            var label = $("label[for='" + $(this).attr('id') + "']");
            $(this).attr("placeholder", label);
            console.log($(this).attr("placeholder", label.html()));
            label.slideUp(1);
        }
                
    });

    //Switch to sign up form
    $("#btn-signUp").click(function () {
        window.location.href = "signup.html";
    });

    //Switch to login form
    $("#btn-login").click(function () {
        window.location.href = "login.html";
    });

    // Adding a slider to the home page
    $('#slider').vegas({
        overlay: false,
        transition: ['slideLeft','slideLeft2','slideRight','zoomOut'],
        transitionDuration: 'auto',
        delay: 5000,
        animation: 'random',
        animationDuration: 'auto',
        timer: false,
        shuffle: true,
        slides: [
            { src: 'assets/image/slider/bride-groom-forehead-kiss.jpg' },
            { src: 'assets/image/slider/bride-groom-shoes.jpg' },
            { src: 'assets/image/slider/bride-sitted.jpg' },
            { src: 'assets/image/slider/dancing-party.jpg' },
            { src: 'assets/image/slider/dining-setting.jpg' },
            { src: 'assets/image/slider/groom-bowtie.jpg' },
            { src: 'assets/image/slider/groomsman-suits.jpg' },
            { src: 'assets/image/slider/just-married-golfcart.jpg'}
        ]
    });

    //Animation on the nav items
    $("nav").children().addClass("animated flipInX pulse");

    
    //Pull down effect
    var mainContent_offset = $("#main-content").offset();
    $("#down-arrow").click( ()=>{
        $("html, body").animate({
            scrollTop: mainContent_offset.top+20
        }, "slow");
    });

    //Adding some space to the social icons
    $("#social-icons").children().css({
        "margin-right" : "10px"
    });     
    
}

$(document).ready(main);
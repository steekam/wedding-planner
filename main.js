$(document).ready(main);

function main() {

    //Getting the current page
    var href = document.location.href;
    var current_page = href.substr(href.lastIndexOf('/') + 1);
    console.log("Current page: "+current_page);
    

    $("input[type = 'text']").attr('autocomplete','off');

    //Animation feature for the labels on the forms
    $("#signup>input,#login>input").on("keyup", function(){
        $(this).removeAttr("placeholder");
        var label = $("label[for='" + $(this).attr('id') + "']");
        label.slideDown(50);
    });

    $("#signup>input,#login>input").focusout(function () {
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
        window.location.href = "signup.php";
    });

    //Switch to login form
    $("#btn-login").click(function () {
        window.location.href = "login.php";
    });

    if (current_page.includes("index.php") ) {
        theIndexPage();
    }else if (current_page == "account-setup.php") {
        theaccountSetup();
    } else if (current_page == "signup.php"){
        signUpPage();
    }
    
    
}

function signUpPage(){

    $("#signup-submit").click(function(e){
        var pass1 = $("#password-sign").val();
        var pass2 = $("#confirm-password").val();       
        
        
        if (!passwordMatch(pass1,pass2)) {
            e.preventDefault();
            var response = '<div class="alert alert-danger alert-dismissible container-fluid">Passwords do not match' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '<span>&times;</span ></button > </div >';
            $("#error").html(response);
        }        
    });
   
}

//Check if element is in the viewport
$.fn.isInViewport = function () {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

function passwordMatch(pass1,pass2){
    if (pass1 == pass2) {
        return true;
    }
    return false;
}

function theIndexPage(){
    $('#slider').vegas({
        overlay: false,
        transition: ['slideLeft', 'slideLeft2', 'slideRight', 'zoomOut'],
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
            { src: 'assets/image/slider/just-married-golfcart.jpg' },
            { src: 'assets/image/slider/retro-rolls.jpg' },
            { src: 'assets/image/slider/beachfront.jpg' },
            { src: 'assets/image/slider/church-aisle.jpg' },
            { src: 'assets/image/slider/table-setting.jpg' }
        ]
    });

    //Animation on the nav items
    $("nav").children().addClass("animated flipInX pulse");


    //Pull down effect
    var mainContent_offset = $("#main-content").offset();
    $("#down-arrow").click(() => {
        $("html, body").animate({
            scrollTop: mainContent_offset.top + 10
        }, "slow");
    });

    //Scroll to top
    var window_offset = $("body").offset();
    $("#up").click(() => {
        $("html, body").animate({
            scrollTop: window_offset.top
        }, "slow");
    });

    //Change nav-bar background
    var break_point = ($("#cover-content").offset().top - 70);
    $(window).scroll(function () {
        var scrollPos = $(document).scrollTop();

        if (scrollPos >= break_point) {
            $("#main-nav").addClass("bg-change");
        } else {
            $("#main-nav").removeClass("bg-change");
        }
    });


    //Adding some space to the social icons
    $("#social-icons").children().css({
        "margin-right": "10px"
    });

}

function theaccountSetup(){
    $("#header").click(function (){
        window.location.href = "index.php";
    });

    //Check fields are not empty after focus out
    var empty_fields = true;    
    $('fieldset>input[type="text"],input[type="date"]').on('keyup change keypress blur', function () {
        var current = $(this);
        if (!current.val()) {
            empty_fields = true;
            current.attr('style', 'border:2px solid red;');
        } else {
            empty_fields = false;
            current.removeAttr("style");
        }
    });
    
    

    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

     $('#msform').on('click','.next',function () {
         console.log(empty_fields);
         
         //Show warning to users
         current_fs = $(this).parent();
         current_fs.find('input[type="text"],input[type="date"]').each(function (index) {
            if (!$(this).val()) {
                $(this).attr('style', 'border:2px solid red;');
            }
        });

        if (animating || empty_fields) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();       

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({ 'left': left, 'opacity': opacity });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
                empty_fields =true;
            }
        });
          
    });
    

    $(".previous").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'left': left });
                previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            }
        });
    });

    $('fieldset>select').on('keyup change keypress blur', function () {
        var current = $(this).find(':selected');        
        if (current.text() == "Select") {
            empty_fields = true;
            current.parent().attr('style', 'border:2px solid red;');
        } else {
            empty_fields = false;
            current.parent().removeAttr("style");
        }
    });

    $("#msform").on('click', '.submit',function () {
        current_fs = $(this).parent();
        
        current_fs.find('select').each(function (index) {
            var current_select = $(this).find(':selected')
            if (current_select.text() == "Select") {
                $(this).attr('style', 'border:2px solid red;');
                return false;                
            }
        });
    });

}
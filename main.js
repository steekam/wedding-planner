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
       $("title").html("SIGN UP | WEDDING WIRE");
       $("#login").hide();
       $("#btn-signUp").hide();
       $("#btn-login").show();
       $("#signup").show(); 
    }); 
    //Switch to login form
    $("#btn-login").click(function () {
        $("title").html("LOGIN | WEDDING WIRE");
        $("#signup").hide();
        $("#btn-login").hide();
        $("#btn-signUp").show();
        $("#login").show();
    }); 
}

$(document).ready(main);


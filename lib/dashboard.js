$(document).ready(main);

function main() {
    pg_card_animation();

    fillDetails();

    checklistProgress();
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

function fillDetails(){
    //Fetch details 
    var details;
    $.post('account/settings/load_profile.php',{"valid":"true"},function(data){
        details = data;
    },'JSON').done(function(){
        //Display the details
        $('#user_lastname').text(details['last_name']);
        $('#partner_lastname').text(details['partner_lastname']);
        $('#wedding_date').text(details['wedding_date']);
        
                
    });
}

function checklistProgress() {
    var details;
    $.post('progress/checklist_prog.php',{"valid":"true"},function(data){
        details = data;
    }).done(function(){
        $("#perc_completed").text(details);
    });
}
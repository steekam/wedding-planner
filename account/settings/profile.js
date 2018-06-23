$(document).ready(function(){

    loadProfille();
    toggleChangeEmail();
    personalSave();
    weddingSave();
    emailSave();
    passwordSave();
    deleteAccount();
});

function toggleChangeEmail() {
    $(".changeEmail").hide();
    $("#editEmail").on('click',function(){
        $(".changeEmail").show();
        $(".curr").hide();
    });
    $("#cancelChange").on('click',function(e){
        e.preventDefault();
        $(".changeEmail").hide();
        $(".curr").show();
    });
}

function loadProfille() {
    //Fill in the profile details
    $.post("load_profile.php",{"valid":true},function(data){
        $("#currentEmail").val(data['email']);
        $("#username").val(data['username']);
        $("#ufirst_name").val(data['first_name']);
        $("#ulast_name").val(data['last_name']);
        $("#pfirst_name").val(data['partner_firstname']);
        $("#plast_name").val(data['partner_lastname']);
        $("#urole").val(data['user_role']);
        $("#prole").val(data['partner_role']);
        $("#engagementDate").val(data['proposal_date']);
        $("#weddingDate").val(data['wedding_date']);
        $("#guests").val(data['guest_range']);
        $("#budget").val(data['budget_range']);

    },"JSON").fail(function(){
        console.log("Error in fetch");
    });
}

function personalSave() {
    var messageDiv = $("#personalSave").parent().prev();

    $("#personalSave").on('click',function(e){
        e.preventDefault();
        var personalForm = $(this).parent();
        var send = personalForm.serializeArray();
        send.push({"name":"valid","value":true});
        
        var message = "";
        $.post("update_personal.php",send,function(data){
            
            message = '<div class="message alert alert-dismissable alert-success" role="alert">'+
                        '<button class="close" data-dismiss="alert" aria-label="Close">'+
                          '<span aria-hidden="true">×</span>'+
                        '</button>'+data+
                      '</div>';
            messageDiv.html(message);

        }).fail(function(){
            console.log("Error in update");
        }).done(function(){
            messageDiv.fadeIn(300).delay(5000).fadeOut(300);                        
        });
        
    });
}

function weddingSave(){
    var messageDiv = $("#weddingSave").parent().prev();
    $("#weddingSave").on('click',function(e){
        e.preventDefault();
        var weddingForm =$(this).parent();
        var send = weddingForm.serializeArray();
        send.push({ "name": "valid", "value": true });

        var message = "";
        $.post("update_wedding.php", send, function (data) {
            message = '<div class="message alert alert-dismissable alert-success" role="alert">' +
                '<button class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">×</span>' +
                '</button>' + data +
                '</div>';
            messageDiv.html(message);

        }).fail(function () {
            console.log("Error in push");
        }).done(function () {
            messageDiv.fadeIn(300).delay(5000).fadeOut(300);
        });

    });
}

function emailSave() {
    var messageDiv = $('.curr').prev('.message');

    $('#saveEmail').on('click',function(e){
        e.preventDefault();        
        var emailForm = $(".changeEmail>form");
        var send = emailForm.serializeArray();
        send.push({ "name": "valid", "value": true });

        var message = "";
        $.post("update_email.php", send, function (data) {
            console.log(data);
            
            message = '<div class="message alert alert-dismissable alert-success" role="alert">' +
                '<button class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">×</span>' +
                '</button>' + data +
                '</div>';
            messageDiv.html(message);

        }).fail(function () {
            console.log("Error in push");
        }).done(function () {
            messageDiv.fadeIn(300).delay(5000).fadeOut(300);
            $('#cancelChange').trigger('click');
        });

    });
    
}

function passwordSave() {
    var messageDiv = $('#savePassword').parent().prev();

    $('#savePassword').on('click', function (e) {
        e.preventDefault();
        var passwordForm = $(this).parent();
        var send = passwordForm.serializeArray();
        send.push({ "name": "valid", "value": true });

        var message = "";
        $.post("update_pass.php", send, function (data) {

            message = '<div class="message alert alert-dismissable alert-success" role="alert">' +
                '<button class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">×</span>' +
                '</button>' + data +
                '</div>';
            messageDiv.html(message);

        }).fail(function () {
            console.log("Error in push");
        }).done(function () {
            messageDiv.fadeIn(300).delay(5000).fadeOut(300);
            location.reload().delay(2000);
        });

    });
}

function deleteAccount() {
    $("#confirmDelete").on("click",function(){
        $.post("confirm_delete.php",{"valid":true},function(data){
            console.log(data);            
        }).done(function(){
            move().delay(6000);
        });
    });

    function move() {
        window.location = "../../index.php?logout=1";
    }
}
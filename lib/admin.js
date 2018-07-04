$(document).ready(main());

function main() {
    $("#response").hide();
    totalUsers();
    addTypehead();
    inboxUser();

}

function totalUsers(){
    $.post("total_users.php",{"valid":"true"},function(data){
        $("#total_users").text(data);        
    });
}

function addTypehead(){
    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    //Fetch emails 
    var emails ;
    $.post('getemails.php',{"valid":"true"},function (data) {
        emails = data; 
    },'JSON').done(function(){
        $('#sendTo').typeahead({
            hint: false,
            highlight: true,
            minLength: 2,
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'unable to find any user with the current email',
                    '</div>'
                ].join('\n')
            }

        },
            {
                name: 'emails',
                source: substringMatcher(emails)
        });
                
    });
       
}

function inboxUser(){
    $('#send').on('click',function(event){
        event.preventDefault();

        var formdata = $('#compose').serializeArray();
        formdata.push({"name":"send","value":"true"});
        //Send to server
        var response ;
        $.post("inboxuser.php",formdata,function(data){
            response = data;            
        }).done(function(){
            $('#response').html(response).fadeIn('easeIn').delay(5000).fadeOut('fast');
            $("#compose").find('input[type="text"],input[type="email"],textarea').each(function(){
                $(this).val(" ");                
            });
        });       
    });
}
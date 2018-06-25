$(document).ready(main);

function main() {
    //Search function for the table
    $(".search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".checklist tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //animation on the task options
    $('.options').on('mouseover',function(){
        $(this).addClass('animated pulse');

    }).on('mouseout',function(){
        $(this).removeClass('animated pulse');

    });

    //toggle task panel
    $('.overlay').hide();
    $('.taskDetails').hide();

    $('.dismissIcon').on('click',function(){
        $(this).parent().hide('easeOut');
        $('.overlay').hide();

        var form = $('.taskDetails form');
        clearFields(form);
    });

    //Clear textarea on keyup
    $('.taskDetails form textarea ').on('keyup',function(){
        var value = $(this).val();
        if(value == "Your notes"){
            $(this).val(" ");
        }
    });

    $('.addTask, .edit').on('click',function(event){
        $('.overlay').show();
        $('.taskDetails').show('easeIn');

        var btn = $(event.target);
        
        if (btn.is('i.fa.fa-pencil')){
            var myTh = $(this).siblings('th');
            var checkBoxArr = myTh.find('.taskStatus');
            var checkBox = checkBoxArr[0];
            var status = $(checkBox).is(':checked');
            if (status) {
                $('.taskDetails .taskStatus').prop('checked',true);
            }else {
                $('.taskDetails .taskStatus').prop('checked', false);
            }

            var summary = myTh.find('.task-content').text();
            $('.taskDetails #summary').val(summary);
            
            var dueDate = myTh.find('.due-date').text();
            $('.taskDetails #dueDate').val(dueDate);

            var notes = myTh.find('.taskNotes').text();
            $('.taskDetails #taskNotes').val(notes);
        }
    });
}

function clearFields(form) {
    var fields = form.find('.form-control');
    $.each(fields,function(key,value){
        $(this).val("");
        $(this).val();       
    });
}
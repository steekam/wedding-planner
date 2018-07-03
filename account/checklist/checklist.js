$(document).ready(main);

function main() {
    //Update the cheklist view
    fetch_tasks();

    //Remove auto complete
    $('.taskDetails input').attr('autocomplete','off');

    //Search function for the table
    $(".search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".checklist tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    //animation on the task options
    $(document).on('mouseover', '.options', function () {
        $(this).addClass('animated pulse');

    }).on('mouseout', '.options', function () {
        $(this).removeClass('animated pulse');

    });

    //toggle task panel
    $('.overlay').hide();
    $('.taskDetails').hide();

    $('.dismissIcon').on('click', function () {
        $(this).parent().hide('easeOut');
        $('.overlay').hide();
    });

    var task;
    $(document).on('click', '.addTask, .edit', function (event) {
        $('.overlay').show();
        $('.taskDetails').show('easeIn');

        var btn = $(event.target);

        if (btn.hasClass('edit') || btn.hasClass('fa-pencil')) {
            $('#updateTask').show().siblings().hide();

            task = $(this).parent().attr('id');
            $('.taskDetails #taskId').val(task);

            var myTh = $('#' + task + ' th')
            var checkBoxArr = myTh.find('.taskStatus');
            var checkBox = checkBoxArr[0];
            var status = $(checkBox).is(':checked');
            if (status) {
                $('.taskDetails .taskStatus').prop('checked', true);
            } else {
                $('.taskDetails .taskStatus').prop('checked', false);
            }

            
            var summary = myTh.find('.task-content').text();
            $('.taskDetails #summary').val(summary);

            var dueDate = myTh.find('.due-date').text();
            $('.taskDetails #dueDate').val(dueDate);

            var notes = myTh.find('.taskNotes').text();
            $('.taskDetails #taskNotes').val(notes);

        } else {
            $('#addTask').show().siblings().hide();
            var form = $('.taskDetails form');
            clearFields(form);
        }
    });

    //Custome due date view
    dateView();

    //Add new task
    addTask();
    //Update task
    updateTask(task);
    //If the task is checked
    taskDone();
    //Delete task
    deleteTask();

    //show undone tasks only
    showUndone();

}

function dateView(){
    var monthsArr = new Array(
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
    );

    //Change new date
    $('.taskDetails #dueDate').on('click', function () {
        var field = $(this);

        field.attr('type', 'date');
        $(this).change(function () {
            var dateChoosen = $(this).val();
            var date = new Date(dateChoosen);
            var month = date.getMonth();
            var theDate = date.getDate();
            var theYear = date.getFullYear();
            field.attr('type', 'text');
            field.val(monthsArr[month] + " " + theDate + ", " + theYear);
            field.blur();
        });
    });
}

function clearFields(form) {
    var fields = form.find('.form-control');
    $.each(fields,function(key,value){
        $(this).val("");
        $(this).val();       
    });
    $('.taskDetails .taskStatus').prop('checked', false);
}

function fetch_tasks(){
    var taskData;
    $.post('fetch_tasks.php',{'valid':'true'},function(data){
        taskData = data; 
    }).done(function(){

        $('.checklist tbody').html(taskData);
        $("input[completed=true]").each(function () {
            $(this).prop('checked', true);
        });

        var taskview = $('.checklist tbody').html();
        if(taskview == ""){
            var notasks = "<p>Currently no tasks. <br>Start now to keep your wedding on track.</p>";
            $('.checklist tbody').html(notasks);
        }


    }).fail(function(){
        console.log("Error in fetch of tasks");        
    });    
}

function addTask(){
    $('#addTask').on('click', function (e) {
        var formdata = $('.taskDetails form').serializeArray();
        var taskStatus = $('.taskDetails .taskStatus').is(':checked');
        formdata.push({ 'name': 'taskStatus', 'value': taskStatus });

        //Save data to variables
        var taskSummary = formdata[0]['value'];
        var dueDate = formdata[1]['value'];
        var taskNotes = formdata[2]['value'];
        var taskStatus = formdata[3]['value'];

        formdata.push({ 'name': 'valid', 'value': 'true' });

        //Send to the database
        $.post("add_task.php", formdata, function (data) {
            console.log(data);
        }).done(function () {
            var checked = $('#completeToggle').prop('checked');

            if (checked) {
                fetch_tasks();
            } else {
                fetch_undone();
            } 
            $('.dismissIcon').trigger('click');
        });
    });
}

function taskDone(){
    $(document).on('click', '.checklist .taskStatus', function () {
        var taskDone = $(this).parents('tr').prop('id');
        var myTh = $('#' + taskDone + ' th')
        var checkBoxArr = myTh.find('.taskStatus');
        var checkBox = checkBoxArr[0];
        var status = $(checkBox).is(':checked');

        var send = new Array();
        send.push({ "name": "valid", "value": "true" },
            { "name": "taskDone", "value": taskDone },
            { "name": "taskStatus", "value": status });

        //Update to the database
        $.post('task_done.php', send, function (data) {
            console.log(data);
        }).done(function () {
            var checked = $('#completeToggle').prop('checked');

            if (checked) {
                fetch_tasks();
            } else {
                fetch_undone();
            } 
        });
    });
}

function updateTask() {
    
    $('.taskDetails form').submit(false);
    $(document).on('click', '#updateTask', function (e) {
        e.preventDefault();
        var task = $('.taskDetails #taskId').val();

        var formdata = $('.taskDetails form').serializeArray();
        var taskStatus = $('.taskDetails .taskStatus').is(':checked');
        formdata.push({ 'name': 'taskStatus', 'value': taskStatus }, { 'name': 'valid', 'value': 'true' }
            , { "name": 'task', "value": task });

        //Update new values
        $.post('update_tasks.php', formdata, function (data) {
            console.log(data);
        }).done(function () {
            var checked = $('#completeToggle').prop('checked');

            if (checked) {
                fetch_tasks();
            } else {
                fetch_undone();
            } 
            $(".taskDetails > .dismissIcon").trigger('click');
        });
    });
}

function deleteTask() {
    $(document).on('click', '.remove, .removeTask', function (event) {
        event.preventDefault();

        var task;
        
        var btn = $(event.target);
        if (btn.hasClass('remove') || btn.hasClass('fa-trash-o')) {
            task = $(this).parent().attr('id');

        } else if (btn.hasClass('removeTask') || btn.hasClass('fa-trash')) {
            task = $('.taskDetails #taskId').val();
        }

        var formdata = new Array();
        formdata.push({ 'name': 'valid', 'value': 'true' }, { 'name': 'task', 'value': task });
        //Clear it from the database
        $.post('delete_task.php', formdata, function (data) {
            console.log(data);
        }).done(function () {
            var checked = $('#completeToggle').prop('checked');

            if (checked) {
                fetch_tasks();
            } else {
                fetch_undone();
            } 
            $('.dismissIcon').trigger('click');
        });
    });
}

function fetch_undone() {
    var taskData;
    $.post('show_undone.php', { 'valid': 'true' }, function (data) {
        taskData = data;
    }).done(function () {

        $('.checklist tbody').html(taskData);
        $("input[completed=true]").each(function () {
            $(this).prop('checked', true);
        });

        var taskview = $('.checklist tbody').html();
        if (taskview == "") {
            var notasks = "<p>Currently no tasks. <br>Start now to keep your wedding on track.</p>";
            $('.checklist tbody').html(notasks);
        }
    }).fail(function () {
        console.log("Error in fetch of tasks");
    }); 
}
function showUndone() {
    $('#completeToggle').on('click',function(){
        var checked = $(this).prop('checked');
        
        if(checked){
            fetch_tasks();
        }else{
            fetch_undone();
        }        
    });
}
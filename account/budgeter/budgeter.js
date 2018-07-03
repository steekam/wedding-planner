$(document).ready(main());

function main() {
    fetch_budgetDetails();
    fetch_budget();
    updateBudget();
    toggleDetails();

    updateExpense();
    deleteExpense();
    paidExpense();
    
    //Adding new expense
    newExpense();

    //Remove auto complete
    $('.expenseDetails input').attr('autocomplete', 'off');

    //Search function for the table
    $(".search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".budgeter tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //Custome due date view
    dateView();
}

function updateBudget() {
    $('.updateBudget').hide();

    //Toggle the edit form
    $('.editBudget').on('click',function(){
        $("#intro-text p").hide();
        $('.updateBudget').fadeIn();
    });

    //Remove the form
    $('#cancelEdit').on('click',function(){
        $('.updateBudget').hide();
        $("#intro-text p").show();
        $('#newBudget').val("");
    });

    //Confirm new budget set
    $('#confirmEdit').on('click',function(){
        var newbudget = $('#updateBudget').serializeArray();
        newbudget.push({"name":"valid","value":"true"});
        
        $.post('changeBudget.php',newbudget,function(data){
            console.log(data);            
        }).done(function(){
            $('#cancelEdit').trigger('click');
            fetch_budget();
        });
    });
}

function toggleDetails(){
    //toggle expense panel
    $('.overlay').hide();
    $('.expenseDetails').hide();

    $('.dismissIcon').on('click', function () {
        $(this).parent().hide('easeOut');
        $('.overlay').hide();
    });

    $(document).on('click', '.addExpense, .edit', function (event) {
        $('.overlay').show();
        $('.expenseDetails').show('easeIn');

        var btn = $(event.target);

        if (btn.hasClass('edit') || btn.hasClass('fa-pencil')) {
            $('#updateExpense').show().siblings().hide();

            var expenseId = $(this).parents('tr').prop('id');
            $('.expenseDetails #expenseId').val(expenseId);

            var mtd = $('#' + expenseId + ' .main');
            var checkBoxArr = mtd.find('.expenseStatus');
            var checkBox = checkBoxArr[0];
            var status = $(checkBox).is(':checked');
            if (status) {
                $('.expenseDetails .expenseStatus').prop('checked', true);
            } else {
                $('.expenseDetails .expenseStatus').prop('checked', false);
            }

            var expense = mtd.find('.expense-content').text();
            $('.expenseDetails #summary').val(expense);
            var dueDate = mtd.find('.due-date').text();
            $('.expenseDetails #dueDate').val(dueDate);
            var amount = $('#'+expenseId).find('.amount').text();
            $('input#amount_spent.form-control').val(amount);
            var vendor = $('#' + expenseId).find('.vendor').text();
            $('input#vendor').val(vendor);
            var vendorContact = $('#' + expenseId).find('.vendor_contact').text();
            $('input#contact').val(vendorContact);
            var notes = mtd.find('.expenseNotes').text();
            $('textarea#expenseNotes').val(notes);
           
        } else {
            $('#addExpense').show().siblings().hide();
            var form = $('.expenseDetails form');
            clearFields(form);
        }
    });
}

function clearFields(form) {
    var fields = form.find('.form-control');
    $.each(fields, function (key, value) {
        $(this).val("");
        $(this).val();
    });
    $('.expenseDetails .expenseStatus').prop('checked', false);
}

function dateView() {
    var monthsArr = new Array(
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
    );

    //Change new date
    $('.expenseDetails #dueDate').on('click', function () {
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

function fetch_budget(){
    var budget;
    $.post('fetch_budget.php',{"valid":"true"}, function(data){
        budget = data;
        
    },'JSON').done(function(){
        $('#budget').text(budget['total_budget']);
        var used = budget['used_budget'];
        var rem = (budget['total_budget']) - used;
        $('#budget_rem').text(rem);
        
    });
}

function fetch_budgetDetails(){
    var budgetDetails;
    $.post('fetch_BudgetDetails.php',{'valid':'true'},function(data){
        budgetDetails = data;
    }).done(function(){
        $('.budgeter tbody').html(budgetDetails);
        $("input[paid=true]").each(function () {
            $(this).prop('checked', true);
        });
    });
    fetch_budget();
}

function newExpense(){
    $(document).on('click','#addExpense',function(){
        var formDetails = $('.expenseDetails form').serializeArray();
        var status = $('.expenseDetails form .expenseStatus').prop('checked');
        
        formDetails.push({ "name": "valid", "value": "true" }, { "name": "expenseStatus", "value": status });

        //Commit to database
        $.post('addExpense.php',formDetails,function(data){
            console.log(data);
        }).done(function(){
            
            fetch_budgetDetails();
            $('.dismissIcon').trigger('click');
        });
        
    });
}

function updateExpense() {
    $(document).on('click', '#updateExpense', function () {
        var formDetails = $('.expenseDetails form').serializeArray();
        var status = $('.expenseDetails form .expenseStatus').prop('checked');

        formDetails.push({ "name": "valid", "value": "true" }, { "name": "expenseStatus", "value": status });

        //Commit to database
        $.post('updateExpense.php', formDetails, function (data) {
            console.log(data);
        }).done(function () {
           
            fetch_budgetDetails();
            $('.dismissIcon').trigger('click');
        });

    });
}

function deleteExpense() {
    $(document).on('click', '.remove, .removeExpense', function (event) {
        event.preventDefault();

        var expenseId;

        var btn = $(event.target);
        if (btn.hasClass('remove') || btn.hasClass('fa-trash-o')) {
            expenseId = $(this).parents('tr').prop('id');
        } else if (btn.hasClass('removeExpense') || btn.hasClass('fa-trash')) {
            expenseId = $('.expenseDetails #expenseId').val();
        }

        var formdata = new Array();
        formdata.push({ 'name': 'valid', 'value': 'true' }, { 'name': 'expense', 'value': expenseId });
        //Clear it from the database
        $.post('delete_expense.php', formdata, function (data) {
            console.log(data);
        }).done(function () {
            
            fetch_budgetDetails();
            $('.dismissIcon').trigger('click');
        });
    });
}

function paidExpense(){
    $(document).on('click','.budgeter .expenseStatus',function(){
        var expenseId = $(this).parents('tr').prop('id');

        var mtd = $('#' + expenseId + ' .main');
        var checkBoxArr = mtd.find('.expenseStatus');
        var checkBox = checkBoxArr[0];
        var status = $(checkBox).is(':checked');

        var send = new Array();
        send.push({ "name": "valid", "value": "true" },
            { "name": "expensePaid", "value": expenseId },
            { "name": "expenseStatus", "value": status });
        
            //Update database
        $.post('expense_paid.php',send,function(data){
            console.log(data);            
        }).done(function(){
            
            fetch_budgetDetails();

        });
    });
}
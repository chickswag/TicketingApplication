
function view_ticket(ticket_id){
    $.ajax({
        url:"/ticketLogId/"+ticket_id,
        type:'GET',
        data:{query:ticket_id},
        dataType: 'json',
        success:function (data) {
            $('.showmore-body').html(data.page_body);
            $('.modal-title').html(data.page_title);
        }
    })
}
function dateRange (){
    datepicker1  = $( "#daterange1" ).val();
    datepicker2 = $( "#daterange2" ).val();

    daterange = {'startDate':datepicker1,'endDate':datepicker2};
    if(datepicker1 != "" && datepicker2 != ""){
        filterSelection(daterange);
    }

}
function filterSelection(date){
    let url = window.location.pathname;
    var currentDate = new Date();
    var searchBy = '';
    var dateText = '';
    var isCurrentMonth = true;
    document.getElementById('customFilterSelection').style.display ="none";
    document.getElementById('loader').style.display ="block";

    var myJsonData ={};
    $('.table-body').html("");
    switch(date){
        case '0':
            document.getElementById('customFilterSelection').style.display ="block";
            isCurrentMonth = true;
            break;
        case '1':
            currentDate.setMonth(currentDate.getMonth());
            searchBy = 'months';
            dateText = "Current Month";
            isCurrentMonth = false;
            break;
        case '2':
            currentDate.setMonth(currentDate.getMonth()-3);
            searchBy = 'months';
            dateText = "Last 3 Months";
            isCurrentMonth = false;
            break;
        case '3':
            currentDate.setMonth(currentDate.getMonth()-6);
            searchBy = 'months';
            dateText = "Last 6 Months";
            isCurrentMonth = false;
            break;
        default:
            if(typeof date === 'object'){
                myJsonData = date;
                isCurrentMonth = false;
                document.getElementById('customFilterSelection').style.display ="block";
            }
            break;

    }
    if(!isCurrentMonth){
        if(typeof date != 'object') {
            var month = currentDate.getMonth() + 1;
            var day = currentDate.getDate();
            var year = currentDate.getFullYear();

            currentDate = year + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' + (('' + day).length < 2 ? '0' : '') + day;

            myJsonData = {created_at: currentDate, searchBy: searchBy};
        }
        $.ajax({
            url:  url,
            method: "GET",
            data : myJsonData,
            success: function(data) {
                document.getElementById('loader').style.display ="none";
                $('.table-body').html(data);
                $('.display-messages').html('<div class="alert alert-success">'+dateText+' data successfully loaded...</div>');
                $('.alert').fadeOut(5000);
            },
        });
    }



}

function orderBySelected(selected) {

    $.ajax({
        url:  '/ticketlogs',
        method: "GET",
        data : {'type':selected},
        success: function(data) {
        $('#sortedLogs').html(data)
        },
    });

}
if(document.getElementById("submitFile")){
    document.getElementById("submitFile").addEventListener("click", function(event){
        event.preventDefault();
        $.confirm({
            animationBounce: 2,
            theme: 'black',
            closeIcon: true,
            title:'Select Option!!!',
            content: 'Selected preferred option',
            type: 'green',
            icon: 'fa fa-info fa-2x',
            draggable: false,
            buttons: {
                info: {
                    text: 'Aplhabetically',
                    btnClass: 'btn-blue',
                    action: function(){
                        document.getElementById('formType').value ='alphabetically';
                        $('form').submit();

                    }
                },
                warning: {
                    text: 'String Length',
                    btnClass: 'btn-warning',
                    action: function(){
                        document.getElementById('formType').value ='string_length';
                        $('form').submit();
                    }
                },
                danger: {
                    text: 'Cancel',
                    btnClass: 'btn-red any-other-class', // multiple classes.

                },

            }

        });
    });
}


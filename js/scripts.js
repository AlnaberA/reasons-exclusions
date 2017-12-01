$(document).ready(function(){
      
     $('#load_table').DataTable({
                        dom:
                            "<'row'<'col-sm-1'l><'col-sm-8 text-center'B><'col-sm-3'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-1'i><'col-sm-11'p>>",
                        "bLengthChange":true,
                        'aaSorting': [2, 'asc'],
                        "paging": true,
                        "pageLength": 25,
                        buttons: [
                                { extend: 'excel', 
                                  className: 'excelButton btn btn-success', 
                                  title: 'Exclusions and Reasons',
                                  exportOptions: {
                                        orthogonal: 'sort',
                                        columns: [0,1,2,3,4,5,6,7,8]
                                  } 
                                }
                            ],
                    });

    $("#supervisors, #reason").change(function(){
        
        $('#on_load_table').remove();
       var supervisor = document.getElementById("supervisors").value;
       var reason = $('input[name="reason"]:checked').val();
       var userId = document.getElementById("userId").value;
       var userName = document.getElementById("userName").value;
       
      //alert(reason);
       //alert(supervisor);
       //alert(employee);
            $.ajax({
                type:"POST",
                url:"ajax/main_table.php",
                  data:
                         {
                             supervisor:supervisor,
                             reason:reason,
                             userId:userId,
                             userName:userName
                         },
                success:function(data){
                    $('#main_table_div').html(data);
                    $('#all_table').DataTable({
                        dom:
                            "<'row'<'col-sm-1'l><'col-sm-8 text-center'B><'col-sm-3'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-1'i><'col-sm-11'p>>",
                        "bLengthChange":true,
                        'aaSorting': [2, 'asc'],
                        "paging": true,
                        "pageLength": 25,
                        buttons: [
                                { extend: 'excel', 
                                  className: 'excelButton btn btn-success', 
                                  title: 'Exclusions and Reasons',
                                  exportOptions: {
                                        orthogonal: 'sort',
                                        columns: [0,1,2,3,4,5,6,7,8]
                                  } 
                                }
                            ],
                    });
                },
                
             });  
             
             $('#main_table_div').show();
           
        });
        
    $('#submit').prop("disabled", true);
    
    $('#DURATION, #NEW_REASON').unbind('change').on('change', function() {

        var DURATION = document.getElementById("DURATION").value;
        var REASON = document.getElementById("NEW_REASON").value;
        //alert(DURATION);
        if((DURATION != 0) && (REASON != '')){
            $('#submit').prop("disabled", false);
        }
        else
        {
            $('#submit').prop("disabled", true);
        }
     
        if(REASON == 'New Employee')
        {
            $('#submit').prop("disabled", false);
            $('#DURATION option').eq(0).prop('disabled', true);
            $('#DURATION option').eq(1).prop('selected', true);
            $('#DURATION option').eq(2).prop('disabled', true);
            $('#DURATION option').eq(3).prop('disabled', true);
            $('#DURATION option').eq(4).prop('disabled', true);
            $('#DURATION option').eq(5).prop('disabled', true);
            $('#DURATION option').eq(6).prop('disabled', true);
            $('#DURATION option').eq(7).prop('disabled', true);
            $('#DURATION option').eq(8).prop('disabled', true);
            $('#DURATION option').eq(9).prop('disabled', true);
            $('#DURATION option').eq(10).prop('disabled', true);
            $('#DURATION option').eq(11).prop('disabled', true);
            $('#DURATION option').eq(12).prop('disabled', true);
        }
        else
        {
            $('#DURATION option').eq(0).prop('disabled', false);
            $('#DURATION option').eq(1).prop('disabled', false);
            $('#DURATION option').eq(2).prop('disabled', false);
            $('#DURATION option').eq(3).prop('disabled', false);
            $('#DURATION option').eq(4).prop('disabled', false);
            $('#DURATION option').eq(5).prop('disabled', false);
            $('#DURATION option').eq(6).prop('disabled', false);
            $('#DURATION option').eq(7).prop('disabled', false);
            $('#DURATION option').eq(8).prop('disabled', false);
            $('#DURATION option').eq(9).prop('disabled', false);
            $('#DURATION option').eq(10).prop('disabled', false);
            $('#DURATION option').eq(11).prop('disabled', false);
            $('#DURATION option').eq(12).prop('disabled', false);
        }
    });
    
});

function cancel(){
    window.location.href = 'index.php';
}

function select_employee(EMPLOYEE)
{
    var supervisor = document.getElementById("supervisors").value;
    var reason = $('input[name="reason"]:checked').val();
    var employee = EMPLOYEE.value;
    
    $.ajax({
                type:"POST",
                url:"ajax/main_table.php",
                  data:
                         {
                             supervisor:supervisor,
                             reason:reason,
                             employee:employee
                         },
                success:function(data){
                    $('#main_table_div').html(data);
                    $('#all_table').DataTable({
                        dom:
                            "<'row'<'col-sm-1'l><'col-sm-8 text-center'B><'col-sm-3'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-1'i><'col-sm-11'p>>",
                        "bLengthChange":true,
                        'aaSorting': [2, 'asc'],
                        "paging": true,
                        "pageLength": 25,
                        buttons: [
                                { extend: 'excel', 
                                  className: 'excelButton btn btn-success', 
                                  title: 'Exclusions and Reasons',
                                  exportOptions: {
                                        orthogonal: 'sort',
                                        columns: [0,1,2,3,4,5,6,7,8]
                                  } 
                                }
                            ],
                    });
                    document.getElementById("employees").value = employee;
                },
            });
    
}

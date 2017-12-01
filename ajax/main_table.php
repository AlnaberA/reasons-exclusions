<?
    include('../database.php');
    //include('../secure.php');
    
    $supervisor = trim($_POST['supervisor']);
    $reason = $_POST['reason'];
    $employee = $_POST['employee'];
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    
    $sql_check_user = "SELECT * FROM INTOXDM.COL_USERS WHERE USERID = '{$userId}'";
    
    $check_user = oci_parse($maximo, $sql_check_user);
    oci_execute($check_user);
    oci_commit($maximo);
    
    $row = oci_fetch_array($check_user, OCI_BOTH);
    if($row['USERID'] == ' ')//if person is not in table
    {
        $sql_save_supervisor_selection = "INSERT INTO INTOXDM.COL_USERS (USERID, NAME, SUPERVISOR_SELECTION) 
                                          VALUES ('{$userId}', '{$userName}', '{$supervisor}')";
                                      
        $supervisor_sent = oci_parse($maximo, $sql_save_supervisor_selection);
        oci_execute($supervisor_sent);
        oci_commit($maximo);
    
        oci_free_statement($supervisor_sent);
    }
    else{//if supervisor already in table
        $sql_update_supervisor_selection = "UPDATE INTOXDM.COL_USERS SET
                                            SUPERVISOR_SELECTION = '{$supervisor}'
                                          WHERE USERID = '{$userId}'
                                          ";
                                      
        $supervisor_update = oci_parse($maximo, $sql_update_supervisor_selection);
        oci_execute($supervisor_update);
        oci_commit($maximo);
    
        oci_free_statement($supervisor_update);
    }
    
    oci_free_statement($check_user);
    
    
    
    
    if($supervisor == "all"){
        
        $sql_select_all .= "SELECT * FROM INTOXDM.COL_REASONS";
        
        if($reason == 'yes')
        {
            //$sql_select_all .= " WHERE REASON IS NOT NULL";
        }
        else
        {
            $sql_select_all .= " WHERE REASON IS NULL";
        }

        if($employee == '')
        {
            ;
        }
        else
        {
            $sql_select_all .= " AND PERSONID = '{$employee}'";
        }
        
        
        $SENT_BY_DATABASE1 = oci_parse($maximo, $sql_select_all);
        oci_execute($SENT_BY_DATABASE1);
        oci_commit($maximo);
        
        $sql_all_employees = "SELECT DISTINCT PERSONID FROM INTOXDM.COL_REASONS ORDER BY PERSONID";
        
        $SENT_BY_DATABASE2 = oci_parse($maximo, $sql_all_employees);
        oci_execute($SENT_BY_DATABASE2);
        oci_commit($maximo);
        
        $all_table .= '
                 <table class="table table-bordered table-striped" id="all_table">
                    <thead>
                        <th>Person ID</th>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position Description</th>
                        <th>Qual ID</th>
                        <th>Qual Description</th>
                        <th>Supervisor Name</th>
                        <th>Reason</th>
                        <th>Edit</th>
                    </thead>
                    <tbody>';
                        
                        while($row = oci_fetch_array($SENT_BY_DATABASE1, OCI_BOTH)) {
                            $all_table .= "<tr>";
                                $all_table .= "<td>" . $row['PERSONID'] . "</td>";
                                $all_table .= "<td>" . $row['EMPID'] . "</td>";
                                $all_table .= "<td>" . $row['FIRSTNAME'] . "</td>";
                                $all_table .= "<td>" . $row['LASTNAME'] . "</td>";
                                $all_table .= "<td>" . $row['POS_DES'] . "</td>";
                                $all_table .= "<td>" . $row['QUALID'] . "</td>";
                                $all_table .= "<td>" . $row['QUAL_DESC'] . "</td>";
                                $all_table .= "<td>" . $row['MANAGER_NAME'] . "</td>";
                                $all_table .= "<td>" . $row['REASON'] ;
                                                if($row['REASON'] != '')
                                                {
                                                    $all_table .= "<br/>". $row['ENDDATE']. "</td>";;
                                                }
                                                 else
                                                {
                                                    $all_table .= "</td>";
                                                }
                                                
                                $all_table .= "<td><a href='edit.php?QUALID=" . $row['QUALID'] .'&EMPID='.$row['EMPID']."' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                            $all_table .= "</tr>";
                                
                        }
        
        $all_table .= '</tbody>
                </table>';            
        
       
        oci_free_statement($SENT_BY_DATABASE1);
        oci_free_statement($SENT_BY_DATABASE2);
    }
    else
    {
        $sql_select_supervisor = "SELECT * FROM INTOXDM.COL_REASONS 
                                  WHERE MANAGER_NAME = '{$supervisor}'";
                                  
        if($reason == 'yes')
        {
            $sql_select_all .= " AND REASON IS NOT NULL";
        }
        else
        {
            $sql_select_supervisor .= " AND REASON IS NULL";
        }
        
        if($employee == '')
        {
            ;
        }
        else
        {
            $sql_select_supervisor .= " AND PERSONID = '{$employee}'";
        }
        
        $SENT_BY_DATABASE1 = oci_parse($maximo, $sql_select_supervisor);
        oci_execute($SENT_BY_DATABASE1);
        oci_commit($maximo);
        
        $sql_all_employees = "SELECT DISTINCT PERSONID FROM INTOXDM.COL_REASONS WHERE MANAGER_NAME = '{$supervisor}' ORDER BY PERSONID";
        $SENT_BY_DATABASE2 = oci_parse($maximo, $sql_all_employees);
        oci_execute($SENT_BY_DATABASE2);
        oci_commit($maximo);
        
        $employee_select_all .= '<div style="padding-bottom:5%;">
            <label for="employees">Select Employee ID:</label><br>
                <select id="employees" name="employees" class="form-control" style="width: 25%;" onchange="select_employee(this)">
                    <option></option>';
                    while($row = oci_fetch_array($SENT_BY_DATABASE2, OCI_BOTH)) {
                        
                       $employee_select_all .= "<option value='".$row['PERSONID']."'>".$row['PERSONID']."</option>";
                    }
                    
        $employee_select_all .= '</select></div>';
        
        $supervisor_table .= '
                 <table class="table table-bordered table-striped" id="all_table">
                    <thead>
                        <th>Person ID</th>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position Description</th>
                        <th>Qual ID</th>
                        <th>Qual Description</th>
                        <th>Supervisor Name</th>
                        <th>Reason</th>
                        <th>Edit</th>
                    </thead>
                    <tbody>';
                        
                        while($row = oci_fetch_array($SENT_BY_DATABASE1, OCI_BOTH)) {
                            $supervisor_table .= "<tr>";
                                $supervisor_table .= "<td>" . $row['PERSONID'] . "</td>";
                                $supervisor_table .= "<td>" . $row['EMPID'] . "</td>";
                                $supervisor_table .= "<td>" . $row['FIRSTNAME'] . "</td>";
                                $supervisor_table .= "<td>" . $row['LASTNAME'] . "</td>";
                                $supervisor_table .= "<td>" . $row['POS_DES'] . "</td>";
                                $supervisor_table .= "<td>" . $row['QUALID'] . "</td>";
                                $supervisor_table .= "<td>" . $row['QUAL_DESC'] . "</td>";
                                $supervisor_table .= "<td>" . $row['MANAGER_NAME'] . "</td>";
                                $supervisor_table .= "<td>" . $row['REASON'] ;
                                                if($row['REASON'] != '')
                                                {
                                                   $supervisor_table .= "<br/>". $row['ENDDATE']."</td>";;
                                                }
                                                else
                                                {
                                                    $supervisor_table .= "</td>";
                                                }
                                $supervisor_table .= "<td><a href='edit.php?QUALID=" . $row['QUALID'] .'&EMPID='.$row['EMPID']."' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                            $supervisor_table .= "</tr>";
                        }
        
        $supervisor_table .= '</tbody>
                </table>';
        
        oci_free_statement($SENT_BY_DATABASE1);
    }
    
    if($supervisor == "all")
    {
        echo $all_table;
    }
    else
    {
        echo $employee_select_all;
        echo $supervisor_table;
    }
    
    oci_close($maximo);
?>
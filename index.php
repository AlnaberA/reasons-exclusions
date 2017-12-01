<?
    require_once('secure.php');
    include('templates/header.php');
    require_once("/opt/apache/servers/webadmin/htdocs/mcl/mcl_Html.php");
    
    
    //require_once("/opt/apache/servers/webadmin/htdocs/mcl/col_header.php");
    
    $sql_get_supervisors = "SELECT DISTINCT MANAGER_NAME
                            FROM INTOXDM.COL_REASONS
                            ORDER BY MANAGER_NAME";
    
    $SENT_BY_DATABASE1 = oci_parse($maximo, $sql_get_supervisors);
    oci_execute($SENT_BY_DATABASE1);
    oci_commit($maximo);
    
    $sql_get_employees = "SELECT DISTINCT PERSONID
                    FROM INTOXDM.COL_REASONS
                    ORDER BY PERSONID";
    
    $SENT_BY_DATABASE2 = oci_parse($maximo, $sql_get_employees);
    oci_execute($SENT_BY_DATABASE2);
    oci_commit($maximo);
    
    $sql_get_supervisors_id = "SELECT DISTINCT MANAGERID
                                FROM INTOXDM.COL_REASONS
                                ORDER BY MANAGERID";
    
    $SENT_BY_DATABASE3 = oci_parse($maximo, $sql_get_supervisors_id);
    oci_execute($SENT_BY_DATABASE3);
    oci_commit($maximo);
    
    
    $supervisor_array = array();
    $employee_array = array();
    $supervisor_id_array=array();
   
    while($row = oci_fetch_array($SENT_BY_DATABASE1,OCI_BOTH)){
        array_push($supervisor_array, $row['MANAGER_NAME']);
    }
    
    while($row = oci_fetch_array($SENT_BY_DATABASE2,OCI_BOTH)){
        array_push($employee_array, $row['PERSONID']);
    }
    
    while($row = oci_fetch_array($SENT_BY_DATABASE3,OCI_BOTH)){
        array_push($supervisor_id_array, $row['MANAGERID']);
    }
    
    oci_free_statement($SENT_BY_DATABASE1);
    oci_free_statement($SENT_BY_DATABASE2);
    oci_free_statement($SENT_BY_DATABASE3);

    //print_r($supervisor_array);
    //print_r($supervisor_id_array);
    
    //print_r($user);
    
    $userId = $user['usid'];
    $userName = $user["name"];
    
    $sql_check_user = "SELECT * FROM INTOXDM.COL_USERS WHERE USERID = '{$userId}'";
    
    $check_user = oci_parse($maximo, $sql_check_user);
    oci_execute($check_user);
    oci_commit($maximo);
    
    $row = oci_fetch_array($check_user, OCI_BOTH);
    
    oci_free_statement($check_user);

?>

<!DOCTYPE HTML>

<input type="hidden" id="userId" value="<?=$userId?>"/>
<input type="hidden" id="userName" value="<?=$userName?>"/>



<center>
<div class="container" style="padding-bottom:3%;padding-top: 4%">
    
    <label for="supervisors">Select Supervisor:</label><br/>
    <?if($row['SUPERVISOR_SELECTION'] == ' ' || $row['SUPERVISOR_SELECTION'] == null || $row['SUPERVISOR_SELECTION'] == 'all') { ?>
    
        <select id="supervisors" class="selectpicker" data-size="10" style="width: 25%;" data-live-search="true">
            <option value="all">All</option>
            <?
                $count=0;
                while($count < sizeof($supervisor_array)) {
            ?>

                    <option><?= $supervisor_array[$count]?></option>
            <?  $count++;
                }
            ?>
        </select><br>
        
    <?}else{ ?>
         <select id="supervisors" class="selectpicker" data-size="10" style="width: 25%;" data-live-search="true">
            <option value="all">All</option>
            <option value="<?=$row['SUPERVISOR_SELECTION'] ?>" selected="true"><?=$row['SUPERVISOR_SELECTION'];?></option>
            <?
                $count=0;
                while($count < sizeof($supervisor_array)) {
            ?>

                    <option><?= $supervisor_array[$count]?></option>
            <?  $count++;
                }
            ?>
        </select><br>
    <?}
    ?>
  
    <label for="reason">Include Reasons:</label><br>
    <input type="radio" id="reason" name="reason" value="yes" checked/> Yes
    <input type="radio" id="reason" name="reason" value="no"/> No <br><br>

    <div id="main_table_div"></div>
    
    <?
        if($row['SUPERVISOR_SELECTION'] == ' ' || $row['SUPERVISOR_SELECTION'] == null || $row['SUPERVISOR_SELECTION'] == 'all') {
    
            $sql_on_load = "SELECT * FROM INTOXDM.COL_REASONS";
            $SENT_BY_DATABASE = oci_parse($maximo, $sql_on_load);
            oci_execute($SENT_BY_DATABASE);
            oci_commit($maximo);
        }
        else
        {
            $sql_on_load = "SELECT * FROM INTOXDM.COL_REASONS WHERE MANAGER_NAME = '{$row['SUPERVISOR_SELECTION']}'";
            $SENT_BY_DATABASE = oci_parse($maximo, $sql_on_load);
            oci_execute($SENT_BY_DATABASE);
            oci_commit($maximo);
        }
        ?>
    
    <div id="on_load_table">
        <table class="table table-bordered table-striped" id="load_table">
                    <thead>
                        <th>Person ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position Description</th>
                        <th>Qual ID</th>
                        <th>Qual Description</th>
                        <th>Supervisor Name</th>
                        <th>Reason</th>
                        <th>Edit</th>
                    </thead>
                    <tbody>
                    <?    
                        while($row = oci_fetch_array($SENT_BY_DATABASE, OCI_BOTH)) {?>
                            <tr>
                                <td><?=$row['PERSONID']?></td>
                                <td><?=$row['FIRSTNAME']?></td>
                                <td><?=$row['LASTNAME']?></td>
                                <td><?=$row['POS_DES']?></td>
                                <td><?=$row['QUALID']?></td>
                                <td><?=$row['QUAL_DESC']?></td>
                                <td><?=$row['MANAGER_NAME']?></td>
                                <td><?=$row['REASON']?><br>
                                    <? if($row['REASON'] != '')
                                        {
                                            echo $row['EXPIRED_DATE'];
                                        }
                                    ?>
                                </td>
                                <td><a href='edit.php?QUALID=<?= $row['QUALID']?>&EMPID=<?= $row['EMPID']?>' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a></td>
                            </tr>
                                
               <?         }?>
        
                    </tbody>
        </table>          
    </div>
    

</div>
</center>
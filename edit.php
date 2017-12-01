<?php
include('secure.php');
include('templates/header.php');
require_once("/opt/apache/servers/webadmin/htdocs/mcl/mcl_Html.php");

function renderForm($PERSONID, $EMPID, $FIRSTNAME, $LASTNAME, $POSID, $POS_DES, $REP, $QUALID, $QUAL_DESC, $EXISTING, $BEGINDATE, $EXPIRED_DATE, $MANAGERID, $MANAGER_NAME, $DEPTID, $DEPTDESC, $REASON, $JOBID) 
 {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Insert New Reason</title>
</head>
<body>
<?php 
 //Display any Errors
if ($error != '')
{
                echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
}
?> 
                  </br>
                  
<div style="margin-right: 3%; margin-left: 5%;">
    <div class="row" style="margin-left: auto; margin-right: auto;">
      <div class="col-sm-1"></div>
       <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #eff5fb;">EMPLOYEE INFORMATION:</div>
                    <div class="panel-body">
                    <form  class = "form-horizontal" action="" method="post">
                    <input type="hidden" NAME="EMPID" value="<?php echo $EMPID; ?>"/>
                        <div>
                            <label class= "control-label col-sm-3"> PERSON ID:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="PERSONID" name="PERSONID" value="<?php echo $PERSONID; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> FIRST NAME:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="FIRSTNAME" name="FIRSTNAME" value="<?php echo $FIRSTNAME; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> LAST NAME:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="LASTNAME" name="LASTNAME" value="<?php echo $LASTNAME; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> POS DES:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="POS_DES" name="POS_DES" value="<?php echo $POS_DES; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> QUAL ID:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="QUALID" name="QUALID" value="<?php echo $QUALID; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> QUAL DESC:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="QUAL_DESC" name="QUAL_DESC" value="<?php echo $QUAL_DESC; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> SUPERVISOR NAME:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="MANAGER_NAME" name="MANAGER_NAME" value="<?php echo $MANAGER_NAME; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> JOB ID:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="JOBID" name="JOBID" value="<?php echo $JOBID; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> REASON:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="REASON" name="REASON" value="<?php echo $REASON; ?>" readonly = "readonly"/><br></div>

                            <label class= "control-label col-sm-3"> EXPIRE DATE:</label><div class="col-sm-8">
                            <input type="text" class= "form-control" id="EXPIRED_DATE" name="EXPIRED_DATE" value="<?php echo $EXPIRED_DATE; ?>" readonly = "readonly"/><br></div>
                     </div>
                </div>
            </div>
       </div>       
    
<?php
$submittedValue = "";
        $value0 = "";
        $value1 = "Disability Case Management (DCM)";
        $value2 = "Family Medical Leave (FML)";
        $value3 = "New Employee";
        $value4 = "Vacation to Retirement";
        $value5 = "Scheduled";
$submittedValue2 = "";
        $value_0m = "";
        $value_1m = "1 month";
        $value_2m = "2 months";
        $value_3m = "3 months";
        $value_4m = "4 months";
        $value_5m = "5 months";
        $value_6m = "6 months";
        $value_7m = "7 months";
        $value_8m = "8 months";
        $value_9m = "9 months";
        $value_10m = "10 months";
        $value_11m = "11 months";
        $value_12m = "12 months";
?>

                  </br>
<div class="col-sm-5">
      <div class="panel panel-default">
      <div class="panel-heading" style="background-color: #eff5fb;">UPDATE REASON & DURATION:</div>
      <div class="panel-body">
                  
<form class = "form-horizontal" action="" name="REASON" id="REASON" method="post">

<label class= "control-label col-sm-3"> NEW REASON:</label><div class="col-sm-8">
    <select project="NEW_REASON" id="NEW_REASON" name="NEW_REASON" class="form-control" style="width: 50%"></div>
                <option value = "<?php echo $value0; ?>"<?php echo ($value0 == $submittedValue)?" SELECTED":""?>><?php echo $value0; ?></option>
                <option value = "<?php echo $value1; ?>"<?php echo ($value1 == $submittedValue)?" SELECTED":""?>><?php echo $value1; ?></option>
                <option value = "<?php echo $value2; ?>"<?php echo ($value2 == $submittedValue)?" SELECTED":""?>><?php echo $value2; ?></option>
                <option value = "<?php echo $value3; ?>"<?php echo ($value3 == $submittedValue)?" SELECTED":""?>><?php echo $value3; ?></option>
                <option value = "<?php echo $value4; ?>"<?php echo ($value4 == $submittedValue)?" SELECTED":""?>><?php echo $value4; ?></option>
                <option value = "<?php echo $value5; ?>"<?php echo ($value5 == $submittedValue)?" SELECTED":""?>><?php echo $value5; ?></option>
</select><br></div>


<form class = "form-horizontal" action="" name="DURATION" id="DURATION" method="post">
<label class= "control-label col-sm-3"> DURATION:</label><div class="col-sm-8">

    <select project="DURATION" id="DURATION" name="DURATION" class="form-control" style="width: 50%"></div>
                <option value = "0" <?php echo ($value_0m == $submittedValue2)?" SELECTED":""?>><?php echo $value_0m; ?></option>
                <option value = "1" <?php echo ($value_1m == $submittedValue2)?" SELECTED":""?>><?php echo $value_1m; ?></option>
                <option value = "2" <?php echo ($value_2m == $submittedValue2)?" SELECTED":""?>><?php echo $value_2m; ?></option>
                <option value = "3" <?php echo ($value_3m == $submittedValue2)?" SELECTED":""?>><?php echo $value_3m; ?></option>
                <option value = "4" <?php echo ($value_4m == $submittedValue2)?" SELECTED":""?>><?php echo $value_4m; ?></option>
                <option value = "5" <?php echo ($value_5m == $submittedValue2)?" SELECTED":""?>><?php echo $value_5m; ?></option>
                <option value = "6" <?php echo ($value_6m == $submittedValue2)?" SELECTED":""?>><?php echo $value_6m; ?></option>
                <option value = "7" <?php echo ($value_7m == $submittedValue2)?" SELECTED":""?>><?php echo $value_7m; ?></option>
                <option value = "8" <?php echo ($value_8m == $submittedValue2)?" SELECTED":""?>><?php echo $value_8m; ?></option>
                <option value = "9" <?php echo ($value_9m == $submittedValue2)?" SELECTED":""?>><?php echo $value_9m; ?></option>
                <option value = "10" <?php echo ($value_10m == $submittedValue2)?" SELECTED":""?>><?php echo $value_10m; ?></option>
                <option value = "11" <?php echo ($value_11m == $submittedValue2)?" SELECTED":""?>><?php echo $value_11m; ?></option>
                <option value = "12" <?php echo ($value_12m == $submittedValue2)?" SELECTED":""?>><?php echo $value_12m; ?></option>
    </select>
    <br/>
    
    <div class="form-horizontal" style='margin-left: -40%'>
        <label for="update_all_reasons"> Update all rows for this employee? &nbsp;</label>
        <input type="checkbox" id="update_all_reasons" name="update_all_reasons"/>
    </div>
    <br/>

<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">


</form> 
      
 <button onclick="cancel()">Cancel</button>
<?
//TESTING TIME FUNCTION
// $DURATION = 3;
//
// 
// $ENDDATE = date("m/d/Y", strtotime("$ENDDATE + 3 months"));
//echo $ENDDATE;
// 
 
 ?>
</div></div></div>
</div>
<div class="col-sm-1"></div>
</div></div>
</body>
</html> 
 <?php
}
//CONNECTION TO DATABASE
//$dqm = ;

//VERIFY THAT THE UPDATES WERE SUBMITTED
if (isset($_POST['submit']))
{ 
                // VERIFY THAT A REASON WAS SELECTED
                if (isset($_POST['NEW_REASON']))
                {
                                // get form data, making sure it is validS
                                $PERSONID = $_POST['PERSONID'];
                                $EMPID = $_POST['EMPID'];
                                $FIRSTNAME = $_POST['FIRSTNAME'];
                                $LASTNAME = $_POST['LASTNAME'];
                                $POSID = $_POST['POSID'];
                                $POS_DES = $_POST['POS_DES'];
                                $REP = $_POST['REP'];
                                $QUALID = $_POST['QUALID'];
                                $QUAL_DESC = $_POST['QUAL_DESC'];
                                $EXISTING = $_POST['EXISTING'];
                                $BEGINDATE = $_POST['BEGINDATE'];
                                $MANAGERID = $_POST['MANAGERID']; 
                                $MANAGER_NAME = $_POST['MANAGER_NAME'];
                                $DEPTID = $_POST['DEPTID'];
                                $DEPTDESC = $_POST['DEPTDESC'];
                                $REASON = $_POST['NEW_REASON'];
                                $EXPIRED_DATE = $_POST['EXPIRED_DATE'];
                                $DURATION = $_POST['DURATION'];
                                $JOBID = $_POST['JOBID'];
                //echo $ENDDATE."<BR>";
                //WORK IN PROGRESS
                $EXPIRED_DATE = date("Y/m/d", strtotime("today + $DURATION months"));
				
				//Variable used to set UPDATED_BY column
				$userId = $user['usid'];
				
                                // check if reason is selected
                                if ($REASON == '')
                                {
                                                // generate error message
                                                $error = 'ERROR: Please fill in all required fields!';
                                                echo $error;
                                                //error, display form
                                                renderForm($PERSONID, $EMPID, $FIRSTNAME, $LASTNAME, $POSID, $POS_DES, $REP, $QUALID, $QUAL_DESC, $EXISTING, $BEGINDATE, $EXPIRED_DATE, $MANAGERID, $MANAGER_NAME, $DEPTID, $DEPTDESC, $REASON, $JOBID);

                                }
                                else
                                {
                                    if(isset($_POST['update_all_reasons']))
                                    {    
                                        //update all rows for employee
                                       $insertsql = "UPDATE INTOXDM.COL_REASONS SET 
                                        REASON='$REASON', EXPIRED_DATE= TO_DATE('$EXPIRED_DATE', 'YYYY/MM/DD HH:MI:SS'), 
										UPDATED_BY = '$userId', UPDATED_DATE = CURRENT_DATE
                                        WHERE PERSONID='$PERSONID'";
                                        $insertquery = oci_parse($dqm, $insertsql);
                                        oci_execute($insertquery);
                                        oci_close($dqm);

                                        // once saved, redirect back to the view page
                                        header("Location: index.php");
                                    }
                                    else
                                    {
                                        //update only single row
                                        // save the data to the database
                                        $insertsql = "UPDATE INTOXDM.COL_REASONS SET 
                                        REASON='$REASON', EXPIRED_DATE= TO_DATE('$EXPIRED_DATE', 'YYYY/MM/DD HH:MI:SS'), 
										UPDATED_BY = '$userId', UPDATED_DATE = CURRENT_DATE
                                        WHERE PERSONID='$PERSONID' AND QUALID= '$QUALID'";
                                        $insertquery = oci_parse($dqm, $insertsql);
                                        oci_execute($insertquery);
                                        oci_close($dqm);

                                        // once saved, redirect back to the view page
                                        header("Location: index.php");
                                    }
                                }
                }
                else
                {
// if the value isn't valid, display an error
                                echo 'Error!';
                }
}

 else
{

                if (isset($_GET['QUALID']) && is_numeric($_GET['QUALID']) && $_GET['QUALID'] > 0)
                {
                                $QUALID = $_GET['QUALID'];
                                $EMPID = $_GET['EMPID'];
                                $result = oci_parse($dqm, "SELECT * FROM INTOXDM.COL_REASONS WHERE QUALID=$QUALID AND EMPID=$EMPID");
                                oci_execute($result);
                                $row = oci_fetch_array($result);
                                
                                if($row)
                                {
                                                // get data
                                                $PERSONID = $row['PERSONID'];
                                                $EMPID = $row['EMPID'];
                                                $FIRSTNAME = $row['FIRSTNAME'];
                                                $LASTNAME = $row['LASTNAME'];
                                                $POSID = $row['POSID'];
                                                $POS_DES = $row['POS_DES'];
                                                $REP = $row['REP'];
                                                $QUALID = $row['QUALID'];
                                                $QUAL_DESC = $row['QUAL_DESC'];
                                                $EXISTING = $row['EXISTING'];
                                                $BEGINDATE = $row['BEGINDATE'];
                                                $EXPIRED_DATE = $row['EXPIRED_DATE'];  
                                                $MANAGERID = $row['MANAGERID']; 
                                                $MANAGER_NAME = $row['MANAGER_NAME'];
                                                $DEPTID = $row['DEPTID'];
                                                $DEPTDESC = $row['DEPTDESC']; 
                                                $REASON = $row['REASON'];
                                                $JOBID = $row['JOBID'];

                                                //show form
                                                renderForm($PERSONID, $EMPID, $FIRSTNAME, $LASTNAME, $POSID, $POS_DES, $REP, $QUALID, $QUAL_DESC, $EXISTING, $BEGINDATE, $EXPIRED_DATE, $MANAGERID, $MANAGER_NAME, $DEPTID, $DEPTDESC, $REASON, $JOBID);
                                }
                                else
                                // if no match, display result
                                {
                                                echo "No results!";
                                }
                }
                else
                {
                                echo 'Error 2!';
                }
}
     oci_close($dqm);
?>

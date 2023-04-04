<?php

error_reporting(0);

require_once('../admin/cls_dbconfig.php');
	function __autoload($classname){
	  require_once("admin/$classname.class.php");
	}
	$cls_dbconfig = new cls_dbconfig();
	$db = $cls_dbconfig->connection();
	

	$employeeID = htmlspecialchars($_REQUEST['employeeID'], ENT_QUOTES, 'UTF-8');
    //$employeeID = $_GET['employeeID'];
	
	
	 $sql = $db->query("select * from employee_info where employeeID='$employeeID'");
	
     $user_r = $sql->fetch_assoc();

     $unit = $user_r['units'];

     $company_info =  $db->query("select * from company_library where unit='$unit' and status='1'");

    $company = $company_info->fetch_assoc();


    $company['company_name'];

    $it_rq_last_id =  $db->query("SELECT linecounter from tbl_application ORDER by id DESC");

    $last_id = $it_rq_last_id->fetch_assoc();

    $lstidcount = $last_id['linecounter']+'1';


    $todate = date("Y-m-d");

    $mdate = date("s");
    $ddate = date("Y");
    $rand = rand('111','999');

   // $reference = "REF-".$rand.$ddate.$mdate;

    $reference = "REF-".$ddate."000".$lstidcount;

?>

<div class="row" style="padding-right: 5px;">
  
  <div class="col-md-10 offset-md-1">
<table width="315" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td height="22" style="width:90px;"><b>Date:</b> </td>
        <td style="padding-top:3px">
            <input type="text" name="ruqest_date" readonly value="<?php echo $todate; ?>" placeholder="yyyy-mm-dd" class="f1-ruqest_date form-control" id="f1-ruqest_date">

        </td>
       </tr>
      
         <tr>
             <td height="22"><b>Reference No:</b></td>
            <td style="padding-top:3px"> 

                <input type="text" name="reference" readonly class="f1-refe form-control" id="f1-refe" value="<?php echo $reference; ?>">

                <input type="hidden" name="linecounter" readonly value="<?php echo $lstidcount; ?>">

            </td>


        </tr>
      <tr>
        <td height="22"><label for="costcenter" class="col-form-label">Cost Center:</label>  
           
         </td>
         <td style="padding-top:3px">
             <select class="f1-costcenter form-control" name="costcenter" id="f1-costcenter" required>
                 <!--  <option value="">Select Cost Center</option> -->
                  <option value="<?php echo $company['company_name'] ?>" selected><?php echo $company['company_name'] ?></option> 
             </select>   
         </td>
        </tr>
          <tr>
          <td height="22" ><label for="costdepartment" class="col-form-label">Cost Depart:</label>             
         </td>
         <td style="padding-top:3px">
             
             <select class="f1-department form-control" name="costdepartment" id="f1-department" required>
              <!--   <option value="">Select</option> -->
                <option value="<?php echo $user_r['department'] ?>" selected><?php echo $user_r['department'] ?></option>       
             </select>

         </td>
        </tr>
      
    </table>

  </div>
   </div>

       


	
   

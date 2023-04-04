<?php

error_reporting(0);

require_once('../admin/cls_dbconfig.php');
	function __autoload($classname){
	  require_once("admin/$classname.class.php");
	}
	$cls_dbconfig = new cls_dbconfig();
	$db = $cls_dbconfig->connection();
	

	// $employeeID = htmlspecialchars($_REQUEST['employeeID'], ENT_QUOTES, 'UTF-8');
    $employeeID = $_REQUEST['employeeID'];
	
	
	 $sqls = $db->query("select email from employee_info where employeeID='$employeeID'");
	
     $datafet = $sqls->fetch_assoc();

	 $useremail = $datafet['email'];


	 $sqlsmail = $db->query("select email from employee_info where email='$useremail'");
	
     $emailcheckd = $sqlsmail->fetch_assoc();

	//print_r($emailcheckd);
	  // die();

   

?>


<?php if(!empty($emailcheckd['email'])){ 


	?>

 <div class="col-md-4 top-div">
  <label>  <input class="form-check-input" type="checkbox" onclick="return false;"> Workplace Professional - 100 GB (All Zoho Applications)</label>
</div>


<div class="col-md-4 top-div">
  <label  class="form-check-label"> <input type="checkbox" onclick="return false;" />  <!-- <i class="fa fa-windows"></i> --> Workplace Standard - 30 GB (Cliq, Workdrive, Connect)</label>
                 
</div>

<div class="col-md-4 top-div">
  <label class="form-check-label"> <input type="checkbox" onclick="return false;" /> Mail Lite - 5 GB (Cliq)</label>  
</div> 


<?php } else{ ?>


<div class="col-md-4 top-div">
  <label>  <input class="form-check-input" id="newemail" type="checkbox" name="zohomail" value="Workplace Professional - 100 GB (All Zoho Applications)" onclick="mail1(this)"> Workplace Professional - 100 GB (All Zoho Applications)</label>
</div>


<div class="col-md-4 top-div">
  <label  class="form-check-label"> <input type="checkbox" id="standard" name="zohomail" value="Workplace Standard - 30 GB (Cliq, Workdrive, Connect)" onclick="mail2(this)"/>  <!-- <i class="fa fa-windows"></i> --> Workplace Standard - 30 GB (Cliq, Workdrive, Connect)</label>
                 
</div>

<div class="col-md-4 top-div">
  <label class="form-check-label"> <input type="checkbox" id="lite" name="zohomail" value="Mail Lite - 5 GB (Cliq)" onclick="mail3(this)" /> Mail Lite - 5 GB (Cliq)</label>  
</div> 



<?php  


}  

?>


<script type="text/javascript">
	


	 $(document).ready(function () {

        $("#newemail").click(function () {
          $('#email').attr("disabled", $(this).is(":checked"));
         //  document.getElementById("email").value = "";

        }); 

        $("#standard").click(function () {
          $('#email').attr("disabled", $(this).is(":checked"));
          // document.getElementById("email").value = "";

        }); 

        $("#lite").click(function () {
          $('#email').attr("disabled", $(this).is(":checked"));
          // document.getElementById("email").value = "";

        });    
    });


</script>
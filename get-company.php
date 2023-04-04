<?php

error_reporting(0);

require_once('admin/cls_dbconfig.php');
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


?>

<?php  if(!empty($company['company_name'])) { ?>
<center><h2 class="header-title"><?php echo $company['company_name']; ?> </h2></center> 

<?php }else{ ?>

<center><h2 class="header-title">LDC Group </h2></center>

<?php } ?>
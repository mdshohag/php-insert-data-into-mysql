<?php

    //error_reporting(0);

     require_once('../admin/cls_dbconfig.php');
            function __autoload($classname){
              require_once("$classname.class.php");
            }
        $cls_dbconfig = new cls_dbconfig();
        $connect = $cls_dbconfig->connection();

          if(isset($_POST["submit"]))
          {


        $ckzohomail = isset($_POST['zohomail']) ? $_POST['zohomail'] : '';
        $applictionnamemail = isset($_POST['appliction_name']) ? $_POST['appliction_name'] : '';
     

    if(!empty($ckzohomail) || !empty($applictionnamemail)) {

 
          $reference       = $connect->real_escape_string($_POST['reference']);
          $employeeID       = $connect->real_escape_string(strtoupper($_POST['employeeID']));
          $emp_name         = $connect->real_escape_string($_POST['emp_name']);
          $designation      = $connect->real_escape_string($_POST['designation']);
          $department       = $connect->real_escape_string($_POST['department']);
          $section          = $connect->real_escape_string($_POST['section']);
          $contact_number   = $connect->real_escape_string($_POST['contact_number']);
          $costcenter       = $connect->real_escape_string($_POST['costcenter']);
          $costdepartment   = $connect->real_escape_string($_POST['costdepartment']);
          $joindate         = $connect->real_escape_string($_POST['joindate']);
          $subsection         = $connect->real_escape_string($_POST['subsection']);
          $ruqest_date      = $connect->real_escape_string($_POST['ruqest_date']);
          $email            = $connect->real_escape_string($_POST['email']);
          $zohomail            = $connect->real_escape_string($_POST['zohomail']);

          $linecounter      = $connect->real_escape_string($_POST['linecounter']);

         
         // insert
            
            $query = "INSERT INTO tbl_application (refcode, employeeID, emp_name, designation, department, section, subsection, contact_number, costcenter, costdepartment, joiningdate, ruqest_date, email, approved_status, status, linecounter) VALUES ('$reference','$employeeID', '$emp_name', '$designation', '$department', '$section', '$subsection', '$contact_number', '$costcenter', '$costdepartment', '$joindate', '$ruqest_date', '$email', '0', '1', '$linecounter')";

            

            $connect->query("UPDATE employee_info SET phone='$contact_number', email=' $email' WHERE employeeID='$employeeID'");




            if(mysqli_query($connect, $query))
            {
                
                 $id = mysqli_insert_id($connect);

                foreach($_POST["appliction_name"] as $row=>$applictionname){

                    $applictionname = $applictionname;

                    $querys = "INSERT INTO tbl_application_line (app_id, refcode_id, app_name, status) VALUES ('$id', '$reference', '$applictionname', '1' )";
                    mysqli_query($connect, $querys);
                }
              

             if(!empty($_POST['zohomail'])) {

                $no = "no";
                $yes = "yes";

            $result =  $connect->query("SELECT * FROM tbl_zohomail WHERE empID='$employeeID' and status='1' ");
            $check = $result->num_rows;

            if($check == 0){

                   $connect->query("INSERT INTO tbl_zohomail ( ap_id, empID, refc_id, mail_type, status) VALUES ('$id', '$employeeID', '$reference', '$zohomail', '1')");
                 } else{

                    $connect->query("DELETE FROM  tbl_application_line where refcode_id='$reference'");

                    $connect->query("DELETE FROM  tbl_application where refcode='$reference'");
   

                 echo ('<SCRIPT LANGUAGE="JavaScript">
                  window.alert("Already you have another request for mail");
                  window.location.href="index.php";
                
                 </SCRIPT>');

               }

               }else{
                echo "no";
               }
             


            $mid = md5($id);

            echo ('<SCRIPT LANGUAGE="JavaScript">
            window.alert("Form submission successfully")
            window.location.href="app-for-user.php?print=' . $mid . '";
            </SCRIPT>');
            
            echo '<a href="app-for-user.php?print=' . $mid . '">Save and Print </a>';   
            
            }
            else{
            echo ('<SCRIPT LANGUAGE="JavaScript">
            window.alert("Please your data")
            </SCRIPT>');
            }

     } else{

            $color = 'red';
             $font = '20px';

            echo "<script>              

                document.addEventListener('DOMContentLoaded', function() {
                  

                   var element = document.getElementById('emptyMessage');
                   element.innerHTML = '<span>You cannot submit an empty form. Please select at least one.</span>';
                    element.style.color = '$color';
                   element.style['font-size'] = '$font';
                  return false;
                });
            </script>";

        }
          
          }

     $todate = date("Y-m-d");

     $int_app_zohomail = $connect->query("SELECT * from int_app_library WHERE LibraryName='ZOHO_MAIL_PACK'");


     $int_app = $connect->query("SELECT * from int_app_library WHERE LibraryName='ZOHO_APPS'");


?>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Liz Fashion Industry Ltd.</title>
<style type="text/css">
<head>
body{
background-color:;
}
body{ font-size:12px;}
#printableArea{
margin: 0 auto;

}
table{
font-size:12px;
}
.top-div{
    padding-top: 5px;
}

.form-control{
    height: 29px !important;
        padding: 4px 6px !important;
}
#equipment{
   /* height: 620px;*/
}
.col-sm-8 {
    width: 64.666667%;
    margin-left: -28px;
}
.col-form-label{
    padding-top: 5px;
}
#additional{
    width: 172px;
}
#f1-group_name{
    width: 172px;
}
.header{
    font-size: 19px;
}
.input-header{
    width: 16px;
    height: 16px;
}
.input-laptop{
    width: 16px;
    height: 16px;
}
.header-title {
    font-family: fantasy;
    font-size: 230%;
    padding: 1px 5px 2px 5px;
}
.sub-title {
    font-family: sans-serif;
    font-size: 136%;
    padding: 1px 5px 2px 5px;
    margin-top: -5px;
}
#main-div{
    border: 1px solid #000;
}
/*#email:required {
  background-color: yellow;
}*/

</style>
 


        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
       <!--  <link rel="stylesheet" href="assets/css/form-elements.css"> -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/lizlogo.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/lizlogo.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/lizlogo.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/lizlogo.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/lizlogo.png">

</head>
    <body>
  <div class="container">  
	<div id="printableArea">
        <center><h2 class="header-title">LDC Group </h2></center>
        <center><h4 class="sub-title">Request For Application</h4></center>

<form role="form" id="multiphase" enctype="multipart/form-data" action="" method="post">
<table border="0" id="main-div" align="center" cellpadding="0" cellspacing="0" class="shawdow">
   <tr>

    <td style="padding-left: 5px;">
    <div id="getcostinfo">

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
             <td style="padding-top:3px"> <input type="text" name="reference" readonly class="f1-refe form-control" id="f1-refe"></td>
        </tr>
      <tr>
        <td height="22"><label for="section" class="col-form-label">Cost Center:</label>  
           
         </td>
         <td style="padding-top:3px">
             <select class="f1-costcenter form-control" name="costcenter" id="f1-costcenter">
                  <option value="">Select Cost Center</option>
                 
             </select>   
         </td>
        </tr>
        <tr>
              <td height="22" ><label for="section" class="col-form-label">Cost Depart:</label>             
             </td>
             <td style="padding-top:3px">
                 
                 <select class="f1-department form-control" name="section" id="f1-department">
                    <option value="">Select</option>
                          
                 </select>

             </td>
        </tr>
      
    </table>

  </div>
   </div>
     
    </div>


</td>
    
    <td style="padding-left: 10px;">

<div class="row">

  <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="Employee" class="col-sm-4 col-form-label">Employee ID:</label>
            <div class="col-sm-8">
              <input type="text" name="employeeID" placeholder="Enter Employee ID" class="employee-id form-control" id="employeeID" style="text-transform:uppercase" required>
            </div>
      </div>
   </div>

 <div id="getuserinfo">

      <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="name" class="col-sm-4 col-form-label">Name:</label>
            <div class="col-sm-8">
               <input type="text" name="emp_name" placeholder="Enter name..." class="f1-first-name form-control" id="f1-first-name">
            </div>
      </div>
   </div>
    <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="designation" class="col-sm-4 col-form-label">Designation:</label>
            <div class="col-sm-8">
               <select class="f1-designation form-control" name="designation" id="f1-designation">
                    <option value="">Select Designation</option>
                 </select>
            </div>
      </div>
   </div>
   <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="department" class="col-sm-4 col-form-label">Department:</label>
            <div class="col-sm-8">
                <select class="f1-department form-control" name="department" id="f1-department">
                    <option value="">Select Department</option>
                 </select>
            </div>
      </div>
   </div>

      <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="section" class="col-sm-4 col-form-label">User Section:</label>
            <div class="col-sm-8">
               <select class="f1-department form-control" name="section" id="f1-department">
                        <option value="">Select User Section</option>
                                        
                 </select>
            </div>
      </div>
   </div>
     <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="name" class="col-sm-4 col-form-label">Contact Number:</label>
            <div class="col-sm-8">
              <input type="text" name="contact_number" placeholder="+880" class="f1-contact_number form-control" id="f1-contact_number">
            </div>
      </div>
   </div>
     <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="name" class="col-sm-4 col-form-label">Email:</label>
            <div class="col-sm-8">
              <input type="email" name="email" id="email" placeholder="email@example.com" class="form-control">
            </div>
      </div>
   </div>

     <div class="col-md-6 top-div">
      <div class="form-group">
            <label for="joindate" class="col-sm-4 col-form-label"> Join Date:</label>
            <div class="col-sm-8">
               <input type="text" name="joindate" readonly placeholder="dd-mm-yyyy" class="f1-twitter form-control" id="f1-joindate">
            </div>
      </div>
   </div>
    
</div>

</div>
   
    </td>
  </tr>
 
  <tr>
   
      <td colspan="2">
      
            
           <hr style="margin-left: -1px;">

          <center> <div id="emptyMessage"></div> </center>


        <table width="1010" border="0" cellspacing="0" cellpadding="0" >

            <tr>
               <td style="padding-left: 10px;" colspan="5">
                 <h4> <label class="form-check-label" for="allcheck">Zoho Mail </label> </h4>
                
             </td>
          </tr>            
                                      
        </table>

       

           <div class="row" style="padding-left: 10px;">
             <div id="zohomail-id">
                    <div class="col-md-4 top-div">
                      <label>  <input class="form-check-input" id="newemail" type="checkbox" name="zohomail" value="Workplace Professional - 100 GB (All Zoho Applications)" onclick="mail1(this)"> Workplace Professional - 100 GB (All Zoho Applications)</label>
                    </div>


                    <div class="col-md-4 top-div">
                      <label  class="form-check-label"> <input type="checkbox" id="standard" name="zohomail" value="Workplace Standard - 30 GB (Cliq, Workdrive, Connect)" onclick="mail2(this)"/>  <!-- <i class="fa fa-windows"></i> --> Workplace Standard - 30 GB (Cliq, Workdrive, Connect)</label>
                                     
                    </div>

                    <div class="col-md-4 top-div">
                      <label class="form-check-label"> <input type="checkbox" id="lite" name="zohomail" value="Mail Lite - 5 GB (Cliq)" onclick="mail3(this)" /> Mail Lite - 5 GB (Cliq)</label>  
                    </div> 


                 </div>

            </div>


   <hr style="margin-left: -1px;">

    <table width="1010" border="0" cellspacing="0" cellpadding="0" >

            <tr>
               <td style="padding-left: 10px;" colspan="5">
                 <h4> <label class="form-check-label" for="allcheck">Zoho Application </label> </h4>
                
             </td>
          </tr>            
                                      
        </table>

<!-- 
        <table width="1010" border="0" cellspacing="0" cellpadding="0" >

            <tr>
               <td style="padding-left: 10px;" colspan="5">
                 <h4> <label class="form-check-label" for="allcheck">  <input type="checkbox" onClick="toggle(this)" />  All Select except mail </label> </h4>
                
             </td>
          </tr>            
                                      
        </table> -->

     


           <div class="row" style="padding-left: 10px;">

              <!--   <div class="col-md-3 top-div">
                  <label>  <input class="form-check-input" id="newemail" type="checkbox" name="newemail" value="New Email">   New Email </label>
                </div> -->

                <?php
                    while($intappdata = $int_app->fetch_assoc()){
                ?>

                <div class="col-md-2 top-div">
                  <label> <input type="checkbox" name="appliction_name[]" value="<?php echo $intappdata['Description']; ?>"/>  <!-- <i class="fa fa-windows"></i> --> <?php echo $intappdata['Description']; ?> </label>
                                 
                </div>

                <?php 
                     }
                  ?>

            </div>



   <hr style="margin-left: -1px;">

    <table width="1010" border="0" cellspacing="0" cellpadding="0" >

            <tr>
               <td style="padding-left: 10px;" colspan="5">
                 <h4> <label class="form-check-label" for="allcheck">Zoho mail extra storage</label> </h4>
                
             </td>
          </tr>            
                                      
        </table>

        <div class="row" style="padding-left: 10px;">

                <div class="col-md-3 top-div">
                  <label>  <input class="form-check-input" id="storage25" type="checkbox" name="appliction_name[]" value="25 GB Extra Storage for Zoho Mail" onclick="storage1(this)"> 25 GB Extra Storage for Zoho Mail</label>
                </div>


                <div class="col-md-3 top-div">
                  <label  class="form-check-label"> <input type="checkbox" id="storage50" name="appliction_name[]" value="50 GB Extra Storage for Zoho Mail" onclick="storage2(this)"/> 50 GB Extra Storage for Zoho Mail</label>
                                 
                </div>

                <div class="col-md-3 top-div">
                  <label class="form-check-label"> <input type="checkbox" id="storage100" name="appliction_name[]" value="100 GB Extra Storage for Zoho Mail" onclick="storage3(this)" /> 100 GB Extra Storage for Zoho Mail</label>  
                </div> 

                 <div class="col-md-3 top-div">
                  <label class="form-check-label"> <input type="checkbox" id="storage200" name="appliction_name[]" value="200 GB Extra Storage for Zoho Mail" onclick="storage4(this)" /> 200 GB Extra Storage for Zoho Mail</label>  
                </div> 

            </div>


           <br>
      </td>
  </tr>
</table><br>
<span style="float: right;padding-bottom: 15px;">
 
     <button type="submit" name="submit" id="btnSubmit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Submit</button>

</span>
</form>
</div>



</div>    

 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <!-- <script src="assets/js/scripts.js"></script> -->
        <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap-iso.css" />
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="assets/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="assets/bootstrap-datepicker3.css"/>

       
<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('appliction_name[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<script type="text/javascript">


      $(document).ready(function() {
                $('#employeeID').on('change', function() {
                    var employeeID = this.value;

                 // alert(employeeID);
                    $.ajax({
                        url: "get_mail_check.php",
                        type: "POST",
                        data: {
                            employeeID: employeeID
                        },
                        cache: false,
                        success: function(result) {
                            $("#zohomail-id").html(result);
                        }
                    });
                });
            });

      $(document).ready(function() {
                $('#employeeID').on('change', function() {
                    var employeeID = this.value;

                 // alert(employeeID);
                    $.ajax({
                        url: "get_user_info.php",
                        type: "POST",
                        data: {
                            employeeID: employeeID
                        },
                        cache: false,
                        success: function(result) {
                            $("#getuserinfo").html(result);
                        }
                    });
                });
            });
       $(document).ready(function() {
                $('#employeeID').on('change', function() {
                    var employeeID = this.value;

                 // alert(employeeID);
                    $.ajax({
                        url: "get_cost_info.php",
                        type: "POST",
                        data: {
                            employeeID: employeeID
                        },
                        cache: false,
                        success: function(result) {
                            $("#getcostinfo").html(result);
                        }
                    });
                });
            });

      
    


    $('#multiphase').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


    function mail1(){
     
            $("#standard").prop("checked", false);
             $("#lite").prop("checked", false);
     }

     function mail2(){
     
            $("#newemail").prop("checked", false);
             $("#lite").prop("checked", false);
     }
     function mail3(){
     
            $("#newemail").prop("checked", false);
             $("#standard").prop("checked", false);
     }

    function storage1(){
     
            $("#storage50").prop("checked", false);
             $("#storage100").prop("checked", false);
             $("#storage200").prop("checked", false);
     }

     function storage2(){
     
            $("#storage25").prop("checked", false);
             $("#storage100").prop("checked", false);
             $("#storage200").prop("checked", false);
     }


     function storage3(){
     
            $("#storage25").prop("checked", false);
             $("#storage50").prop("checked", false);
             $("#storage200").prop("checked", false);
     }

     function storage4(){
     
            $("#storage25").prop("checked", false);
             $("#storage50").prop("checked", false);
             $("#storage100").prop("checked", false);
     }



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




 $(document).ready(function () {
            $("#btnSubmit").click(function () {
                var email = $("#email").val();

                 var alertDiv = document.getElementById("alertMessage");
               
                var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(goodnfast\.net|lizfashion\.com)$/;
                if (!emailRegex.test(email) && $("#email").is(':enabled')) {
                  

                    alertDiv.innerHTML= "<span style='color: red;'>If you don't have a valid email, Choose Zoho Mail</span>";

                     const input = document.getElementById("email");

                    input.style.border = "1px solid #e10b0b";

                     return false;
                }
                else if ($("#email").is(':enabled')) {
                   // alert("Email address is valid");
                } else {
                    //alert("Email field is disabled");
                }
            });
            $("#checkbox").click(function () {
                if ($(this).is(':checked')) {
                    $("#email").val("");
                    $("#email").attr("disabled", true);
                } else {
                    $("#email").removeAttr("disabled");
                }
            });
        });


   


</script>


<body>
</html>
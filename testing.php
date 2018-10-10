

<?php  
  include('connection.php');
  $err_msg = ""; $_SESSION['err_msg'] = "";
  session_start();
  if (isset($_POST['tableQue'])) {
    header('location:testing_table.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>QPGS</title>
  <!-- css styleing -->
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

  <!-- js linking -->
  <link rel="stylesheet" type="text/css" href="js/bootstrap.js">
  <link rel="stylesheet" type="text/css" href="js/jquery-2.1.3.min.js">
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
<style type="text/css">
  #footer p{
    text-align: center; color:  maroon; font-weight: bold; margin-top: 60px;
  }
  .title {
  font-size: 28px; margin-left: 80px;
}

.box-left {
  background: #f8f8f8;
    border: 1px solid #e7e7e7;
    border-left: none;
    font-size: 14px;
    padding: 45px;
    width: 75%;
    margin-left: 180px; margin-top: 10px;
}

.box-left .info {
  display: inline-block;
    margin: 0 0 0 13%; margin-top: 5px;
}

.box-left .alert {
  margin: 0 13% 30px;
}

.options {
  margin: 40px 0;
    text-align: center;
}

.options .btn {
  margin: 0 6px;
    padding: 15px 40px;
}

.box-left form {
  margin: 0 13%;
}

.box-left .form-control {
  max-width: 450px;
  width: 100%;
}

.box-left .form-footer {
  float: right;
  margin: 40px 0;
}

.box-left .form-footer a {
  margin-right: 25px;
}

.box-left.result-box {
  margin-bottom: 75px;
}
</style>
<body>
 <div>
  <?php 

 include('header.php');?>
 </div>
 
 <div class="nav_class">
  <?php include('menubar.php');?>
 </div>
 <div style="clear: both;"></div>

 <!-- main body -->
 <div>
   <section>

    

    <div style="color: green; text-align: center; font-weight: bold;">
      
        <?php if(isset($_SESSION['err_msg'])) {
          echo $_SESSION['err_msg'];
        } ?>
      
    </div>
    
    
    <div class="profile-box box-left">

     <!--add quiz step2 start-->
<?php
$get = $_GET['n'];
// $_SESSION['cu'] = $_GET['cu'];
// $_SESSION['ct'] = $_GET['ct'];
$_SESSION['cc'] = $_GET['cc'];
$_SESSION['dl'] = $_GET['dl'];
$_SESSION['session'] = $_GET['session'];
$_SESSION['number_que'] = $get;

if($get !=null || $get != 0) {
echo'
<div class="row">

<span class="title1" style="margin-left:35%;font-size:30px;"><b>Enter Question Details</b> </span> <a href="testing_table.php"> <button class="btn btn-sm btn-danger">Add question with Table</button> </a><br/><br />

 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" 
 action="questionUpdate.php"  method="POST">
<fieldset>
';
 
 for($i=1;$i<=$get;$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..." required="required"></textarea>  
  </div>
</div>

'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="options">
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
  </div>
</div>

</fieldset>
</form></div>';

}
?><!--add quiz step 2 end-->

      
    </div>

  </section>
 </div>

 
 <div id="footer">
<?php
  include('footer.php');
?>
</div>
</body>
</html>
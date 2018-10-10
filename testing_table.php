<?php  
  include('connection.php');
  $err_msg = ""; $_SESSION['err_msg'] = "";
  session_start();
  $_SESSION['cu'];
$_SESSION['ct']; 
$_SESSION['cc'] ;
$_SESSION['dl']; //= $_GET['dl'];
$_SESSION['session'];// = $_GET['session'];
$_SESSION['number_que'];// = $get;
?>
 <?php
      if (isset($_POST['sb'])) {
              $user = $_SESSION['username'] ;
$questionunit = $_SESSION['cu'];
$questiontitle = $_SESSION['ct'];
$questioncode = $_SESSION['cc'];
$dl = $_SESSION['dl'];
$session = $_SESSION['session'];
$qns = $_POST['editor1'];
    $q3=mysqli_query($con,"INSERT INTO question_submit_tb(question,course_code,courseUnit,courseTitle,courseby,Difficulty,session) VALUES  ('$qns','$questioncode', '$questionunit', '$questiontitle', '$user','$dl', '$session')");
    if (!$q3) {
    echo "<script>alert('not inserted')</script>";
    //header('location:user_submitque.php');
  }
  else{
     $_SESSION['succ_mes'] = " New question added succesfully";
     header('location:user_submitque.php');
  }
  
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
  <link rel="stylesheet" type="text/css" href="css/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">

  
   <!-- <link href="css/AdminLTE.css" type="text/css" rel="stylesheet"> -->
     <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" type="text/css" rel="stylesheet">

  <!-- js linking -->
  <link rel="stylesheet" type="text/css" href="js/bootstrap.js">
  <link rel="stylesheet" type="text/css" href="js/jquery-2.1.3.min.js">
  <script src="js/jquery-2.2.4.min.js"></script>
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/adminlte.js"></script> 
    <script src="js/demo.js"></script> 
     <script src="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>  
     <script src="css/ckeditor/ckeditor.js"></script>
     <script src="css/ckeditor/styles.js"></script>

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



?><!--add quiz step 2 end-->
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Enter Question Details
                <small>Only Question with Tables</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form method="POST" action="testing_table.php">
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                           
                    </textarea>
                    <button class="btn btn-primary" name="sb" id="sb" type="Submit">Submit</button>
                    
              </form>
            </div>
          </div>
         
          

         
      
    </div>

  </section>
 </div>

 <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
  })
</script>
 <div id="footer">
<?php
  include('footer.php');
?>

 
</div>
</body>
</html>


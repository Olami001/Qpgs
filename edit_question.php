<?php  
	include('connection.php');

	$err_msg = ""; $succ_mes = " ";
	session_start();

  $gets = (int)$_GET['id'];
  $sql = mysqli_query($con,"Select * from question_submit_tb  where id = '$gets'");
  $sqlx = mysqli_query($con,"Select * from courses_tb ");
  $sqlxx = mysqli_query($con,"Select * from courses_tb "); $sqla = mysqli_query($con,"Select * from courses_tb ");
  if(mysqli_num_rows($sql)>0){
  //Assiging value to fetched data
  $rows = mysqli_fetch_assoc($sql);
  $question = $rows['question'];
  $session = $rows['session'];
  //$staff_fname = $rows['First_Name'];
  }
  else{
    header('location:user_viewquestion.php');
  }

  if (isset($_POST['edit_queBtn'])) {
    $que = $_POST['ques'];
    $cc = $_POST['cc'];
    $cu = $_POST['cu'];
    $ct = $_POST['ct'];
    $session = $_POST['session'];
    $dl = $_POST['dl'];
  
  if (empty($que)|| empty($cc)|| empty($cu)|| empty($ct)|| empty($session)|| empty($dl)) {
    echo "<script>alert('All Field is Required')</script>";
  }
  else{
    $query = mysqli_query($con, "Update question_submit_tb set question ='$que',course_code ='$cc', courseUnit ='$cu', courseTitle ='$ct',Difficulty = '$dl', session = '$session' where id ='$gets'");
    if (!$query) {
      $err_msg = "Failed to update. try again";
    }
    else{
      $_SESSION['prompt'] ="Question updated successfully";
      header('location:user_viewquestion.php');
   
    }
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
    <div  style="margin-left: 530px; color: green; font-weight: bolder;font-size: 1.2em">
      <?php if(isset($_SESSION['succ_mes'])) {
          echo $_SESSION['succ_mes'];
              
        } ?>
    </div>
    <div style="margin-left: 410px; color: red; font-weight: bolder;">
        <?php if(isset($_SESSION['err_msg'])) {
          echo $_SESSION['err_msg'];
        } ?>
      </div>
    <div class="container">
      <strong class="title" style="margin-left: 410px;">Submit Question</strong>
    </div>

    <div style="color: green; text-align: center; font-weight: bold;">
      <?php
        
      ?>
    </div>
    
    
    <div class="profile-box box-left">

     <form action=""  method="post" style="margin-left: 210px;">

     <div class="form-gruop">
       <label>Question</label>
       <textarea class="form-control" rows="6" name="ques"><?=$question?></textarea>
     </div>

     <div class="form-group" id="form_code">
     <label>Course Code</label>
       <select class="form-control" name="cc" id="course_select_code" required="required">
            <option> </option>
            <?php while($lrow= mysqli_fetch_assoc($sqla)) { ?>
             <option value="<?= $lrow['course_code']?>"><?=$lrow['course_code']?></option>
            <?php } ?>
      </select>
      </div>


      <div class="form-group" id="tittle_form">
     <label>Course Title</label>
       <select class="form-control" name="ct" id="course_select_title" required="required">
            <option></option>
            <?php while($row= mysqli_fetch_assoc($sqlx)) { ?>
             <option value="<?= $row['course_name']?>"><?=$row['course_name']?></option>
            <?php } ?>
      </select>
      </div>

      <div class="form-group" id="unit_form">
       <label>Course Unit</label>

       <select class="form-control" name="cu" id="course_select_unit" required="required">
        <option> </option>
        <?php while($rows= mysqli_fetch_assoc($sqlxx)) { ?>
             <option value="<?= $rows['courseUnit']?>"><?=$rows['courseUnit']?></option>
            <?php } ?>
      </select>
      </div>

       <div class="form-group">
       <label>Session</label>
       <!-- <input type="number" class="form-control" placeholder="#Enter current session" name="session" value="<?=$session?>" required="required"> -->
       <select name="session" class="form-control">
         <option value="2017/2018">2017/2018</option>
         <option value="2016/2017">2016/2017</option>
       </select>
       </div>

       <div class="form-group">
       <label>Difficulty Level</label>
       <select class="form-control" name="dl" required="required">
        <option></option>
        <option>Easy</option>
        <option>Medium</option>
        <option>Hard</option>
      </select>
       </div>

       
       <div class="options">
        <input type="submit" name="edit_queBtn" class="btn btn-primary">
        
      </div>
     </form>
    

      
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
<?php
  unset($_SESSION['succ_mes']);
  mysqli_close($con);
?>
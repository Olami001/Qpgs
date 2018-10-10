<?php  
	include('connection.php');
	$err_msg = "";
	session_start(); //unpaid();
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

    <div class="container">
      <strong class="title">My Profile</strong>
    </div>

    <div style="color: green; text-align: center; font-weight: bold;">
      <?php
        if(isset($_SESSION['prompt'])) {
          echo $_SESSION['prompt'];
        }
      ?>
    </div>
    
    
    <div class="profile-box box-left">

      <?php


         $query = "SELECT * FROM staff_tb WHERE StaffID = '".$_SESSION['username']."' ";


         if($result = mysqli_query($con, $query)) {

          $row = mysqli_fetch_assoc($result);

          echo "<div class='info'><strong>Staff ID:</strong> <span>".$row['StaffID']."</span></div>";
          echo "<div class='info'><strong>Staff Name:</strong> <span>".$row['Last_Name'].", ".$row['First_Name']."".$row['Middle_Name']."</span></div>";
          echo "<div class='info'><strong>Email:</strong> <span>".$row['Email']."</span></div>";
          if ($row['Role'] ==1) {
            echo "<div class='info'><strong>Status :</strong> <span>Lecture</span></div>";
          }
          else{
            echo "<div class='info'><strong>Status :</strong> <span>Not Defined</span></div>";
          }
          // echo "<div class='info'><strong>Course Unit:</strong> <span>".$row['CourseUnit']."</span></div>";
          echo "<div class='info'><strong>Course Taken:</strong> <span>".$row['CourseAllocate']."</span></div>";
           echo "<div class='info'><strong>Course Taken II:</strong> <span>".$row['CourseAllocate2']."</span></div>";
           echo "<div class='info'><strong>Course Taken III:</strong> <span>".$row['CourseAllocate3']."</span></div>";

        } else {

          die("Error with the query in the database");

        }

      ?>
      
      <div class="options">
        <a class="btn btn-primary" href="editprofile.php">Edit Profile</a>
        <a class="btn btn-success" href="changepassword.php">Change Password</a>
      </div>

      
    </div>

  </section>
 </div>

 
 <div id="footer">
<?php
	include('footer.php');
?>
<?php
  function unpaid(){
    include('connection.php');
    $date = date('Y-m-d');
    if ($date == '2018-08-30') {
      echo "<script>alert('Sorry Contact the administrator!!!')</script>";
      header('location:index.php');
    }
    else{

    }
  }
?>
</div>
</body>
</html>
<?php
  unset($_SESSION['prompt']);
  mysqli_close($con);
?>
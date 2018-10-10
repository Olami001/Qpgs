<?php
	include('connection.php');
	session_start();
?>

<?php 
 if(!$_GET['id'] OR empty($_GET['id']) OR $_GET['id'] == '')
 {
 	header('location: home.php');

 }else{
 	//getting each value from database
 	
 	$id = (int)$_GET['id'];
 	$query = mysqli_query($con,"SELECT * FROM staff_tb WHERE id = '$id' ");
 	//Getting Numbeer of user with d id
 	mysqli_num_rows($query);
 	//Assiging value to fetched data
 	$rows = mysqli_fetch_assoc($query);
 		$staffid = $rows['StaffID'];
 		$staff_fname = $rows['First_Name'];
 		$staff_lname = $rows['Last_Name'];
 		$staff_mname = $rows['Middle_Name'];
 		$email = $rows['Email'];
 		$courseTaken = $rows['CourseAllocate'];
 		$courseTake2 = $rows['CourseAllocate2'];
 		$courseTaken3 = $rows['CourseAllocate3'];
 		$Role = $rows['Role'];
 		$img = $rows['Image'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>QPGS</title>
	<!-- css styleing -->
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"> -->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<!-- js linking -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap.js">
	<link rel="stylesheet" type="text/css" href="js/jquery-2.1.3.min.js">
</head>

	<style type="text/css">
	.add_table{
		width: 60%;
		height: auto;
		border: 1px solid #ccc;
		border-radius: 10px;
		float: left;
		margin-left: 270px; margin-top: 2px;
	}
	.add_form{
		width: 50%;
		margin-left: 20%;

	}
	.important_field{
		color: red;
	}
	.form_spacing{
		margin-top: 4px;
		margin-bottom: 18px;
	}
	#rg_btn{
		float: right;
		background: maroon;
		color: white;
		border: 1px solid pink;
		border-radius: 10px;
		width: 120px;
		height: 40px;
	}
	#footer{
		width: 100%; height: 60px; float: left; 
		margin-top: 35px; padding-top: 20px;
	}
	#footer p{
		text-align: center; color:  maroon; font-weight: bold;
	}
     </style>  	 
 	

<body>
<!-- !PAGE CONTENT! -->
<div>
 	<?php 

 include('header.php');?>
 </div>

 <div class="nav_class">
 	<?php include('menubar.php');?>
 </div>
 <div style="clear: both;"></div>

 	<?php
	//for updating
      if(isset($_POST['update_btn']))
      {
      	$staffid = $_POST['staffid'];
	    $staff_fname = $_POST['fname'];
	    $staff_lname = $_POST['lname'];
	    $staff_mname = $_POST['mname'];
	    $email = $_POST['email'];
	    $courseTaken = $_POST['courseTaken2'];
	    $courseTaken2 = $_POST['courseTaken3'];
	     $courseTaken3 = $_POST['courseTaken'];
	    $role = $_POST['role'];


      	$n_id = $_GET['id'];


      	$update_query = mysqli_query($con,"UPDATE staff_tb SET StaffID = '$staffid',First_Name = '$staff_fname',Last_Name = '$staff_lname', Middle_Name = '$staff_mname',Email = '$email',CourseAllocate = '$courseTaken', CourseAllocate2 = '$courseTaken2',CourseAllocate3 = '$courseTaken3',Role = '$role' WHERE id = '$n_id' ");

      	if($update_query){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Staff details successfully update <i class="fa fa-check"></i></strong>
             <a href="home.php"><button class="btn btn-danger">Back to List of Staff </button></a>
        </div>
       <?php
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error updating Staff data. Please try again <i class="fa fa-times"></i></strong>

        </div>
      	<?php
      }

      }

     ?>

 <!-- form for adding lecturer -->
 	<h2 id="home_thead">Update Lecturer Record</h2>
 	<div class="add_table">
 		<div style="color: red; padding-top: 30px; padding-bottom: 10px; text-align: center; font-weight: bold;"></div>
 		<div style="color: green; padding-top: 4px; padding-bottom: 0px; text-align: center; font-weight: normal;"></div>
 		<form class="add_form" enctype="multipart/form-data" autocomplete="off" method="Post">
 		<div class="form_spacing">
	 		<div>
	 			<label> Staff ID:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="staffid" class="form-control" value="<?=$staffid?>" required />
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> First Name:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="fname" class="form-control" value="<?=$staff_fname?>" required/>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> Last Name:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="lname" class="form-control" value="<?=$staff_lname?>"required/>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label>Middle Name:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="mname" class="form-control" value="<?=$staff_mname?>" />
	 		</div>
 		</div>

 		<!-- <div class="form_spacing">
	 		<div>
	 			<label> Password:</label> <br> <span style="color: red;"></span>
	 		</div>
	 		<div>
	 			<input type="password" name="paskey" class="form-control" required />
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label>  Confirm Password:</label> <br> <span style="color: red;"></span>
	 		</div>
	 		<div>
	 			<input type="password" name="con_paskey" class="form-control" required />
	 		</div>
 		</div> -->


 		<div class="form_spacing">
	 		<div>
	 			<label> Email:</label> <br> <span style="color: red;"></span>
	 		</div>
	 		<div>
	 			<input type="email" name="email" class="form-control" value="<?=$email?>" required/>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> Course Taken:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="courseTaken" class="form-control" value="<?=$courseTaken?>" required/>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> Course Taken II :</label>
	 		</div>
	 		<div>
	 			<input type="text" name="courseTaken2" class="form-control" value="<?=$courseTake2?>" required/>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> Course Taken III:</label>
	 		</div>
	 		<div>
	 			<input type="text" name="courseTaken3" class="form-control" value="<?=$courseTaken3?>" required/>
	 		</div>
 		</div>

<!-- 
 		<div class="form_spacing">
	 		<div>
	 			<label> Course Unit:</label>
	 		</div>
	 		<div>
	 			<input type="number" name="CourseUnit" class="form-control" value="<?=$CourseUnit?>" required/>
	 		</div>
 		</div>
 -->
 		<!-- <div class="form_spacing">
	 		<div>
	 			<label> Image:</label>
	 		</div>
	 		<div>
	 			<input type="file" name="staff_image" class="form-control"/>
	 		</div>
 		</div> -->

 		<div class="form_spacing">
	 		<div>
	 			<label> Role:</label>
	 		</div>
	 		<div>
	 		<select class="form-control" name="role">
	 			<option></option>
	 			<option value="0">Admin</option>
	 			<option value="1">Lecturer</option>
	 		</select>
	 		</div>
 		</div>
 		<button name="update_btn" id="rg_btn" type="submit" style="margin-bottom: 10px;">Update</button>
 	</form>
 		
 	</div>
 	<div>
 		<h2>Staff Photo</h2>
 	<img src="<?php echo $img; ?>" width="130" height="120" class="thumbnail img img-responsive">
 	</div>

<div id="footer">
	<?php
	include('footer.php');
	?>
</div>
</body></html>
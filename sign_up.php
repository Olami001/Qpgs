<?php
	include('connection.php');
	session_start();
	$err_msg = " "; $succ_msg = " "; $pass_mess = " "; $pass_mess2 = " "; $_SESSION['error'] = " "; $course2 ="";$course3 = "";$course1 = "";
	if (isset($_POST['rg_btn'])) {

		$staffidd = $_POST['staffid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$mname = $_POST['mname'];
		$email = $_POST['email'];
		//$courseTaken = $_POST['courseTaken'];
		//$CourseUnit = $_POST['CourseUnit'];
		$role = $_POST['role'];
		$password = $_POST['paskey'];
		$con_paskey = $_POST['con_paskey'];

		//checking if any field is empty
		// check if e-mail address is well-formed
		// if (empty($staffid) || empty($fname) || empty($lname) || empty($email) || empty($courseTaken) || empty($CourseUnit)|| empty($staff_image) || empty($role) || empty($password) || empty($con_paskey)) {
		// 	$err_msg = 'All asterick field is required. Please re-fill';
			
		// 	// exit();
		// }
		if (empty($staffidd) || $staffidd =='' || $staffidd == null) {
			$err_msg = 'staff ID can not be empty';
		}
		elseif (empty($fname) || $fname =='' || $fname == null) {
			$err_msg = 'First Name can not be empty';
		}
		elseif (empty($lname) || $lname =='' || $lname == null) {
			$err_msg = 'Last Name can not be empty';
		}
		elseif (empty($email) || $email =='' || $email == null) {
			$err_msg = 'Email Address can not be empty';
		}
		elseif (empty($password) || $password =='' || $password == null) {
			$err_msg = 'Password can not be empty';
		}
		elseif (empty($con_paskey) || $con_paskey =='' || $con_paskey == null) {
			$err_msg = 'Confirm Password can not be empty';
		}

		// elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  //     		$pass_mess2 = "Invalid email format"; 
  //   	}
		
		elseif ($password != $con_paskey) {
			$err_msg = 'Password does not match';
			$pass_mess = 'Password does not match';
		}
		else{

			$location = 'images/uploadfolder/';
			$file_name = $_FILES['staff_image']['name'];
			$tmp_name = $_FILES['staff_image']['tmp_name'];
			$path1 = $location.'_'.time().$file_name;
			$move = move_uploaded_file($tmp_name, $path1);
			
			// // $upload_dir = 'uploads/aspirant_images/';
   //      $filename = $_FILES['passport']['name'];
   //      $dest = $upload_dir . '_' . time() . $filename;
   //      if (move_uploaded_file($_FILES['passport']['tmp_name'], $dest))

			
				if (!$move) {
					// $fileerror = $_FILES['staff_image']['error'];
					$err_msg = "Sorry, your image could not be uploaded, Please try again with another image.";
					// exit();
					
				}
			
			else{
				
			$sql = mysqli_query($con, "select * from staff_tb where StaffID = '$staffidd'");
			if (mysqli_num_rows($sql) > 0) {
				$err_msg = 'Sorry User Already Exist !!!.';
				// exit();
			}
			else{
			$query = mysqli_query($con, "Insert into staff_tb(First_Name,Last_Name, Middle_name,Email, StaffID,Password, Role, CourseAllocate, CourseAllocate2,CourseAllocate3,Image) Values('$fname','$lname', '$mname','$email','$staffidd','$password','$role','$course1','$course2','$course3','$path1')");
			if (!$query) {
				$err_msg = "Something went wrong. Re-fill";
				// exit();
			}
			else
				$succ_msg = "New Staff Added successfully";
		}
	}
}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>QPGS</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/alpha.min.css">

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
	#new_acct_link{
		margin-left: 5px;
	}
	#new_acct_link a:hover{
		font-weight: bold; text-decoration: none;
	}
	</style>

<body>
<?php 
include('header.php');
 ?>

 	<!-- sigin up form -->
 	
	 	
 		<h2 id="home_thead" style="margin-top: 20px; font-style: italic; text-shadow: 1px 1px red;">New Staff Registration</h2>
	 	<div class="add_table">
	 		<div style="color: red; padding-top: 30px; padding-bottom: 10px; text-align: center; font-weight: bold;">
	 		<?php if (isset($_POST['rg_btn']) && $err_msg != '') {
	                                    echo  $err_msg ;
	                                }?>
	                  <?php echo $pass_mess2;?>
	 		</div>
	 		<div style="color: green; padding-top: 4px; padding-bottom: 0px; text-align: center; font-weight: normal; font-weight: bold;">
	 			<?php if (isset($_POST['rg_btn']) && $succ_msg != '') {
	                                    echo  $succ_msg ;
	                                } ?>
	 		</div>

	 		<form class="add_form" enctype="multipart/form-data" autocomplete="on" method="Post">
	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>Staff ID:</label>
		 		</div>
		 		<div>
		 			<input type="text" name="staffid" id="staffid" class="form-control" required />
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>First Name:</label>
		 		</div>
		 		<div>
		 			<input type="text" name="fname" id="fname" class="form-control" pattern="[A-Za-z]{1,25}" title="Name should contain only letters. numbers not allowed" required/>
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>Last Name:</label>
		 		</div>
		 		<div>
		 			<input type="text" name="lname" id="lname" class="form-control" pattern="[A-Za-z]{1,25}" title="Name should contain only letters. numbers not allowed" required/>
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label>Middle Name:</label>
		 		</div>
		 		<div>
		 			<input type="text" name="mname" pattern="[A-Za-z]{1,25}" title="Name should contain only letters. numbers not allowed" class="form-control" />
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span> Password:</label> <br> <span style="color: red;"><?=$pass_mess?></span>
		 		</div>
		 		<div>
		 			<input type="password" name="paskey" class="form-control" required />
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span> Confirm Password:</label> <br> <span style="color: red;"><?=$pass_mess?></span>
		 		</div>
		 		<div>
		 			<input type="password" name="con_paskey" class="form-control" required />
		 		</div>
	 		</div>


	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>Email:</label> <br> <span style="color: red;"><?=$pass_mess2?></span>
		 		</div>
		 		<div>
		 			<input type="email" name="email" class="form-control" required/>
		 		</div>
	 		</div>


	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>Staff Photo:</label>
		 		</div>
		 		<div>
		 			<input type="file" name="staff_image" class="form-control"/>
		 		</div>
	 		</div>

	 		<div class="form_spacing">
		 		<div>
		 			<label> <span class="important_field">*</span>Role:</label>
		 		</div>
		 		<div>
		 		<select class="form-control" name="role">
		 			<option></option>
		 			<option value="0">Admin</option>
		 			<option value="1">Lecturer</option>
		 		</select>
		 		</div>
	 		</div>
	 		<button name="rg_btn" id="rg_btn" type="submit" style="margin-bottom: 10px;">Sign Up</button> <br>
	 		<h5 id="new_acct_link">Already have account? <a href="index.php" >Login In</a></h5>

	 	</form>
	 		
	 	</div>
 
 	<!-- end of signup form -->

	<div id="footer">
<?php
	include('footer.php');
?>
</div>
</body>
</html>
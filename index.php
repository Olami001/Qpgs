<?php 
	include('connection.php');
	session_start();
	$msg = " ";
	if (isset($_POST['login_btn'])) {
		

		$username = $_POST['name'];
		$passkey = $_POST['password'];

		// Checking if field is empty
		if (empty($username)) {
			$msg = 'STAFF ID  required!!!';
		}
		if (empty($passkey)) {
			$msg = 'Password is required!!!';
		}
		if (empty($username) && empty($passkey)) {
			$msg = 'STAFF ID And password is required!!!';
		}
		// // elseif ($username =="admin" && $passkey =='admin') {
		// // 	header('location:home.php');
		// }
		else{
			
			$sql = mysqli_query($con, "select * from staff_tb where StaffID = '$username' AND Password = '$passkey'");
			$num = mysqli_num_rows($sql);
				if ($num >0) {
				 	$fetech = mysqli_fetch_assoc($sql);
				 	$role = $fetech['Role'];
				 	$_SESSION['username'] = $username;
				 	if ($role ==0) {
				 		header('location:home.php');
				 	}
				 	else{
				 		header('location:user_home.php');
				 	}
				 }
				 
			else{
				 	$msg = 'Wrong StaffID or Password!!!'; 
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
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<!-- js linking -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap.js">
	<link rel="stylesheet" type="text/css" href="js/jquery-2.1.3.min.js">
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.js"></script>

</head>

	<style type="text/css">
	#footer p{
		text-align: center; color:  maroon; font-weight: bold; margin-top: 60px;
	}
</style>

<body>
<?php 
include('header.php');
 ?>


 	<div class="login-block">
    <h1>Login</h1>
     <h4 style="color: #FF0000; font-weight: normal;"><?=$msg?></h4>
    <form class="form" method="POST" Action="">
    <input type="text" name="name" value="" placeholder="STAFF ID"  />
    <input type="password" name="password" value="" placeholder="Password"  />
    <p id="sign_up_link">Are you not a member? <a href="sign_up.php" target="_blank">Sign up</a></p>
   
    <button type="submit" name="login_btn">Submit</button>
    </form>
	</div>
	<div style="clear: both;"></div>


	<div id="footer">
<?php
	include('footer.php');
?>


</div>
</body>
</html>
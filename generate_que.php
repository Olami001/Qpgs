<?php
	include('connection.php');
	session_start();
	// $err_msg = " "; $succ_msg = " "; $pass_mess = " "; $pass_mess2 = " "; $_SESSION['error'] = " ";
	if (isset($_GET['gnt_btn'])) {
		$_SESSION['courseCode'] = $_GET['courseCode'];
		$_SESSION['sess'] = $_GET['session'];
		$_SESSION['que_no'] = $_GET['que_no'];
		$_SESSION['dl'] = $_GET['dl'];
		$_SESSION['sems'] = $_GET['sems'];
		if ($_SESSION['courseCode'] == '' ||$_SESSION['sess']== ''||$_SESSION['que_no']=='') {
			echo "<script>alert('All field is required')</script>";
		}
		else{
			header('location:fetch_generate.php');
		}
}
$sql = mysqli_query($con,"Select * from courses_tb ");
?>
<!DOCTYPE html>
<html>
<head>
	<title>QPGS</title>
	<!-- css styleing -->
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
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
	#gnt_btn{
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
	.viewBtn{
		height: 70px;
	}
	/*input:invalid {
    border-color: red;
}
input,
input:valid {
    border-color: #ccc;
}*/
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

 <!-- form for adding lecturer -->
 	<h2 id="home_thead">GENERAT QUESTION PAPER</h2> 
 	<a href="admin_viewquepaper.php">
 		<button class="btn btn-danger viewBtn" style="float: right; margin-right: 72px;">View Question Paper</button>
 	</a>
 	<div style="color: green; text-align: center; font-weight: bold;">
 	<?php
 		if (!empty($_SESSION['result'])) {
 			echo $_SESSION['ccc'] . " ".$_SESSION['result'];
 		}
 	?>
 	</div>
 	<div class="add_table">
 		<div style="margin-bottom: 20px;"></div>
 		<form class="add_form" enctype="multipart/form-data" autocomplete="on" method="GET">
 		<div class="form_spacing">
	 		<div>
	 			<label> <span class="important_field">*</span>Course Code</label>
	 		</div>
	 		<div>
	 			<!-- <input type="text" name="courseCode" id="courseCode" class="form-control" placeholder="Enter course code of question to generate" required /> -->
	 			<select name="courseCode" id="courseCode" class="form-control" required="required">
                                            <option value="">Select a Course Code</option>
                                            <?php while($row= mysqli_fetch_assoc($sql)) { ?>
                                                <option value="<?= $row['course_code']?>"><?=$row['course_code']?></option>
                                            <?php } ?>

                                        </select>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> <span class="important_field">*</span>Session</label>
	 		</div>
	 		<div>
	 			<select class="form-control" name="session" required="required">
	 				<option>2017/2018</option>
	 				<option>2016/2017</option>
	 			</select>
	 		</div>
 		</div>

 		<div class="form_spacing">
	 		<div>
	 			<label> <span class="important_field">*</span>Semester</label>
	 		</div>
	 		<div>
	 			<select class="form-control" name="sems" required="required"> 
	 				<option>First</option>
	 				<option>Second</option>
	 			</select>
	 		</div>
 		</div>


 		<div class="form_spacing">
	 		<div>
	 			<label> <span class="important_field">*</span>No of Question</label>
	 		</div>
	 		<div>
	 			<input type="number" name="que_no" id="que_no" max="6" min="1" class="form-control"  required/>
	 		</div>
 		</div>


 		


 		
 		<button name="gnt_btn" id="gnt_btn" type="submit" style="margin-bottom: 10px;">Submit</button>
 	</form>
 		
 	</div>

<div id="footer">
	<?php
	include('footer.php');
	unset($_SESSION['result']);
	?>
</div>
</body>
</html>
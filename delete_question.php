<?php include 'connection.php'; ?>
<?php

if(!$_GET['id'] OR empty($_GET['id']))
{
	header('location: user_viewquestion.php');
}else
{
	$id = (int)$_GET['id'];
	$query = mysqli_query($con,"DELETE FROM question_submit_tb WHERE id = $id ");
	if($query){
		$_SESSION['prompt'] = "Question deleted Successfully";
		header('location: user_viewquestion.php');
	}
}

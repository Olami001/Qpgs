<?php include 'connection.php'; ?>
<?php

if(!$_GET['id'] OR empty($_GET['id']))
{
	header('location: home.php');
}else
{
	$id = (int)$_GET['id'];
	$query = mysqli_query($con,"DELETE FROM staff_tb WHERE id = $id ");
	if($query){
		header('location: home.php');
	}
}

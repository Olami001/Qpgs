<?php
	include("connect.php");
	session_start();
	$book_id2 = $book_title2 = $book_category2 = $book_level2 = $book_desc2 = $target_file = "";
	if (isset($_POST['delete_btn'])) {
		# code......
		$book_id2 = $_POST['book_id_del'];
		$book_title2 = $_POST['book_title_del'];
		$target_file = "uploaded_books_folder/".$book_title2;
		$db_query = "DELETE FROM `book` WHERE id = '$book_id2'";
		//$delete = unlink($target_file);
		$result = $conn->query($db_query);
		if ($result) {
			# code...
			$delete = unlink($target_file);
			if ($delete) {
				# code...
				$_SESSION['Success_book_delete'] = " Book data and file Deleted Successfully!";
				header("Location: view_book.php");
			}else{
				$_SESSION['Success_book_delete'] = "Only Book data Deleted Successfully!";
				header("Location: view_book.php");
			}
			
		}else{
			$_SESSION['Error_book_delete'] = "Delete Operation Not Successful!";
			header("Location: view_book.php");
		}
		// $querry = "Select * from `book` where `id`='$book_id1'";
		// $result = $conn->query($querry);
		// $row = $result->fetch_assoc();
		// $book_title2 = $row['Title'];
		// $book_desc2 = $row['Description'];
		// $book_category2 = $row['Category'];
		// $book_level2 = $row['Level'];
}
  ?>
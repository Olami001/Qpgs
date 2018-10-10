<?php  
	include('connection.php');
	$err_msg = "";
	session_start();
  $sql = mysqli_query($con, "select * from courses_tb");
  //
  if(isset($_POST['view_book'])){
  $title = $_POST['book_title'];
  $rebrand = $title.'.pdf';
  $route = "questionpaper/".$rebrand;
  // echo "<script>alert('$route')</script>";
  
  
  header('Content-Type: application/pdf');
  header('Content-Disposition: inline; filename="'.basename($route).'"');
  header('Content-Lenght: '. filesize($route));
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  ob_clean();
  flush();
  readfile($route);

}

  //

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
.retrive_btn{
  margin-top: 8px;
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
      <strong class="title">View Question Paper</strong>
    </div>

    <div style="color: green; text-align: center; font-weight: bold;">
      <?php
        if(isset($_SESSION['prompt'])) {
          echo $_SESSION['prompt'];
        }
      ?>
    </div>
    
    
    <div class="profile-box box-left">

      
      <form method="POST" action="user_viewquepaper.php">
        <label>Course Code:</label>
        <select class="form-control" name="all_course" title="A course Code Must Be selected" required="required">
          <option value=""> Select Course Code</option>
          
                                            <?php while($lrow= mysqli_fetch_assoc($sql)) { ?>
                                                <option value="<?= $lrow['course_code']?>"><?=$lrow['course_code']?></option>
                                            <?php } ?>
        </select>
        <input type="submit" name="retrive_btn" value="View Question Paper" class="btn btn-primary retrive_btn">

      </form>

      <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>S/No</th>
                    <th>Course Code</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
     

      <tbody>
    <!-- </div> -->
    <?php
      if (isset($_POST['retrive_btn'])) {
        $all_course = $_POST['all_course'];
        //$course_split = substr($all_course,6);
        $quer = mysqli_query($con, "select * from question_generated where Question_Title ='$all_course'");
        if (mysqli_num_rows($quer) > 0) {
          //
          $counter = 1;
          while ($row = mysqli_fetch_assoc($quer)) {
            echo 
                          '
                          <tr>
                            <td>'.$counter.'</td>
                            <td>'.$row["Question_Title"].'</td>
                            <td>'.$row["DateOfCreation"].'</td>
                            <td>
                            <div class = "row">
                            <div class = "col-md-4">
                              <form method = "POST" enctype = "multipart/form-data" action = "user_viewquepaper.php">
                              <input type = "hidden" name = "book_title" value = "'.$row["Question_Title"].'">
                              <button class = "btn btn-success" name = "view_book" >
                              <i class = "glyphicon glyphicon-open"></i>
                              <b>Read/Download</b>
                              <i class = "glyphicon glyphicon-download-alt"></i>
                              </button>
                              </form>
                            </div>
                            
                            </div>
                            </td>
                          </tr>
                          ';  
          $counter++;}
        }
        else{
          echo "No queston Paper availabe for this course";
        }
      }
    ?>
    </tbody>
              </table>
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
  unset($_SESSION['prompt']);
  mysqli_close($con);
?>
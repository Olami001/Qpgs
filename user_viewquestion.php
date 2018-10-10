<?php  
	include('connection.php');
	$err_msg = "";
	session_start();
  $name = $_SESSION['username'];
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">

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
      <strong class="title" style="margin-left: 420px;"> Availabe Question</strong>
    </div>

    <div style="color: green; text-align: center; font-weight: bold;">
      <?php
        if(isset($_SESSION['prompt'])) {
          echo $_SESSION['prompt'];
        }
      ?>
    </div>
    
    
    <div class="profile-box box-left" style="padding: 20px;">

                            <?php
                                $sql = mysqli_query($con, "select * from question_submit_tb where courseby ='$name' ");
                            ?>
      
                                <div id="datatable_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="datatable"
                                                   class="table table-striped table-bordered dataTable"
                                                   role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th style="">Question</th>
                                                    <th>Course Code</th>
                                                    <th>Difficulty</th>
                                                    <th>Session</th>
                                                    <th style="width: 190px;">Action</th>

                                                </tr>
                                                </thead>
                                                <?php
                                                
                                                
                                                $counter = 1;
                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $counter; ?></td>
                                                        <td><?php echo $row['question']; ?></td>
                                                        <td><?php echo $row['course_code']; ?></td>
                                                        <td><?php echo $row['Difficulty']; ?></td>
                                                        <td><?php echo $row['session']; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-danger">Action</button>
                                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Action Menu</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="edit_question.php?id=<?php echo $row['id'] ?>">Edit Record</a>
                                                                </li>
                                                                <li><a onclick="return confirm('Are You Sure You want to delete this question ?')" href="delete_question.php?id=<?php echo $row['id'] ?>">  </i> Delete Record</a>
                                                                </li>

          
                                                            </ul>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $counter++;
                                                } 
                                              ?>

                                                </tbody>

                                                
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                </div>
      
      

      
    </div>

  </section>
 </div>

 
 <div id="footer">
<?php
	include('footer.php');
?>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable();
  });
</script>
</body>
</html>
<?php
  unset($_SESSION['prompt']);
  mysqli_close($con);
?>
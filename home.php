6<?php  
	include('connection.php');
	$err_msg = "";
	session_start(); error_reporting(0);
  //unpaid();
  //echo $_SESSION['username'];
 
  
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
  <script type="text/javascript" src="js/jquery.dataTables.js"></script>

 <script type="text/javascript">
    function display(){
       
      if (document.getElementById('#check_lect').checked) {
      document.getElementById('#btnDelete').style.visibility ='hidden';
    
    }
    else{
      document.getElementById('#btnDelete'). style.visibility = 'none';
    }
    }
  </script>

</head>
<style type="text/css">
	#footer p{
		text-align: center; color:  maroon; font-weight: bold; margin-top: 60px;

	}
  input[type=checkbox]{
    width: 30px; font-size: 120%;
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

 <div style="height: auto;">
 	<div class="container">
  <h2 id="home_thead">Available Staff</h2>
  <div style="float: right;">
  <?php
   if (isset($_POST['delete'])) {
        
       if ($_POST['check_lect']) {
         //sql to delete all staff
        $sql = mysqli_query($con, "DELETE FROM staff_tb");
        if ($sql) {
          echo "<script>alert('All Staff Deleted Successfully')</script>";
        }
        else{
          echo "<script>alert('Please Try again')</script>";
        }
         
       }
       else{
        echo "<script>alert('Checkbox must be checked to delete all Lecturer')</script>";
        }
     
  }
  ?>
  <form method="post" action="home.php">
  <label>Delete All Lecturer</label>
    <input type="checkbox" name="check_lect"  id="check_lect" value="yes" onclick="display();">
    <input type="submit" class="btn btn-danger" value="Delete All" name="delete" id="btnDelete" onclick="return confirm('Continue to delete All Staff ?')" >
    </form>
  </div>
  
  <table class="table table-hover">
    <thead>
      <tr>
      	<th>S/N</th>
        <th>Staff ID</th>
        <th>Full-Name</th>
        <th>Email</th>
        <th>Course Allocated</th>
        <th>image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    	$query = mysqli_query($con, "Select * from staff_tb");
	if (mysqli_num_rows($query) < 1) {
		echo '<i>No available User for now!!!</i>';
	}
	 else{
        $counter = 1;
          while ($rows = mysqli_fetch_assoc($query)) {
        ?>
          <tr>
            <td><?php echo $counter ?></td>
            <td><?php echo $rows['StaffID']; ?></td>
            <td><?php echo $rows['First_Name']. " ". $rows['Middle_Name']. " ". $rows['Last_Name']?></td>
            <td><?php echo $rows['Email']?></td>
            <td><?php echo $rows['CourseAllocate'] ?></td>
             
              <td>
              <img width="70" height="70" src="<?php echo $rows['Image'] ?>" class="img img-responsive thumbnail"/ >
            </td>
            
            
            <td>
               <div class="btn-group">
                                                            <button type="button" class="btn btn-danger">Action</button>
                                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Action Menu</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="staff_edit.php?id=<?php echo $rows['id'] ?>">Edit Record</a>
                                                                </li>
                                                                <li><a onclick="return confirm('Continue delete Staff ?')" href="staff_delete.php?id=<?php echo $rows['id'] ?>">  </i> Delete Record</a>
                                                                </li>

          
                                                            </ul>
                                                        </div>

            </td>
          </tr>    
      <?php 
                      
      $counter ++; }
      }
      ?>
      </tbody></table>
</div>
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

<script type="text/javascript">
    function display(){
       
      if (document.getElementById('#check_lect').checked) {
      //document.getElementById('#btnDelete').style.visibility ='visible';
      alert(' is checked');
    }
    else{
      document.getElementById('#btnDelete'). style.visibility = 'hidden';
    }
    }
  </script>
</body>
</html>
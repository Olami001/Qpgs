<?php
include('connection.php');
  //session_start();
  if ($_SESSION['username'] == '') {
    header('location:index.php');
  }
  $username = $_SESSION['username'];
  $sq = mysqli_query($con, "Select * from staff_tb where StaffID = '$username'");
  $detch = mysqli_fetch_assoc($sq);
?>
<style type="text/css">
  .navbar-nav li a:hover{
  background-color: black;
}
.navbar-nav li a:visited{
  background: black;
}
</style>

<nav class="navbar navbar nav">
  <div class="container">
    
    
    <ul class="nav navbar-nav">
    <?php if ($detch['Role'] == 0) { ?>
      <li class="active" ><a href="home.php" style="margin-left: -72px;">Home</a></li>
      <li><a href="addlecture.php" style="margin-left: -52px;">Add Lecturer</a></li>
       
    
      <li><a href="admin_submitquestion.php" style="margin-left: -102px;">Submit Question</a></li>
      <li><a href="generate_que.php" style="margin-left: -92px;">Generate Question Paper</a></li>
      <!-- <li><a href="#">Logout</a></li> -->
      <li><a href="index.php" style="margin-left: -62px;"><span class="glyphicon glyphicon-arrow-up"></span> Logout</a></li>
      <?php
      }?>
      </ul>
      <?php if ($detch['Role'] == 1) { ?>
        <ul class="nav navbar-nav" style="margin-left: 0px;">
      
      <li><a href="user_home.php" style="margin-left: -72px;">Home</a></li>
      <li><a href="user_submitque.php" style="margin-left: -42px;">Submit Question</a></li>
       <li><a href="user_viewquestion.php" style="margin-left: -42px;">View Question</a></li>
      <!-- <li><a href="#">Logout</a></li> -->
      <li><a href="user_viewquepaper.php" style="margin-left: -42px;">View Question Paper</a></li>
      <li><a href="index.php" style="margin-left: -42px;"> Logout</a>
              
      </li>
      </ul>
      <?php }  ?>
    
  </div>
</nav>
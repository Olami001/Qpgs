<?php  
	include('connection.php');
	$err_msg = ""; $succ_mes = " ";
	session_start();
  $sql = mysqli_query($con,"Select * from courses_tb ");
  $sqlx = mysqli_query($con,"Select * from courses_tb ");
  // $sqlxx = mysqli_query($con,"Select * from courses_tb ");
  // $state_all = mysqli_query($con, "select DISTINCT course_code from courses_tb where 1");
  // $lga_all = mysqli_query($con, "select * from courses_tb");
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
	<!-- link rel="stylesheet" type="text/css" href="js/bootstrap.js">
	<link rel="stylesheet" type="text/css" href="js/jquery-2.1.3.min.js"> -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
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
    <div  style="margin-left: 530px; color: green; font-weight: bolder;font-size: 1.2em">
      <?php if(isset($_SESSION['succ_mes'])) {
          echo $_SESSION['succ_mes'];
              
        } ?>
    </div>
    <div style="margin-left: 410px; color: red; font-weight: bolder;">
        <?php if(isset($_SESSION['err_msg'])) {
          echo $_SESSION['err_msg'];
        } ?>
      </div>
    <div class="container">
      <strong class="title" style="margin-left: 410px;">Submit Question</strong>
    </div>

    <div style="color: green; text-align: center; font-weight: bold;">
      <?php
        // if (isset($_GET[''])) {
        //   $session['cc'] = $_GET['c'];
        //   $session['ct'] = $_GET['ct'];
        //   $session['cu'] = $_GET['cu'];
        //   $session['session'] = $_GET['session'];
        //   $session['dl'] =$_GET['dl'];
        // }
      ?>
    </div>
    
    
    <div class="profile-box box-left">

     <form action="testing.php" action="testing.php" method="Get">

    
      <div class="form-group">
    <label for="exampleInputPassword1">Select  Course Code</label>
    <select name="cc" class="form-control" id="state_select" required="required">
                                            <option value="">Select Course Code :</option>
                                            <?php while($row= mysqli_fetch_assoc($sql)) { ?>
                                                <option value="<?= $row['course_code']?>"><?=$row['course_code']?></option>
                                            <?php } ?>

                                        </select>
  </div>


      

      

      <!-- <div class="form-group" id="unit_form">
       <label>Course Unit :</label>

       <select class="form-control" name="cu" id="course_select_unit" required="required">
        <option>Select Course Unit</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="6">6</option>
      </select>
      </div> -->

       <div class="form-group">
       <label>Session :</label>
       <select class="form-control"  name="session" required="required">
         <option>2017/2018</option>
         <option>2016/2017</option>
       </select>
       </div>

       <div class="form-group">
       <label>Difficulty Level :</label>
       <select class="form-control" name="dl" required="required">
        <option>Select Difficulty Level Unit</option>
        <option value="Easy">Easy</option>
        <option value="Medium">Medium</option>
        <option value="Hard">Hard</option>
      </select>
       </div>

        <div class="form-group">
       <label>Enter Number of question want to Submit :</label>
       <input type="number" class="form-control" placeholder="#Enter number of Question to submit" name="n" required="required">
       </div>
       <div class="options">
        <input type="submit" class="btn btn-primary" name="submit_btn">
        
      </div>
     </form>
    

      
    </div>

  </section>
 </div>

 
 <div id="footer">
<?php
	include('footer.php');
?>
</div>

<script type="text/javascript">
   // $('#lga_fm_g').show();
   //  $('#lga_select option').hide();
   //  $('#state_select').change(function(){
   //      $('#lga_select option').hide();
   //      var this_val = $(this).val();
   //      $('#lga_select option[dir='+this_val+']').show();
   //      $('#lga_fm_g').show();
   //  })
</script>
</body>
</html>
<?php
  unset($_SESSION['succ_mes']);
  mysqli_close($con);
?>
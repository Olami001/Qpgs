
<?php
include('connection.php');
session_start();

//variables
$user = $_SESSION['username'] ;
// $questionunit = $_SESSION['cu'];
// $questiontitle = $_SESSION['ct'];
$questioncode = $_SESSION['cc'];
$dl = $_SESSION['dl'];
$session = $_SESSION['session'];
//$ques = $_POST['qns'];
$n = $_SESSION['number_que'];

// $n=@$_GET['n'];
// $eid=@$_GET['eid'];
// $ch=@$_GET['ch'];

$sql = mysqli_query($con, "select * from courses_tb where course_code = '$questioncode'");
$fetch = mysqli_fetch_assoc($sql);
$questionunit = $fetch['courseUnit'];
$questiontitle= $fetch['course_name'];

for($i=1;$i<=$n;$i++)
 {
// $qid=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO question_submit_tb(question,course_code,courseUnit,courseTitle,courseby,Difficulty,session) VALUES  ('$qns','$questioncode', '$questionunit', '$questiontitle', '$user','$dl', '$session')");
  //$oaid=uniqid();
  }
  if (!$q3) {
  	echo "<script>alert('not inserted')</script>";
  	//header('location:user_submitque.php');
  }
  else{
  	 $_SESSION['succ_mes'] = " New question added succesfully";
  	 header('location:user_submitque.php');
  }
  

// $sql = mysqli_query($con, "insert into question_submit_tb(question,courseUnit,courseTitle,courseby,session) Value('$ques','$questionunit','$questiontitle','$user','$session')")

?>
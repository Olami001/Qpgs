<?php
error_reporting(0);
// Include the main TCPDF library (search for installation path).
include("tcpdf/tcpdf.php");
include('connection.php');
	session_start();
	$couCode = $_SESSION['courseCode'];
	$sess = $_SESSION['sess'];
	$dl = $_SESSION['dl'];
	$noque = $_SESSION['que_no'];
	$semster = strtoupper($_SESSION['sems']);
	$query = mysqli_query($con, "select * from courses_tb where course_code = '$couCode'");
	if (mysqli_num_rows($query) > 0) {
		$get = mysqli_fetch_array($query);
		$course_title = $get['course_name'];
		$course_unit = $get['courseUnit'];
	}
	

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($couCode);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(TRUE);
//$pdf->setFooter('{PAGENO}');
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


// set font
$pdf->SetFont('freeserif', '', 12);
// set font
//$pdf->SetFont('times', 'BI', 20);
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
Usmanu Danfodiyou University Sokoto. \n Departemnt of Mathematics \n COMPUTER SCIENCE UNIT \n $semster SEMSETER EXAMINATION, 2017/2018 SESSION 
___________________________________________________________________________________
EOD;





// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
//$pdf ->write(0,$html, '', 0, true, 0, false, false, 0);

$pdf -> cell(25,5,'Course Code: ',0,0);
$pdf -> cell(62,5, $couCode,0,0);
$pdf -> cell(12,5,'Title:',0,0);
$pdf -> cell(35,2,$course_title,0,1);

// $pdf -> cell(130,5,'Time Allowed: ',0,0);
// $pdf -> cell(25,5,'TiTle:',0,0);
// $pdf -> cell(34,2,'ssssss',0,0);
$pdf -> cell(26,5,'Time Allowed: ',0,0);
$pdf -> cell(62,5,'2 Hours',0,0);
$pdf -> cell(12,5,'Units:',0,0);
$pdf -> cell(35,2,$course_unit,0,1);


$pdf -> cell(23,5,'Instruction: ',0,0);
$pdf -> cell(162,5,'Answer Four (4) Question Only',0,1);


$pdf -> cell(25,5,'DO NOT WRITE ON THIS QUESTION PAPER',0,1);

$txt = <<<EOD
____________________________________________________________________________________
EOD;

$pdf->setFontSubsetting(true);

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


//$txt .=fetch();
include('connection.php');
	//session_start();
	$couCode = $_SESSION['courseCode'];
	$_SESSION['ccc'] = $couCode;
	$sess = $_SESSION['sess'];
	$dl = $_SESSION['dl'];
	$noque = $_SESSION['que_no'];
	$semster = $_SESSION['sems'];
	$sub_noque = ($noque * 4);
	//$qet = mysqli_query($con, "select * from question_submit_tb where course_code = '$couCode' AND Difficulty = '$dl'");
	// $count = 1;
	// while ($rro = mysqli_fetch_assoc($qet)) {
	// 	return $count .".". $rro['question'];
	// $count++;}
	$ids = mysqli_query($con, "Select id from question_submit_tb where course_code='$couCode' ");
	$norows = mysqli_num_rows($ids);
	if ($norows < 1) {
		echo "No available Question for the Course selected";
	}
	elseif ($norows < $sub_noque) {
		echo "No enough question to genarate!!! Reduce number of question entered ";
	}
	else{
		$store_array = Array();
		while($row = mysqli_fetch_array($ids)){
		$store_array[] = $row['id'];
		}

			//checking pass date and question number
		$sql_del = mysqli_query($con, "select * from prev_question");
		while ($del_fet = mysqli_fetch_assoc($sql)) {
			# code...
			$del_date = $del_fet['date_taken'];
			$red_date = date('Y-m-d') -1;
			if ((del_date) != $red_date) {
				$query_delet = mysqli_query($con, "delete from prev_question where date_taken ='$del_date'");
			}
			else{
				$select = mysqli_query($con, "select * from prev_question where course_code ='$couCode'");
				if (mysqli_num_rows($select) > 35) {
					$del_update = mysqli_query($con, "DELETE FROM prev_question");
				}
			}
		}
		
		
			

		 // store array now contain all the ids of questions
		$ramdom_questions_ids = random_pick($store_array, 100);
		$arraycount = count($ramdom_questions_ids);
		$counter =1; $count = 'a'; 
		for ($i=0; $i < ($sub_noque); $i++) { 
			// return $ramdom_questions_ids[$i];
			$pdf -> writeHTML('('.$counter.')', true,false,true,false,'');
			$j = 'a';
			while ($j < 'd') {
				
				  $txtx2 = $ramdom_questions_ids[$i];
			
			///for si=ub question
			$fft2 = mysqli_query($con, "Select * from question_submit_tb where id = '$txtx2' "); 
			
			///for sub
			$res2 = mysqli_fetch_assoc($fft2); 
			$tex = $res2['id']; 
			//$txt = $counter . "."." " .$res['question'];
			$textx = $j. "."." ". $res2['question']; 
			$CreationDate1 = date('Y-m-d');

			//checking if question is the same
			$check = mysqli_query($con, "select * from prev_question where qno = '$tex'");
			$result_id = mysqli_fetch_assoc($check); 
			$couse_result = $result_id['course_code'];
			$get_id = $result_id['qno'];
			$date_fetched = $result_id['date_taken'];

			if (($tex == $get_id) AND ($couCode == $couse_result) AND ($date_fetched == date('Y-m-d'))) {
				$test_insert = mysqli_query($con, "INSERT INTO prev_question(same) values('$tex') where qno = '$get_id'");
				// $newq = count($result_id['qno']) + 1; $newfetc = mysqli_query($con, "select * from question_submit_tb where id ='$newq'");
				// $newres = mysqli_fetch_assoc($newfetc);
				// $textx = $j . "."." ". $newres['question'];$pdf->writeHTML($textx, true,false,true,false,'');
				$i++; $sub_noque = $sub_noque + 1; //$j--; 
			}//end of condition testing
			 else{
			$sql = mysqli_query($con,"INSERT INTO prev_question(qno, date_taken, course_code) VALUES('$tex','$CreationDate1','$couCode')") or mysqli_error($con);
			$pdf-> writeHTML(" ");
			// $pdf -> writeHTML($counter);
			//$pdf->writeHTML($txt, true, false, true, false, '');
			$pdf->writeHTML($textx, true,false,true,false,'');
			//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
			
			$i++;
			$j++;
		}

			}
			// for($j='a'; $j <'d'; $j++){
			//  $txtx2 = $ramdom_questions_ids[$i];
			
			// ///for si=ub question
			// $fft2 = mysqli_query($con, "Select * from question_submit_tb where id = '$txtx2' "); 
			
			// ///for sub
			// $res2 = mysqli_fetch_assoc($fft2); $tex = $res2['id']; 
			// //$txt = $counter . "."." " .$res['question'];
			// $textx = $j. "."." ". $res2['question']; $CreationDate1 = date('Y-m-d');

			// //checking if question is the same
			// $check = mysqli_query($con, "select * from prev_question where qno = '$tex'");
			// $result_id = mysqli_fetch_assoc($check); 
			// $couse_result = $result_id['course_code'];
			// $get_id = $result_id['qno'];
			// if (($tex == $get_id) AND ($couCode == $couse_result)) {
			// 	$test_insert = mysqli_query($con, "INSERT INTO prev_question(same) values('$tex') where qno = '$get_id'");
			// 	// $newq = count($result_id['qno']) + 1; $newfetc = mysqli_query($con, "select * from question_submit_tb where id ='$newq'");
			// 	// $newres = mysqli_fetch_assoc($newfetc);
			// 	// $textx = $j . "."." ". $newres['question'];$pdf->writeHTML($textx, true,false,true,false,'');
			// 	$i++; //$j--; 
			// }//end of condition testing
			//  else{
			// $sql = mysqli_query($con,"INSERT INTO prev_question(qno, date_taken, course_code) VALUES('$tex','$CreationDate1','$couCode')") or mysqli_error($con);
			// $pdf-> writeHTML(" ");
			// // $pdf -> writeHTML($counter);
			// //$pdf->writeHTML($txt, true, false, true, false, '');
			// $pdf->writeHTML($textx, true,false,true,false,'');
			// //$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
			
			// $i++;
			// $count++;}//end of testing condition
			// } //end of sub loop
		$counter+=1;
	}//end of for loop

	
// 
$pdf->setFontSubsetting(false);

//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// add a page
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->AddPage();



//
$CreationDate = date('Y-m-d');
$dte = date('d');
$filename= $couCode.'.pdf'; 
 //$filelocation = "C:\\xampp\htdocs\\qpgs\questionpaper";  
$filelocation = "C:\wamp\www\QPGS\questionpaper";

 $fileNL = $filelocation."\\".$filename;
 
 $pdf->Output($fileNL,'F');

 if ($pdf) {
 	$_SESSION['result']='Question paper generated Successfully';
 	if (mysqli_num_rows(mysqli_query($con,"select * from question_generated where Question_Title='$couCode'"))>0) {
 		mysqli_query($con,"Update question_generated set Question_Title = '$couCode', DateOfCreation = '$CreationDate' where Question_Title = '$couCode'");
 		header('location:generate_que.php');
 	}
 	else{
 	$inset = mysqli_query($con,"INSERT into question_generated(Question_Title,DateOfCreation) VALUES('$couCode','$CreationDate')");
 	header('location:generate_que.php');
 }
}
}
//Close and output PDF document
//$pdf->Output('example_002.pdf', 'I');

// $filename= $Uname.'.pdf'; 
//  $filelocation = "C:\wamp\www\OES1\OES1\images";  

//  $fileNL = $filelocation."\\".$filename;
//  $pdf->Output($fileNL,'F');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php

$question_per_page = 20;

	function random_pick( $a, $n ) 
{
  $N = count($a);
  $n = min($n, $N);
  $picked = array_fill(0, $n, 0); $backup = array_fill(0, $n, 0);
  
  for ($i=0; $i<$n; $i++) 
  { 
    $selected = mt_rand( 0, --$N ); 
    $value = $a[ $selected ];
    $a[ $selected ] = $a[ $N ];
    $a[ $N ] = $value;
    $backup[ $i ] = $selected;
    $picked[ $i ] = $value;
  }
  
  for ($i=$n-1; $i>=0; $i--) 
  { 
    $selected = $backup[ $i ];
    $value = $a[ $N ];
    $a[ $N ] = $a[ $selected ];
    $a[ $selected ] = $value;
    $N++;
  }
  return $picked;
}

	function fetch(){
	include('connection.php');
	session_start();
	$couCode = $_SESSION['courseCode'];
	$sess = $_SESSION['sess'];
	$dl = $_SESSION['dl'];
	$noque = $_SESSION['que_no'];
	$semster = $_SESSION['sems'];
	
	$ids = mysqli_query($con, "Select id from question_submit_tb");
	$norows = mysqli_num_rows($ids);
	if ($norows < 0) {
		echo "not available Question for the Course, session and Difficulty choosen";
	}else{
		$store_array = Array();
		while($row = mysqli_fetch_array($ids)){
		$store_array[] = $row['id'];
		}
		 // store array now contain all the ids of questions
		$ramdom_questions_ids = random_pick($store_array, 20);
		$arraycount = count($ramdom_questions_ids);
		for ($i=0; $i < $arraycount; $i++) { 

			return $ramdom_questions_ids[$i];
		}

	}
}
?>		
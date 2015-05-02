<?
/****************************************************
// Dodo's Quiz Script
// Copyrighted by Ying Zhang
// http://regretless.com/scripts
// No redistribution without authorization
// Script released under linkware
// that means LINK ME if you use it for your website
/****************************************************/


/***********************************************************
// With this script you should able to make multiple quizzes
// Just call your quiz with its number.
// For example: dodosquiz.php?n=1 will include your quiz_1.php
// No changes below this unless you REALLY KNOW what you are
// doing.
/***********************************************************/

/************************************************************
// Email function added Jan 30, 2003
// Made it compatible with PHP5 April 1, 2008
/************************************************************/

if(!$_GET['n'])
	exit;
require("quiz_".$_GET['n'].".php");
include("header.php");

if($_GET['action'] == "results") {
	$choices = $_POST['choices'];
	$total_choices = count($choices);
	if($total_choices == 0) {
		echo "<div class=\"rings\">Error</div><div class=\"just\">None of the questions is answered! Please <a href=\"javascript:history.back(1)\">go back</a> and answer them!";
	} else {
		if($all_questions_answer && ($total_choices != count($questions_array))) {
			echo "<div class=\"rings\">Error</div><div class=\"just\">You didn't answer all the questions. Please <a href=\"javascript:history.back(1)\">go back</a> and answer them!";
			footer();
			include("footer.php");
			exit;
		}

		/*********************
		 MATH QUIZ RESULT
		**********************/
		if($math_quiz) {
			// calculate the results

			// declare an array the same size as choices with only 0
			$total_results = count($results_array);
			for($j=1; $j <= $total_results; $j++) {
				$int_results_array[$j]=0;
			}
		
			
			for($i=1; $i <= $total_choices; $i++) {
				$num = trim($choices[$i]);
				// if the quiz taker has choosen the correct answer
				if($num == $correct_result)
					$int_results_array[$correct_result]=$int_results_array[$correct_result]+1;
			}


			$max_value = max($int_results_array);

			// if max_value is the same as the total number of questoins
			if($max_value == count($questions_array)) {
				$right = 1;
			}

			if($right)
				$final_result=$results_array[$correct_result];
			else {
				if($math_quiz_show_correct) {
					$total = count($questions_array);
					$final_result = $results_array[$math_quiz_show_correct_before]." It seems you have gotten <b>$max_value</b> out of $total correct.".$results_array[$math_quiz_show_correct_after];
				} else {
					$final_result=$results_array[$wrong_result];
				}
			}

			echo $final_result;

			email_admin($final_result);
			footer();
			include("footer.php");
			exit;
		}
		/*********************
		 END OF THE MATH QUIZ
		**********************/


		/*********************
		 TYPE 2 QUIZ RESULT
		**********************/
		if($quiz_2) {

			// test to make sure the level array is the same size as the result array
			if(count($level_array) != count($results_array)) {
				echo "<div class=\"rings\">Error</div><div class=\"just\">The quiz maker didn't provide valid info for this quiz. If you are the quiz maker, please make your level array the same size as your result array in order for the type 2 quiz to work!</div>";
				footer();
				include("footer.php");
				exit;
			}
			// calculate the results
			$total_num_correct = 0;
			
			for($i=1; $i <= $total_choices; $i++) {
				$num = trim($choices[$i]);
				// if the quiz taker has choosen the correct answer
				if($num == $correct_result)
					$total_num_correct++;
			}

			// now $total_num_correct should contain how many problems did the quiz taker get right.
			if($total_num_correct <= $level_array[1]) {
				$final_result = $results_array[1];
				echo $final_result;

				footer();
				email_admin($final_result);
				include("footer.php");
				exit;
			}

			$total_levels = count($level_array);
			for($j=1; $j < ($total_levels-1); $j++) {
				$k=$j+1;
				if(($total_num_correct > $level_array[$j]) && ($total_num_correct <= $level_array[$k])) {
					$final_result = $results_array[$k];
					echo $final_result;

					footer();
					email_admin($final_result);
					include("footer.php");
					exit;
				}

			}

			// else the final result must the be the last
			$final_result = $results_array[count($results_array)];

			echo $final_result;

			footer();
			email_admin($final_result);
			include("footer.php");
			exit;
		}
		/*********************
		 END OF THE QUIZ II
		**********************/
			// calculate the results

			// results array
			//print_r($results_array);
			// declare an array the same size as choices with only 0
			$total_results = count($results_array);
			for($j=1; $j <= $total_results; $j++) {
				$int_results_array[$j]=0;
			}
		
			//print_r($choices);
			for($i=1; $i <= $total_choices; $i++) {
				$num = trim($choices[$i]);
				$int_results_array[$num]=$int_results_array[$num]+1;
			}

			//print_r($int_results_array);

			$max_value = max($int_results_array);

			$total_int_results_array = count($int_results_array);
			for($i=1; $i<=$total_int_results_array; $i++) {
			   if($int_results_array[$i] == $max_value) {
					$max_key = $i;
					break;
			   }
			}

			//echo "the max key is $max_key";
			//print_r($int_results_array);
			//echo "max key is  $max_key";
			$final_result=$results_array[$max_key];
			echo $final_result;

	} // end of else


} // end of the result function

function email_admin($final_result) {
	global $admin_email, $email_notify, $HTTP_USER_AGENT, $REMOTE_ADDR, $HTTP_REFERER, $quiz_question;
	// email admin if it's enabled
	if($email_notify) {

		if($final_result != "") {

			$final_email_result = str_replace("<div class=\"header\">", "", $final_result);
			$final_email_result = str_replace("<div class=\"just\">", "", $final_email_result);
			$final_email_result = str_replace("</div>", "\n\n", $final_email_result);
			$final_email_result = str_replace("<br />", "\n", $final_email_result);
			
			// get the quiz taker's info
			$date = date("Y-m-d H:i:s");
			$ip = $_SERVER['REMOTE_ADDR'];
			$browser_info = $_SERVER['HTTP_USER_AGENT'];
			$host = gethostbyaddr($ip);
			$referer = $_SERVER['HTTP_REFERER'];

			// from info
			$from_info = "
This is the result of the test taker:

$final_email_result
	
------------------------------------------------------------------------------------------
	IP: $ip
	HOST: $host
	Browser: $browser_info
	Time: $date
	Referred by: $referer
------------------------------------------------------------------------------------------";


			$subject = "Someone has taken $quiz_question quiz";

			//echo "in footer, trying to send mail: $admin_email, $final_result, $from_info, $subject";

			mail($admin_email, $subject, $from_info, "From: Test_Taker");
		} // end of if final result is not empty


	} // end of if
}
function footer() {
	echo "<div style=\"font-family: Verdana; font-size: 10px;\">Quiz made possible with <a href=\"http://regretless.com/scripts/\" target=\"_blank\">Dodo's Quiz Script</a></div>";
} // end of footer function

if(!$_GET['action']) {
	echo "<div class=\"header\">".$quiz_question."</div>\n<div class=\"just\">".$quiz_description."</div>";
	echo "<form action=\"dodosquiz.php?n=".$_GET['n']."&action=results\" method=\"post\">";
	for($i = 1; $i <= count($questions_array); $i++) {
		echo "<div class=\"rings\">".$questions_array[$i]."</div>\n";
		// find the answers
		$this_answers = explode("\n", $answers_array[$i]);
			// print the answers and modify the results
			echo "<div class=\"just\">\n";
			for($k = 0; $k < count($this_answers); $k++) {
				$this_particular_answer = explode("|", $this_answers[$k]);
				echo "<label><input type=\"radio\" name=\"choices[".$i."]\" value=\"".trim($this_particular_answer[1])."\">".$this_particular_answer[0]."</label><br /> \n";
			}
			echo "</div><br />\n";
			//print_r($this_answers);
	} // end of for
	echo "<input type=\"submit\" value=\"".$submit_button."\" class=\"form\"></form>";
} // end of if not action
footer();
email_admin($final_result);
include("footer.php");
?>
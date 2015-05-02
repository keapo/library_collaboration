<?php
/****************************************************
// Dodo's Quiz Script
// Copyrighted by Ying Zhang
// http://regretless.com/scripts
// No redistribution without authorization
// Script released under linkware
// that means LINK ME if you use it for your website
/****************************************************/

/********************************************************************************
	This is a math quiz. You should only provide two results:
		ONE for CORRECT
		ONE for WRONG
	You may also ask the script to display how many the quiz taker has gotten
	correct out of the total number of questions.
*********************************************************************************/
// Would you like to get get an email when someone takes this particular quiz?
$email_notify = 0;  // 1 = yes 0 = no
// if so
$admin_email = "you@domain.com";

// Your quiz question:
$quiz_question = "A Math Quiz";

// What you want your submit button to say?
$submit_button = "Submit quiz";

// Your quiz description:
$quiz_description = "Just a simple test quiz to show you how to use the math quiz function! In order to get 100%, you must answer all the following correctly.";

// Do you want to make sure that all of your questions are answered before the results are calculated?
$all_questions_answer = 1; // 1 = yes 0 = no

// Is this a math quiz?
$math_quiz = 1; // 1 = yes 0 = no

/**********************************************
 The following variables are for math quiz only
 means please ignore them if you are not 
 making a MATH QUIZ!
***********************************************/
// If this is a math quiz, the correct result is no:
$correct_result = 2;
// If this is a math quiz, the wrong result is no:
$wrong_result = 1;
// If this is a math quiz, will you like the script to show the quiz taker how many of the questions they got right?
$math_quiz_show_correct = 1; // 1 = yes 0 = no
			  /**********************************************
			   the following variables are for if you want
			   the script to show the number of correct
			   numbers only!
			   means ignore if you don't want the script to
			   do so.
			  ***********************************************/
			  // if you want the scrpit to show the number of correct answers. 
			  // you want to provide the result displayed before the number of corrects:
				$math_quiz_show_correct_before = 3; // see the example
			  // and after the number of correct answers:
				$math_quiz_show_correct_after = 4; // see the example
			  /**********************************************
			  end of ignore
			  ***********************************************/
/**********************************************
 END OF IGNORE
***********************************************/

// Now for each result, give it a description. Please make sure you put \ in front your quotations or you will get parse error!
// WARNING: if this is a math question, please leave the variable "$adding" in the WRONG result in order for the script to show how many questions the quiz taker has gotten correct.
$results_array = array(
1 => "<div class=\"header\">Oops</div><div class=\"just\">You didn't get them all correct.<br /><br /> Add more your description here. blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah </div>",
2 => "<div class=\"header\">100%</div><div class=\"just\">WOW, amazing you got all of the questions correct.<br /><br />Add more your description here. blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah </div>",
3 => "<div class=\"header\">Oops</div><div class=\"just\"><i>math_quiz_show_correct_before: </i>You didn't get them all correct. ",
4 => "<br /><br /><i>math_quiz_show_correct_after:</i> Add more your description here. blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah blah blab blah </div>",
);

// Now your questions
$questions_array = array(
1=> "1 + 2 =",
2=> "30 x 60 =",
3=> "300 / 50 =",
);

// your answers. MAKE SURE it's the same order as the questions. also gives which of the results is the answer corresponding to separated by the symbol |. One unique answer per line!

$answers_array = array(
1=> "1|1
2|1
3|2
4|1",

2=> "18|1
180|1
1800|2
18000|1",

3=> "6|2
60|1
600|1
6000|1",

/*******************************************
 I hope you get the idea now.
 Just add more if you have more questions.
 Make sure to change the index numbers.
 For example, the next one should begin with
 3=> "blah|1
 blah|2
 blah|3",
 always end with a quotation and a comma!
 *******************************************/

);

######### END OF QUIZ 1 DATA ##################################################
?>
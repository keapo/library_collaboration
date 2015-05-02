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
Remember if you name this file quiz_1.php it will be quiz no. 1!
You will have to call this script by using
quiz.php?n=1
*********************************************************************************/
// Would you like to get get an email when someone takes this particular quiz?
$email_notify = 0;  // 1 = yes 0 = no
// if so
$admin_email = "you@domain.com";

// Your quiz question:
$quiz_question = "How well do you know math?";

// Do you want to make sure that all of your questions are answered before the results are calculated?
$all_questions_answer = 1; // 1 = yes 0 = no

// What you want your submit button to say?
$submit_button = "Math Geek?";

// Your quiz description:
$quiz_description = "This is to demonstrate the second type of calculation for dodo's quiz script. In this quiz, you will get a different result base on the number of questions you answer correctly. If you get 1 or less correct, you get one result, then between 1 and 3, you get a different result, and then between 3 and 6 another. Lastly, you will get a secret message if you score more than 6 correct ;)";

// Will you like to use the second type quiz calculation for your quiz?
// Second type quiz is the quiz that calculates base on the number of questions you get correct.
$quiz_2 = 1; // 1 = yes 0 = no

/**********************************************
 The following variables are for second type
 quiz only. Read README for more detailed
 instructions on implementation!
***********************************************/
// If this is a quiz II, the correct result is no:
$correct_result = 2;
// Please enter the number one must get correct corresponding to the number of results below
$level_array = array(
1=>1, // 1 or less
2=>3, // greater than 1 and less and equal to 3
3=>6, // greater than 3 and less and equal to 6
4=>8, // more than 6! just put the total number of questions here
);

// Now the result array, please make sure it's the same size as the level array
// PLEASE ENTER THEM THE SAME ORDER AS YOUR LEVEL ARRAY!! otherwise it won't work correctly!
$results_array = array(
1 => "<br /><br /><div class=\"rings\">Aww</div><div class=\"just\">Too bad you don't know much about math :(</div>",
2 => "<br /><br /><div class=\"rings\">You are ok</div><div class=\"just\">You can get by fine with the math you know although there are a lot of rooms for improvement.</div>",
3 => "<br /><br /><div class=\"rings\">You are pretty good.</div><div class=\"just\">You are pretty good with math, but you still need to spend more time on it if you want to be better.</div>",
4 => "<br /><br /><div class=\"rings\">You are a math dude!</div><div class=\"just\">Awesome. You are a math geek.  Secret message: greeting from a fellow math geek!</div>",
);

// Now your questions
$questions_array = array(
1=> "Cosine of 0 is",
2=> "The largest common divisor of 12 and 13 is",
3=> "A prime number means",
4=> "The formula to find out a volume of a cone is",
5=> "What number system contains letters?",
6=> "Gaussian Elimination is used to",
7=> "What's the relationship between velocity and acceleration?",
8=> "A vector means",
);

// your answers. MAKE SURE you put the no. you give for $correct_result for the correct answer.
// for my example, no. 2 is the correct answer for each question


$answers_array = array(
1=> "Pi|1
0|1
2|1
1|2",

2=> "1|2
0|1
2|1
3|1",

3=> "It's an even number.|1
It has only two divisors: 1 and itself|2
It has no divisors.|1
It's divisible by 3.|1",

4=> "3*2*Pi*r^2*h|1
1/3*2*Pi*r^2*h|2
1/2 the volume of a cylinder with the same radius|1
1/5 the volume of a sphere with the same radius|1",

5=> "There's no such thing.|1
Base 8.|1
Decimal.|1
Base 16.|2",

6=> "Do caluclus.|1
Solve squareroots.|1
Solve systems of linear equations.|2
Solve integration.|1",

7=> "Acceleration is faster than velocity.|1
Acceleration is the inverse of velocity.|1
Velocity is the derivative of acceleration.|1
Velocity is the antiderivative of acceleration.|2",

8=> "It can not exist on its own.|1
It's fast.|1
It has a direction and a length.|2
It's just another saying of a line.|1",

/**** I hope you get the idea now! ****/
);

######### END OF QUIZ 1 DATA ##################################################
?>
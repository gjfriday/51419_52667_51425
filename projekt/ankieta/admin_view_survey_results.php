<?php

// include('/ankieta/config.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

?>
<html>

<?php

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

mysqli_select_db($con, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$survey_id=$_POST["survey_id_list"];
	echo "<br>Numer ankiety: ".$survey_id."<br>";


	$sql="SELECT tbl_survey_questions.question_id,
       tbl_questions.question_content,
       tbl_survey_questions.survey_id
  FROM survey_db.tbl_survey_questions tbl_survey_questions
       INNER JOIN survey_db.tbl_questions tbl_questions
          ON (tbl_survey_questions.question_id = tbl_questions.question_id)
 WHERE (tbl_survey_questions.survey_id = $survey_id)";

    $result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);

    if($num_rows == 0) 
    {
		echo "Brak pytań powiązanych z tą ankietą.";
		$con->close();
		exit;
	}

	for ($x=1; $x<=$num_rows; $x++)
	{
		for ($y=1; $y<=5; $y++) 
		{
			$response_count[$x][$y]=0;
		}
	}

  	$questions_count=0;

	while($row=mysqli_fetch_array($result))
    {
		$questions_count++;
		$questions_content_array[$questions_count] = $row['question_content'];
		$questions_id_array[$questions_count] = $row['question_id'];
		$question_id=$questions_id_array[$questions_count];

  		for ($i=1; $i<=5; $i++)  
		{
				$response=$i;
				$sql1="SELECT
			   tbl_surveys.survey_name,
			   tbl_survey_questions.question_id,
			   tbl_questions.question_content,
			   COUNT(tbl_user_questions.response)
		  FROM ((survey_db.tbl_survey_questions tbl_survey_questions
				 INNER JOIN survey_db.tbl_surveys tbl_surveys
					ON (tbl_survey_questions.survey_id = tbl_surveys.survey_id))
				INNER JOIN survey_db.tbl_questions tbl_questions
				   ON (tbl_survey_questions.question_id = tbl_questions.question_id))
			   INNER JOIN survey_db.tbl_user_questions tbl_user_questions
				  ON (tbl_user_questions.question_id = tbl_questions.question_id)
		 WHERE     (tbl_survey_questions.survey_id = $survey_id)
			   AND (tbl_survey_questions.question_id = $question_id)
			   AND (tbl_user_questions.response = {$response})
		GROUP BY tbl_questions.question_content";

				$result1 = mysqli_query($con, $sql1);
				$num_rows = mysqli_num_rows($result1);
				if($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
				{
				
						$response_count[$questions_count][$response]=$row1['COUNT(tbl_user_questions.response)'];

				}
		}
    }

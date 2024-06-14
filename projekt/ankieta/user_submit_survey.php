<?php

	session_start();

	include("config/config.php");
	include("view/header.php");
	include("view/user_view.php");

	$user_id = $_SESSION["USER_ID"];
?>

		<div id="results">

<?php

$con = mysqli_connect($servername, $username, $password, $dbname);

if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

mysqli_select_db($con, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$survey_id=$_POST["survey_id"];
	$questions_count=$_POST["questions_count"];
	$date_begin=$_POST["date_begin"];

	// Pobiera listę pytań, na które użytkownik odpowiedział.
	$sql="SELECT tbl_questions.question_content, tbl_questions.question_id FROM tbl_questions INNER JOIN tbl_survey_questions ON tbl_questions.question_id = tbl_survey_questions.question_id WHERE tbl_survey_questions.survey_id=$survey_id";
    $result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);
	$count=0;

	while($row=mysqli_fetch_array($result))
	{
		$count++;
		$questions_id_list[$count]=$row['question_id'];
	}

	// Zapisuje odpowiedzi w tabelach: tbl_user_questions, tbl_user_surveys
	for ($i=1; $i<=$questions_count; $i++)
	{
		if (isset($_POST[$questions_id_list[$i]]))
		{
			$response = [];
			$response[$i]=$_POST[$questions_id_list[$i]];
			$sql1="INSERT INTO tbl_user_questions VALUES (null, '$user_id','$questions_id_list[$i]', '$response[$i]')";
			$result1 = mysqli_query($con, $sql1);

			if($result1) {
				echo "<br>Survey question: ".$i." response inserted into database successfully!";
			} else {
				echo "<br>Error: " . $sql1 . "<br>" . $con->error;
				echo "<br>Response: ".$response[$i];
			}
		} else
		{
			echo "<br>Question: ".$i." with question id: ".$questions_id_list[$i]." not answered.";
		}
	}


	{
		$date_submit=date("Y-m-d H:i:s");
		$sql2 = "INSERT INTO tbl_user_surveys VALUES (null, '$user_id','$survey_id', '$date_begin', '$date_submit')";
		$result2 = mysqli_query($con, $sql2);
		if($result2)
		{
			echo "<br><br>Sukces! Ankieta dodana pomyślnie.<br>";
		} else
		{
			echo "<br>Error: " . $sql2 . "<br>" . $con->error."<br>";
		}
	}

} 

echo " userId: ".$user_id." surveyId: ".$survey_id." questions count: ".$questions_count."<br>";

mysqli_close($con);

?>

		</div>
	</body>
</html>


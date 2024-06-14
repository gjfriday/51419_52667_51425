<?php

	session_start();

	include("config/config.php");
	include("view/header.php");
	include("view/user_view.php");

	$userId = $_SESSION["USER_ID"];

?>


		<div id="surveyList">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") // do końca php
{
	$survey_id=$_POST["survey_id_list"];
	$_SESSION["SURVEY_ID"] = $survey_id;
}
echo "<br>surveyId: ".$survey_id."<br>";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

mysqli_select_db($con, $dbname);

// Pobiera listę ankiet z BD

	$sql="SELECT tbl_questions.question_content, tbl_questions.question_id 
		FROM tbl_questions 
		INNER JOIN tbl_survey_questions 
		ON tbl_questions.question_id = tbl_survey_questions.question_id 
		WHERE tbl_survey_questions.survey_id=$survey_id
	";
	
    $result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);
	$questions_count=0;

	if ($num_rows == 0) 
	{
		echo "<br>Ta ankieta nie zawiera pytań. Spróbuj wypełnić inną akietę.<br>";
		$con->close();
		exit;
	}

	echo "<form  method=\"post\" action=\"user_submit_survey.php\">";
	// Wyświetla pytania w tabeli.
	echo "<table width='700' border='1'> <tr><th>Numer pytania</th><th>Pytanie</th><th>1 (Zdecydowanie nie) --- 5 (Zdecydowanie tak) </th></tr>";
	echo "<caption> <b> Lista pytań </b> </caption>";
    while($row=mysqli_fetch_array($result))
	{
		//print_r($row); echo "<br>";
		$questions_count++;
		echo "<tr><td>".$questions_count."</td><td>".$row['question_content']."</td><td>";

		//for ($i=1; $i<=$num_options; $i++) // Można dodać potem, w zależności od opcji.
		{
			echo "<input type=\"radio\" name=\"".$row['question_id']."\" value=\"1\" /> 1 ";
			echo "<input type=\"radio\" name=\"".$row['question_id']."\" value=\"2\" /> 2 ";
			echo "<input type=\"radio\" name=\"".$row['question_id']."\" value=\"3\" CHECKED /> 3 ";
			echo "<input type=\"radio\" name=\"".$row['question_id']."\" value=\"4\" /> 4 ";
			echo "<input type=\"radio\" name=\"".$row['question_id']."\" value=\"5\" /> 5 ";
		}
		echo "</td></tr>";
    }
	echo "<input type=\"hidden\" name=\"survey_id\" value=\"".$survey_id."\" />";
	echo "<input type=\"hidden\" name=\"questions_count\" value=\"".$questions_count."\" />";
	$date_begin=date("Y-m-d H:i:s"); // Aktualny DATETIME do przechowania w bazie danych, format: 2010-02-06 19:30:13
	echo "<input type=\"hidden\" name=\"date_begin\" value=\"".$date_begin."\" />";
	echo "</table>";

	echo "<br><input type=\"submit\" name=\"submit\" value=\"Wyślij\" />";
	echo "</form>";

mysqli_close($con);

?>

		</div>
	</body>
</html>

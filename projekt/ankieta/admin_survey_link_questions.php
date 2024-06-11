<?php

include("config/config.php");
include("view/header.php");
include("view/admin_view.php");

?>

<div id="contentLinkQ">
  
<?php
$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}
mysqli_select_db($con, $dbname);

// Pobieranie listy ankiet
echo "<table width='386' border='1'> 
      <tr>
        <th>Numer</th>
        <th>Nazwa</th>
        <th>Opis</th>
        <th>Start</th>
        <th>Koniec</th>
      </tr>";
echo "<caption> <b> Lista ankiet </b> </caption>";
	$sql="SELECT * FROM tbl_surveys";
    $result = mysqli_query($con, $sql);
	$survey_count=0;

    while($row=mysqli_fetch_array($result))
    {
		$survey_count++;
		$survey_names_array[$survey_count] = $row['survey_name'];
		$survey_id_array[$survey_count] = $row[0];
		echo "<tr><td>".$row[0]."</td><td>".$row['survey_name']."</td><td>".$row['survey_description']."</td><td>".$row['survey_open_date']."</td><td>".$row['survey_close_date']."</td></tr>";
    }
echo "</table>";
echo "<br> Liczba ankiet: ".$survey_count."<br>";


// Pobieranie listy pytań
echo "<table width='386' border='1'> <tr><th>Question Id</th><th>Question</th></tr>";
echo "<caption> <b> Lista pytań </b> </caption>";
	$sql2="SELECT * FROM tbl_questions";
    $result2 = mysqli_query($con, $sql2);
	$questions_count=0;
	
    while($row2=mysqli_fetch_array($result2))
    {
      $questions_count++;
      $questions_content_array[$questions_count] = $row2['question_content'];
      $questions_id_array[$questions_count] = $row2[0];
      
      echo "<tr><td>".$row2[0]."</td><td>".$row2['question_content']."</td></tr>";
    }
echo "</table>";
echo "<br> Liczba pytań: ".$questions_count."<br>";

#$con->close();
?>

<br><br>
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  
  <select name="survey_id_list">
<?php for ($i=1; $i<=$survey_count; $i++)
	{?>
    <option value="<?php echo "$survey_id_array[$i]";?>"><?php echo "$survey_names_array[$i]";?></option>
    <?php
	}?>
  </select>

   <select name="question_id_list">
<?php for ($i=1; $i<=$questions_count; $i++)
	{?>
    <option value="<?php echo "$questions_id_array[$i]";?>"><?php echo "$questions_content_array[$i]";?></option>
    <?php
	}?>
  </select>

  <br><br>
  <input type="submit"  value="Połącz">
</form>

<?php

$question_id = $survey_id = -1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$question_id=$_POST["question_id_list"];
	$survey_id=$_POST["survey_id_list"];
	

	$sql2="SELECT * FROM tbl_survey_questions WHERE survey_id=$survey_id AND question_id=$question_id";
    $result2 = mysqli_query($con, $sql2);
	$num_rows = mysqli_num_rows($result2);
	

    if($num_rows == 0) 
    {
		$sql = "
      INSERT INTO tbl_survey_questions 
      VALUES (null, '$survey_id', '$question_id')
      ";

		
		if (mysqli_query($con, $sql))
		{
			$survey_question_id = mysqli_insert_id($con);
			echo "Pytanie nr: ".$question_id . " zostało powiązane z ankietą nr: " . $survey_id;
		} else
		{
			echo "Błąd " . $sql . "<br>" . mysqli_error($con);
		}
    } else
	{
		echo "Pytanie nr: ".$question_id . " jest już powiązane z ankietą nr: " . $survey_id;
	}
}

$con->close();

?>
</div>
</body>
</html>

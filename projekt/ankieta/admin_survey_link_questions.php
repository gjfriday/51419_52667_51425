<?php
//include('/ankieta/config.php');

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

</html>

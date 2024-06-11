<?php

include("config/config.php");
include("view/header.php");
include("view/admin_view.php");

?>

<div id="surveyList">
  
<?php

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

mysqli_select_db($con, $dbname);

// Pobierz listę ankiet z bazy danych
echo "<table width='1000' border='1'> <tr><th>Numer ankiety</th><th>Tytuł</th><th>Opis</th><th>Data rozpoczęcia</th><th>Data zakończenia</th></tr>";
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

$con->close();
?>

Wybierz ankietę i naciśnij "Wyświetl", żeby zobaczyć wyniki ankiety.
<form  method="post" action="admin_view_survey_results.php">
  <select name="survey_id_list">
<?php for ($i=1; $i<=$survey_count; $i++)
	{?>
    <option value="<?php echo "$survey_id_array[$i]";?>"><?php echo "$survey_names_array[$i]";?></option>
    <?php
	}?>
  </select>

  <br><br>
  <input type="submit"  value="Wyświetl">
</form>
</div>
</body>
</html>

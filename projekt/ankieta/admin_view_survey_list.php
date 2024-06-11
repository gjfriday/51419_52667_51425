<?php
//include('/ankieta/config.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

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

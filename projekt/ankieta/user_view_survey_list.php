<?php
session_start();

//include('/ankiety/config.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

$userId = $_SESSION["USER_ID"]; 
?>

<!DOCTYPE html>
<html>
<!-- tu będzie layout -->
<?php

$con = mysqli_connect($servername, $username, $password, $dbname);

if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

mysqli_select_db($con, $dbname);


// Pobiera listę ankiet z bazy danych
echo "<table width='1000' border='1'> <tr><th>Identyfikator ankiety</th><th>Nazwa</th><th>Opis</th><th>Data rozpoczęcia</th><th>Data zakończenia</th></tr>";
echo "<caption> <b> Spis ankiet </b> </caption>";
	
	$sql="
		SELECT * FROM tbl_surveys 
		ORDER BY survey_id
		";

    $result = mysqli_query($con, $sql);
	$survey_count=0;

// Pobiera wiersze
    while($row=mysqli_fetch_array($result))
    {
		$survey_count++;
		$survey_names_array[$survey_count] = $row['survey_name'];
		$survey_id_array[$survey_count] = $row[0];
		echo "<tr><td>".$row[0]."</td><td>".$row['survey_name']."</td><td>".$row['survey_description']."</td><td>".$row['survey_open_date']."</td><td>".$row['survey_close_date']."</td></tr>";
    }
echo "</table>";
echo "<br> Liczba ankiet: ".$survey_count."<br>";

	$sql2="
		SELECT * FROM tbl_user_surveys 
		WHERE user_id=$userId 
		ORDER BY survey_id
		";

var_dump($userId);

    $result2 = mysqli_query($con, $sql2);
	$survey_completed_count=0;

    while($row2=mysqli_fetch_array($result2))
    {
		$survey_completed_count++;
		$survey_completed_array[$survey_completed_count] = $row2['survey_id'];
    }
echo "<br> Liczba wypełnionych ankiet: ".$survey_completed_count;
if ($survey_completed_count!=0)
{
	echo " Lista wypełnionych ankiet: ";
	for ($k=1; $k <= $survey_completed_count; $k++)
	{
		echo "$survey_completed_array[$k]";
		if ($k!=$survey_completed_count) echo ", ";
		else echo ".";
	}
}

// Lista ankiet nie wypełnionych przez użytkownika
	$survey_id_array_copy = $survey_id_array;
	$i= $j=1;
	while ($i <= $survey_count && $j <= $survey_completed_count)
	{
		if ($survey_id_array_copy[$i] < $survey_completed_array[$j])
		{
			$i++;
		} elseif ($survey_id_array_copy[$i] > $survey_completed_array[$j])
		{
			$j++;
		} else 
		{
			$survey_id_array_copy[$i] = -1;
			$i++; $j++;
		}
	}
	$survey_not_completed_count=0;
	for ($i=1; $i<=$survey_count; $i++)
	{
		if ($survey_id_array_copy[$i] != -1)
		{
			$survey_not_completed_count++;
			$survey_not_completed_array[$survey_not_completed_count] = $survey_id_array_copy[$i];
		}
	}

echo "<br> Liczba ankiet do wypełnienia: ".$survey_not_completed_count."<br>";
if ($survey_not_completed_count!=0)
{
	echo " Lista ankiet do wypełnienia: ";
	for ($k=1; $k <= $survey_not_completed_count; $k++)
	{
		echo "$survey_not_completed_array[$k]";
		if ($k!=$survey_not_completed_count) echo ", ";
		else echo ".";
	}
}

mysqli_close($con);
?>


  
</html>

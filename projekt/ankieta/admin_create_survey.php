<?php
// include('/ankieta/config.php'); // Nie działa mi

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

$survey_nameErr = "";
$survey_name = "";
$survey_description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["survey_name"])) {
     $survey_nameErr = "Nazwa ankiety jest wymagana.";
   } else {
	   $survey_name=$_POST["survey_name"];
   }

   $survey_description=$_POST["survey_description"];
}
?>
  
<!DOCTYPE html>
<html>
  
  <?php
  if ($survey_name != "") {

    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con) {
        die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
    }

    $sql = "
      INSERT INTO tbl_surveys(survey_name, survey_description) 
      VALUES ('$survey_name', '$survey_description')
      ";

    if (mysqli_query($con, $sql)) {
      $survey_id = mysqli_insert_id($con);
      echo "Utworzono nową ankietę. Numer ankiety: " . $survey_id;
    } else {
      echo "Błąd: " . $sql . "<br>" . mysqli_error($con);
    }

  mysqli_close($con);
  }
  ?>

  
</html>

<?php
//include('/ankieta/config.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

$question_contentErr = "";
$question_content = ""; 
$question_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["question_content"])) {
     $question_contentErr = "Wymagana treść pytania";
   } else {
	   $question_content=$_POST["question_content"];
   }

   $question_name=$_POST["question_name"];
}
?>

<!DOCTYPE html>
<html>
<!--Tu będzie layout-->

	
<?php
if ($question_content!= "") {

  $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con) {
        die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
    }

	$sql = "
  	INSERT INTO tbl_questions(question_name, question_content) 
  	VALUES ('$question_name', '$question_content')
	";
  
  if (mysqli_query($con, $sql)) {
		$question_id = mysqli_insert_id($con);
		echo "Nowe pytanie utworzone. question_id: " . $question_id;
	} else
	{ 	// To pytanie już istnieje w bazie danych.
		echo "Błąd: " . $sql . "<br>" . mysqli_error($con);
	}

	mysqli_close($con);
}
?>

</html>

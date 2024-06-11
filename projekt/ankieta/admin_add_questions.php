<?php

include("config/config.php");
include("view/header.php");
include("view/admin_view.php");

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

	<form id="addQuestions" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	  Treść pytania:
	  <input type="text" name="question_content" value="<?php echo $question_content;?>">
	  	<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($question_content == "") { ?>
		<span class="error">* <?php echo $question_contentErr;?></span>
	<?php } }?>
	<br><br>

	  Tytuł pytania:
	  <input type="text" name="question_name" value="<?php echo $question_name;?>">
		<br><br>

	  <input type="submit" value="Dodaj">
	  <br><br>
	</form>

<?php

if ($question_content!= "") {

    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con) {
        die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
    }

	// $question_id=0;
	// $num_rows=0;

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

</body>
</html>


</html>

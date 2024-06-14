<?php

include("config/config.php");
include("view/header.php");
include("view/admin_view.php");

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

    <form id="createSurvey" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      
      Podaj nazwę ankiety:
      <input type="text" name="survey_name" value="<?php echo $survey_name;?>">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { if ($survey_name == "") { ?>
        <span class="error">* <?php echo $survey_nameErr;?></span>
      <?php } }?>
      <br><br>

      Opis ankiety:
      <input type="text" name="survey_description" value="<?php echo $survey_description;?>">
      <br><br>

      <input type="submit" value="Dodaj">
      <br><br>
    </form>

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

  </body>
</html>

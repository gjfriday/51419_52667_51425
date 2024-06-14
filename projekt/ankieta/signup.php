<?php
    session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<script language="Javascript">
function IsEmpty()
{
	if(document.forms['theForm'].user_first_name.value == "")
	{
		alert("Pole wymagane!");
		return false;
	}
	if(document.forms['theForm'].email_address.value == "")
	{
		alert("Pole wymagane!");
		return false;
	}
	if(document.forms['theForm'].user_pass.value == "")
	{
		alert("Pole wymagane!");
		return false;
	}
  	if(document.forms['theForm'].user_pass.value != document.forms['theForm'].user_pass2.value)
	{
		alert("Hasła nie są takie same!");
		return false;
	}
	document.theForm.submit();
    return true;
}
</script>

<html>
  <head>
    <title>Ankieter (Rejestracja)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/signUp.css"/>
  </head>

  <body>
      <div id="logo"><a href="#"><img src="img/logoankieter.png" height="35" width="62.2"></a></div>
        <div class=container>
      <div id="signUp">

        <div id="signUpTitle">Rejestracja użytkownika</div>
        <form id = "signUpForm"  method="post" class="form-inline" name="theForm" action="signup.php">

			<div class="form-group row">
				<input type="text" class="form-control" name="user_first_name" placeholder="Imię">
				<input type="text" class="form-control" name="user_last_name" placeholder="Nazwisko">
			</div><br><hr>

			<div class="form-group row">
				<input type="text" class="form-control" name="email_address" placeholder="Adres email">
			</div><br>

			<div class="form-group row">
				<input type="password" class="form-control" name="user_pass" placeholder="Hasło">
				<input type="password" class="form-control" name="user_pass2" placeholder="Powtórz hasło">
			</div><br>

			<a href="index.php"><button type="button" id="backButton" class="btn btn-primary buttonSign row">Powrót</button></a>
			
			<button type="submit" id="submitButton" onclick="return IsEmpty();" class="btn btn-primary buttonSign row">Zarejestruj</button>

        </form>
      </div>
    </div>

<?php

function NewUser()
{
	include("config/config.php");

	$con = mysqli_connect($servername, $username, $password, $dbname);
	
	if(!$con) 
	{
		die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
	}

	mysqli_select_db($con, $dbname);

	$user_name = trim($_POST['email_address']);
	$user_first_name = trim($_POST['user_first_name']);
	$user_last_name = trim($_POST['user_last_name']);
	$user_pass = trim($_POST['user_pass']);
	$email_address = trim($_POST['email_address']);

	$num_rows=0;

	$sql = "SELECT * FROM tbl_users 
		WHERE email_address='$user_name'
	";

	$result = mysqli_query($con, $sql);

	if ($row=mysqli_fetch_array($result)) {

		$num_rows = mysqli_num_rows($result);

	} else {
		
		echo "<br>" . $con->error."<br>";
	
	}

	if ($num_rows != 0) {

		echo "Podany email już istnieje w bazie danych! Podaj inny email w celu rejestracji!";
		mysqli_close($con);
		exit;

	}

	$sql = "
		INSERT INTO tbl_users(user_name, user_pass, user_first_name, user_last_name, email_address) 
		VALUES ('$user_name','$user_pass','$user_first_name','$user_last_name','$email_address')";

	if ($user_name!= "" && $user_pass!= "" && $user_first_name!= "")
	{
		if (mysqli_query($con, $sql)) 
		{
			$user_id = mysqli_insert_id($con);
			echo "Utworzono nowego użytkownika. Numer identyfikacyjny: " . htmlspecialchars($user_id);
			echo "Za 3 sekundy nastąpi przekierowanie do strony logowania.";
			header('Refresh: 3;url=index.php'); //Działa
			exit();
		} else
		{ 	
			echo "Błąd: " . $sql . "<br>" . mysqli_error($con);
			echo "Ten użytkownik już istnieje.";
		}
	} else
	{
		echo "<br>Brakujące dane <br>";
	}

	mysqli_close($con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//if(isset($_POST['submit']))
	{
	  NewUser();
	}
}

echo "<br><br>";

?>

</body>
</html>


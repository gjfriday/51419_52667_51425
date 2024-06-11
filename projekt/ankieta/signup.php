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
<!-- html -->
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
			// header('Refresh: 3;url=index.php'); //Działa
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


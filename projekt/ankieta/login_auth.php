<!-- Weryfikacja, czy użytkownik loguje się jako admin lub zwykły użytkownik. Najpierw sprawdza, czy login jest w tabeli tbl_admin, 
	a potem czy w tabeli tbl_users. 
1. Ustawia zmienne sesji odpowiednio na 1 or 0
	$_SESSION["ADMIN_LOGGED_IN"]=1  # Jeżeli użytkownik jest admin.
	$_SESSION["USER_LOGGED_IN"]=1   # Jeżeli użytkownik jest zwykłym użytkownikiem.
	
	$_SESSION["ADMIN_ID"] # Przechowuje admin_id obecnie zalogowanego.
	$_SESSION["USER_ID"] # Przechowuje user_id obecnie zalogowanego. 
-->

<?php

session_start();

include("config/config.php");

$_SESSION["IS_VALID_LOGIN"]= 0;
$_SESSION["ADMIN_ID"]= -1;
$_SESSION["USER_ID"]= -1;

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}


	$name=$_POST["email"];
	$pass=$_POST["password"];

	$admin_flag=0;
	$user_flag=0;
	
	$result = mysqli_query($con, "SELECT * FROM tbl_admin");

	while($row = mysqli_fetch_array($result))
	{
		if($name==$row[1] && $pass==$row[2])
		{
			$admin_flag=1;
			$_SESSION["ADMIN_ID"]= $row[0];
			$_SESSION["IS_VALID_LOGIN"]=1;
		break;
		}
	}
	
	$result = mysqli_query($con, "SELECT * FROM tbl_users");
	while($row = mysqli_fetch_array($result))
	{
		if($name==$row[1] && $pass==$row[2])
		{
			$user_flag=1;
			$_SESSION["USER_ID"]= $row[0];
			$_SESSION["IS_VALID_LOGIN"]=1;
		break;
		}
	}
	
	if($admin_flag==1)
	{			
			$_SESSION["ADMIN_LOGGED_IN"]=1;
			$_SESSION["USER_LOGGED_IN"]=0;		
	?>
	 
	<script type="text/javascript">
	 window.location="admin_homepage.php";
	</script>
	<?php
	} else if($user_flag==1)
	{			
			$_SESSION["USER_LOGGED_IN"]=1;
			$_SESSION["ADMIN_LOGGED_IN"]=0;
	?>
	<script type="text/javascript">
	 window.location="user_homepage.php";
	</script>
	<?php
	} else
	{
	$_SESSION["ADMIN_LOGGED_IN"]=0;
	$_SESSION["USER_LOGGED_IN"]=0;
	?>
	<script type="text/javascript">
		window.location="index.php";
	</script>
	<?php
	}

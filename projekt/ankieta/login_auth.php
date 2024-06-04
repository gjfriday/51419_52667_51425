<!-- Weryfikacja, czy użytkownik loguje się jako admin lub zwykły użytkownik. Najpierw sprawdza, czy login jest w tabeli tbl_admin, 
	a potem czy w tabeli tbl_users. 
1. Ustawia zmienne sesji odpowiednio na 1 or 0
	$_SESSION["ADMIN_LOGGED_IN"]=1  # Jeżeli użytkownik jest admin.
	$_SESSION["USER_LOGGED_IN"]=1   # Jeżeli użytkownik jest zwykłym użytkownikiem.
	
	$_SESSION["ADMIN_ID"] # Przechowuje admin_id obecnie zalogowanego.
	$_SESSION["USER_ID"] # Przechowuje user_id obecnie zalogowanego. 
-->

<?php
sesion start();
// include ("/ankieta/config.php");

$_SESSION["IS_VALID_LOGIN"]= 0;
$_SESSION["ADMIN_ID"]= -1;
$_SESSION["USER_ID"]= -1;

//ter paramerty trzeba będzie usunąć na rzecz pliku z config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankieta";

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con)
{
    die("Nie nawiązano połączenia z bazą danych: " . mysqli_connect_error());
}

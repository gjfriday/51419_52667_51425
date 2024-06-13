<?php

session_start();

// Sprawdzenie, czy użytkownik jest zalogowany /inaczej przeniesie do strony logowania
if (!isset($_SESSION["IS_VALID_LOGIN"]) || $_SESSION["IS_VALID_LOGIN"] != 1 || !isset($_SESSION["USER_ID"])) {
  header("Location: index.php");
  exit();
}

include("config/config.php");
include("view/header.php");
include("view/user_view.php");

$userId = $_SESSION["USER_ID"];
$userName = $_SESSION["USER_NAME"];

?>

    <div id="greetings">Witaj w Panelu Użytkownika: <?php echo htmlspecialchars($userName) . " " . "(id: " . htmlspecialchars($userId) .")"; ?> !</div>
  </body>
</html>

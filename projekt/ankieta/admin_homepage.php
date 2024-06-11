<?php

session_start();

// Sprawdzenie, czy admin jest zalogowany /inaczej przeniesie do strony logowania
if (!isset($_SESSION["IS_VALID_LOGIN"]) || $_SESSION["IS_VALID_LOGIN"] != 1 || !isset($_SESSION["ADMIN_ID"])) {
  header("Location: index.php");
  exit();
}

  include("config/config.php");
  include("view/header.php");
  include("view/admin_view.php");

  $adminId = $_SESSION["ADMIN_ID"];
  $adminName = $_SESSION["ADMIN_NAME"];

?>

    <div id="greetings">Witaj w PANELU ADMINISTRATORA! <?php echo htmlspecialchars($adminName) . " " . "(id: " . htmlspecialchars($adminId) .")"; ?> !</div>
  </body>
</html>

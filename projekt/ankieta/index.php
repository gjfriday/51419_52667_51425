<?php
  session_start();

//Weryfikacja, czy użytkownik jest już zalogowany i przekierowuje z powrotem do odpowiedniej strony.
  if (isset($_SESSION["IS_VALID_LOGIN"]) && $_SESSION["IS_VALID_LOGIN"] == 1) {
    if (isset($_SESSION["ADMIN_LOGGED_IN"]) && $_SESSION["ADMIN_LOGGED_IN"] == 1) {
        header("Location: admin_homepage.php");
        exit();
    } elseif (isset($_SESSION["USER_LOGGED_IN"]) && $_SESSION["USER_LOGGED_IN"] == 1) {
        header("Location: user_homepage.php");
        exit();
    }
}

  include("view/header.php");

?>

  <body>
    <div id="nav">
      <div id="logo"><a href="#"><img src="img/logoankieter.png" height="35" width="62.2"></a></div>
    </div>

	<!-- Formularz logowania -->
    <div class=container>
      <div id ="login">
        <div id="loginTitle">Logowanie</div>
          <form id = "loginForm" class="form-inline" method="post" action="login_auth.php">
            <div class="form-group row">
                <input type="email" name="email" class="form-control" id="email" placeholder="Login">
            </div><br>
            <div class="form-group row">
              <input type="password"  name="password" class="form-control" id="password" placeholder="Hasło">
            </div><br>
        
        <?php 

        {
          if(isset($_SESSION['IS_VALID_LOGIN']) && $_SESSION['IS_VALID_LOGIN']==0) 
          echo "Błędny login / hasło!";
        }
        ?>

        <br>
            <button type="submit" class="btn btn-primary buttonSign row">Zaloguj</button>
          </form><hr>
        <div id ="signUpLink"><a href="signup.php"> Utwórz konto</a></div>
      </div>
    </div>

  </body>
</html>
  </body>
</html>

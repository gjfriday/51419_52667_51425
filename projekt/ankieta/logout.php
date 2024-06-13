<?php

session_start();

// Kończy wszystkie sesje
if(session_destroy()) { 

header("Location: index.php"); 

}

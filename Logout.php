<?php

session_start();
header("Location:Login.php");
setcookie("rememberme", "", time() - 1, "/");
session_destroy();


?>
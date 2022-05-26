<?php

//remember me cookies 
if (isset($_COOKIE['rememberme'])) {
    $_SESSION['logined'] = true;
    $_SESSION['username'] = $_COOKIE['rememberme'];
}
if (!isset($_SESSION['logined'])) {   
        if ($page >= 1 ) {
            echo " <script> location.href = 'Login.php'; </script>
            ";
        }
   
} elseif (isset($_SESSION['logined'])) {
    if ($page == 0) {
        echo "
            <script>  location.href = 'Profile.php';      </script>
            ";
    }
}
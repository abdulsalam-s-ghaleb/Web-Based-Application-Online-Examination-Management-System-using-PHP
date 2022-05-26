<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Restpassword</title>
    <?php
    include("cssLinks.php");
    $page = 0;
    require("Keepmelogin.php");
   
    ?>
</head>
<?php

$username = "";
$phone    = "";
if (isset($_POST['Reset'])) {
    $username = $_POST['username'];
    $phone = $_POST['Phone'];
    $RPquery = mysqli_query($conn, "SELECT username,mobile_No FROM User where username = '$username' AND mobile_No='$phone'");
    $num =  mysqli_fetch_row($RPquery);
    $_SESSION['reset_pass_username'] =  $username;

    if ($num > 0) {
        // $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 

        // api call 
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://www.passwordrandom.com/query?command=password',
            CURLOPT_USERAGENT => 'Password Generator'
        ]);
        // the password generated from REST API connection 
        $generated_password_API = curl_exec($curl);
        $generated_password_API_clear = preg_replace('/[^A-Za-z0-9]/', '', $generated_password_API); // Removes special chars. 
        $password = substr(str_shuffle($generated_password_API_clear), 0, 8);
        $hash = sha1($password);
        $con = mysqli_query($conn, "UPDATE User set password = '$hash' where username = '$username' ");
        $_SESSION['message'] = "Your Password Is : " . $password;
        $_SESSION['type'] = "success";
        $_SESSION['Random_pass'] = $password;
        echo "
                <script>
                location.href = 'Changepassword.php';
                </script>
                ";
    } else {
        $_SESSION['message'] = "Username or Phone number invalid!!  " .  mysqli_error($conn);
        $_SESSION['type'] = "danger";
        include("message.php");
    }
}



?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/mbr-1266x844.jpg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Reset your password!</h4>
                                    </div>
                                    <form class="user" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group"><input class="form-control form-control-user" value="<?php echo $username; ?>" type="text" placeholder="Username" name="username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" value="<?php echo $phone; ?>" type="text" placeholder="Phone number" name="Phone"></div>
                                       
                                        <button class="btn btn-primary btn-block text-white btn-user" name="Reset" type="submit">Reset</button>

                                    </form>
                                    <div class="text-center"><a class="small" href="login.php">Go back to login</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Go back to resgister</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('jslinks.php');

    ?>


</body>

</html>
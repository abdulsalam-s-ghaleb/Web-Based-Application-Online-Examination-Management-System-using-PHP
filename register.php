<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <?php
    include("cssLinks.php"); //inculde message and Connection of database
    $page = 0;
    require("Keepmelogin.php");

    ?>
</head>
<?php

$fname = "";
$lname = "";
$email = "";
$username = "";
$phone = "";
$password = "";
$confirmpass = "";
$hash = null;
if (!isset($_POST['signup'])) {
} else {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpass = $_POST['password_repeat'];
    //Check same password (password + repeat) for confirmation
    if ($confirmpass != $password) {
        $_SESSION['message'] = "First password and confirm password is not the same! Try again.";
        $_SESSION['type'] = "danger";
        echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
    } else {
        $hash = sha1($password);
    }

    //Check validity of data entered for username
    $duplicate = mysqli_query($conn, "SELECT * FROM User WHERE username='" . $username . "'");
    if (mysqli_num_rows($duplicate) > 0) {
        $_SESSION['message'] = "Username already exists! Try use another username.";
        $_SESSION['type'] = "danger";
        echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
    }
    $duplicateeamil = mysqli_query($conn, "SELECT * FROM User WHERE email='" . $email . "'");
    if (mysqli_num_rows($duplicateeamil) > 0) {
        $_SESSION['message'] = "Email already exists! Try use another email.";
        $_SESSION['type'] = "danger";
        echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
    }


    //After everything correct
    if (!empty($hash) && mysqli_num_rows($duplicate) == 0 && mysqli_num_rows($duplicateeamil) == 0) {
        $query = "INSERT INTO User (fname,lname,email,username,password,mobile_no,user_image,role)VALUES ('$fname','$lname',
        '$email','$username','$hash','$phone','null.png','2')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Register Sucessfully!";
            $_SESSION['type'] = "success";
            echo "
                <script>
                location.href = 'Login.php';
                </script>
                ";
        } else {
            $_SESSION['message'] = "Failure to register: " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
            echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
        }
    }
}
?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"
                            style="background-image: url(&quot;assets/img/mbr-1266x882.jpg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                            type="text" id="exampleFirstName" placeholder="First Name" name="first_name"
                                            required value="<?php echo $fname; ?>"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                            id="exampleFirstName" placeholder="Last Name" name="last_name" required
                                            value="<?php echo $lname; ?>"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="email"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Email Address" name="email" required
                                            value="<?php echo $email; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="text" id="Username"
                                            aria-describedby="Username" placeholder="Username" name="username" required
                                            value="<?php echo $username; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                            type="password" placeholder="Password" name="password" required
                                            value="<?php echo $password; ?>"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                            placeholder="Phone Number" name="phone" required
                                            value="<?php echo $phone; ?>"></div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password"
                                            placeholder="Repeat Password" name="password_repeat" required
                                            value="<?php echo $confirmpass; ?>"></div>
                                </div>

                                <button class="btn btn-primary btn-block text-white btn-user" type="submit"
                                    name="signup">Register Account</button>
                            </form>
                            <div class="text-center"><a class="small" href="Resetpassword.php">Forgot Password?</a>
                            </div>
                            <div class="text-center"><a class="small" href="login.php">Already have an account?
                                    Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include('jslinks.php');

            ?>
        </div>
    </div>

</body>


</html>
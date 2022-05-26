<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile</title>
    <?php
    include("cssLinks.php");
    $page = 2;
    require("Keepmelogin.php");

    ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php

        include("sidebar.php");
        ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php

                include("aboveNavbar.php");
                ?>
                <div class="container-fluid">

                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <p class="text-primary m-2 font-weight-bold"
                                    style="margin:auto;font-size:25px !important;">
                                    <?php if (isset($_SESSION['username'])) {
                                        echo $_SESSION['username'];
                                    }
                                    ?></p>
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" <?php setimg(); ?> width="160" height="160">
                                    <div class="mb-3">
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                            enctype="multipart/form-data">
                                            <button class="btn btn-primary btn-sm" name="changepicture"
                                                type="submit">Change
                                                Photo</button>
                                            <input class="btn-primary" type="file" name="sfile" id="sfile">

                                        </form>


                                    </div>


                                </div>
                            </div>
                            <?php
                            function setimg()
                            {
                                $pic = 'null.png';
                                if (isset($_SESSION['picture'])) {
                                    $pic = $_SESSION['picture'];
                                }
                                echo 'src = "assets/img/' . $pic . ' "';
                            }

                            function changePhoto()
                            {
                                if (isset($_FILES["sfile"]["name"])) {
                                    include 'dbConnection.php';
                                    $user_id = $_SESSION['user_id'];
                                    //// Uploads files for the image
                                    $sfile = rand(1000, 10000) . "-" . $_FILES["sfile"]["name"];
                                    $temp_sfile = $_FILES["sfile"]["tmp_name"];
                                    $dir = './assets/img';
                                    move_uploaded_file($temp_sfile, $dir . '/' . $sfile);
                                    ///////////// end of uploading image
                                    $query = "UPDATE User SET user_image='$sfile' where user_id = '$user_id'";
                                    mysqli_query($conn, $query) or die(mysqli_error($conn));
                                    $_SESSION['message'] = 'Image has been changed successfully!';
                                    $_SESSION['type'] = 'success';
                                    $getimage = mysqli_query($conn, "select user_image from User where user_id='$user_id'") or die(mysqli_error($conn));
                                    if ($row = mysqli_fetch_array($getimage)) {
                                        $_SESSION['picture'] = $row['user_image'];
                                    }
                                    echo "
                                    <script>
                                    location.href = 'Profile.php';
                                    </script>
                                    ";
                                } else  //show messag "you have to select the picutre first"
                                {
                                    $_SESSION['message'] = "you have to select the picutre first!";
                                    $_SESSION['type'] = 'danger';
                                    if (isset($_SESSION['user_id'])) {
                                        echo "  <script> location.href = 'Profile.php';  </script> ";
                                    }
                                }
                            }
                            function update_personal_info() // this method for change the personal data of the user
                            {
                                include 'dbConnection.php';
                                $fname = $_POST['fname'];
                                $lname = $_POST['lname'];
                                $email = $_POST['email'];
                                $gender = $_POST['gender'];
                                $mobile_No = $_POST['mobile_No'];
                                $address = $_POST['address'];
                                $user_id = $_SESSION['user_id'];
                                $query = "UPDATE User SET fname = '$fname',lname = '$lname',email = '$email',gender = '$gender',mobile_No = 
                                '$mobile_No',address='$address' where user_id = '$user_id'";
                                $_SESSION['message'] = 'Personal Information has been changed successfully!';
                                $_SESSION['type'] = 'success';
                                $q = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                echo "
                                            <script>
                                            location.href = 'Profile.php';
                                            </script>
                                            ";
                            }

                            function checkDuplicate($username) // check if the username is exist in the database or not 
                            {
                                if ($username == $_SESSION['username']) {
                                    return false; // the user same as the user who login
                                } else {
                                    include 'dbConnection.php';
                                    $getusernames = mysqli_query($conn, "select * from User where username='$username'") or die(mysqli_error($conn));
                                    if (mysqli_num_rows($getusernames) > 0) {
                                        return true; // the username is exsit 
                                    } else
                                        return false; // the username is not exist
                                }
                            }
                            $fName = "";
                            $lName = "";
                            $username = "";
                            $password = "";
                            $email = "";
                            $gender = "";
                            // $nohashPass = "";
                            $mobile_No = "";
                            $address = "";

                            if (isset($_SESSION['user_id'])) { // cehck if the session is exist to show the user info 

                                $user_id_session = $_SESSION['user_id'];
                                $usereData = mysqli_query($conn, "SELECT * from User where user.user_id = '$user_id_session'") or die(mysqli_error($conn));
                                // while (mysqli_num_rows($courseData)) {
                                // }    
                                if ($row = mysqli_fetch_array($usereData)) {


                                    $fName = $row['fname'];
                                    $lName = $row['lname'];

                                    $username = $row['username'];
                                    //$password = $row['password'];
                                    $email = $row['email'];
                                    $gender = $row['gender'];
                                    $address = $row['address'];
                                    $mobile_No = $row['mobile_No'];

                                    //$data[$index] = $row;
                                    //   $index++;
                                }
                            }
                            if (isset($_POST['btnSavePersonal'])) //if the user click on change password
                            {
                                update_personal_info(); // call the funcation to change the password
                            }
                            if (isset($_POST['changepicture'])) // if the user click on change picture 
                            {
                                changePhoto(); // call the cunction to change the picture
                            }
                            ?>
                        </div>
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="first_name"><strong>First
                                                                    Name</strong></label><input class="form-control"
                                                                type="text" placeholder="John"
                                                                value="<?php echo $fName ?>" name="fname"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="last_name"><strong>Last
                                                                    Name</strong></label><input class="form-control"
                                                                type="text" placeholder="Doe"
                                                                value="<?php echo $lName ?>" name="lname"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="email"><strong>Email
                                                                    Address</strong></label><input class="form-control"
                                                                type="email" placeholder="user@example.com"
                                                                value="<?php echo $email ?>" name="email"></div>

                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="email"><strong>
                                                                    Address</strong></label><input class="form-control"
                                                                type="text" placeholder="user@example.com"
                                                                value="<?php echo $address ?>" name="address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="mobile_No"><strong>Mobile
                                                                    No</strong></label><input class="form-control"
                                                                type="text" placeholder="01805151"
                                                                value="<?php echo $mobile_No ?>" name="mobile_No">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                for="last_name"><strong>Gender</strong></label>
                                                            <select class="form-control" name="gender">
                                                                <?php
                                                                if ($gender == "") {
                                                                    echo ' 
                                                                 
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>';
                                                                } else if ($gender == "Male") {
                                                                    echo '   
                                                                
                                                                <option selected value="Male">Male</option>
                                                                <option value="Female">Female</option>

                                                           ';
                                                                } else if ($gender == "Female") {
                                                                    echo '
                                                                
                                                                <option  value="Male">Male</option>
                                                                <option selected value="Female">Female</option>

                                                            ';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm"
                                                        type="submit" name="btnSavePersonal">Save
                                                        Settings</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <?php include('jsLinks.php'); ?>
</body>

</html>
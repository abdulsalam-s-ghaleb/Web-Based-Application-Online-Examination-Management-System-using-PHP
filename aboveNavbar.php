<?php


function Announcement($choice) //to set the notification to the user and get how many new unread annoucment 
{

    include 'dbConnection.php';
    $user_id_session = $_SESSION['user_id'];
    $announcement = mysqli_query($conn, "SELECT
    announcement_record.*,
    announcement.*,
    announcement.createdby_user_id,
    user.user_id,
    user.fname,
    user.lname
  FROM announcement_record
    LEFT OUTER JOIN announcement
      ON announcement_record.announcement_id = announcement.announcement_id
    INNER JOIN user
      ON announcement.createdby_user_id = user.user_id WHERE Announcement_record.user_id='$user_id_session' AND Announcement_record.is_readed=0") or die(mysqli_error($conn));
    $count = 0; // count how many new announcement
    while ($row = mysqli_fetch_array($announcement)) {
        $count += 1;
        if ($choice == "data") {
            echo ' <a class="d-flex align-items-center dropdown-item" href="#">
    <div class="mr-3">
        <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
    </div>
    <div><span class="small text-gray-500">' . $row['announcement_date'] . '</span>
    <br />
    <span class="small text-gray-500">' . $row['fname'] . ' ' . $row['lname'] . '</span>
        <p>' . $row['announcement_title'] . '</p>
    </div>
    </a>';
        } else if ($choice == "count") {
            echo $count;
        }
    }
}

?>

<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop"
            type="button"><i class="fas fa-bars"></i></button>

        <ul class="nav navbar-nav flex-nowrap ml-auto">
            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                    aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto navbar-search w-100">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                placeholder="Search for ...">
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i
                                        class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                        aria-expanded="false" href="#">
                        <span class="badge badge-danger badge-counter"><?php Announcement("count"); //call the function to set the number of new announcement 
                                                                        ?>+</span><i class="fas fa-bell fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                        role="menu">
                        <h6 class="dropdown-header">Announcement</h6>
                        <?PHP

                        Announcement("data"); // cal the funcation to show the announcement to the user
                        ?>


                        <!-- <a class="d-flex align-items-center dropdown-item" href="#">
                            <div class="mr-3">
                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 12, 2019</span><br />
                                <span class="small text-gray-500">December 12, 2019</span>
                                <p>A new monthly report is ready to download!</p>
                            </div>
                        </a>


                        <a class="d-flex align-items-center dropdown-item" href="#">
                            <div class="mr-3">
                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 7, 2019</span>
                                <p>$290.29 has been deposited into your account!</p>
                            </div>
                        </a>


                        <a class="d-flex align-items-center dropdown-item" href="#">
                            <div class="mr-3">
                                <div class="bg-warning icon-circle"><i
                                        class="fas fa-exclamation-triangle text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 2, 2019</span>
                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                            </div>
                        </a> -->

                        <a class="text-center dropdown-item small text-gray-500" href="Announcement.php">Show All
                            Announcement</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1" role="presentation">

                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                </div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow" role="presentation">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                        aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"
                            style="color:black !important; font-size:25px !important;"><?php $name = "Username";
                                                                                                                                                                                                                                                                        if (isset($_COOKIE['rememberme'])) {
                                                                                                                                                                                                                                                                            $name = "{$_COOKIE['rememberme']}" . "&nbsp";
                                                                                                                                                                                                                                                                        } elseif (!isset($_COOKIE['rememberme']) && isset($_SESSION['username'])) {
                                                                                                                                                                                                                                                                            $name = $_SESSION['username'];
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        echo $name; ?></span>
                        <img class="border rounded-circle img-profile"
                            <?php $pic = 'null.png';
                                                                        if (isset($_SESSION['picture'])) {
                                                                            $pic = $_SESSION['picture'];
                                                                        }
                                                                        echo 'src = "assets/img/' . $pic . ' "'; ?>></a>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a
                            class="dropdown-item" role="presentation" href=".\profile.php"><i
                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a
                            class="dropdown-item" role="presentation" href="profile.php"><i
                                class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                        <a class="dropdown-item" role="presentation" href="Changepassword.php"><i
                                class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Change password</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" name="logout"
                            id="logout" href="logout.php"><i
                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                    </div>


                </div>
            </li>
        </ul>
    </div>
</nav>
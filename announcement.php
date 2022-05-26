<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>

    <?php
    include("cssLinks.php");
    $page = 7;
    require("Keepmelogin.php");


    ?>
</head>
<?php
function getAnnouncement($choice)
{
    include 'dbConnection.php';
    if (isset($_POST['txtSearch'])) {
        $searchTarget = $_POST['txtSearch'];
        $user_id_session = $_SESSION['user_id'];
        $courseData = mysqli_query($conn, "SELECT  announcement_record.*,  announcement.*, announcement.createdby_user_id,  user.user_id, user.fname,
        user.lname FROM announcement_record LEFT OUTER JOIN announcement  ON announcement_record.announcement_id = announcement.announcement_id
        INNER JOIN user ON announcement.createdby_user_id = user.user_id WHERE Announcement_record.user_id='$user_id_session' 
          and Announcement.announcement_title LIKE  '%$searchTarget%'") or die(mysqli_error($conn));
        $count = 0; // count how many new announcement
        while ($row = mysqli_fetch_array($courseData)) {
            $count += 1;
            if ($choice == "data") {
                echo '<tr>
    <td><img class="rounded-circle mr-2" width="30" height="30"
        src="assets/img/null.png">' . $row['announcement_id'] . '</td> <td>' . $row['fname'] . ' ' . $row['lname']  . '</td>
        <td>' . $row['announcement_date'] . '</td> <td>' . $row['announcement_title'] . '</td> <td>' . $row['announcement_text'] . '</td>';
            } else if ($choice == "count") {
                echo $count;
            }
        }
    } else {
        $user_id_session = $_SESSION['user_id'];
        $announcement = mysqli_query($conn, "SELECT announcement_record.*, announcement.*, announcement.createdby_user_id, user.user_id, user.fname,  user.lname,user.user_image
      FROM announcement_record LEFT OUTER JOIN announcement  ON announcement_record.announcement_id = announcement.announcement_id INNER JOIN user
          ON announcement.createdby_user_id = user.user_id WHERE Announcement_record.user_id='$user_id_session' ") or die(mysqli_error($conn));
        $count = 0; // count how many new announcement
        while ($row = mysqli_fetch_array($announcement)) {
            $count += 1;
            if ($choice == "data") {
                echo '<tr> <td><img class="rounded-circle mr-2" width="30" height="30"
                src="assets/img/' . $row['user_image'] . '">' . $row['announcement_id'] . '</td> <td>' . $row['fname'] . ' ' . $row['lname']  . '</td>
                <td>' . $row['announcement_date'] . '</td> <td>' . $row['announcement_title'] . '</td> <td>' . $row['announcement_text'] . '</td>           
            </tr>';
            } else if ($choice == "count") {
                echo $count;
            }
        }
    }
}
?>







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
                    <h3 class="text-dark mb-4">Announcement</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Announcement</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">
                                    <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                            <label>Show&nbsp;<select
                                                    class="form-control form-control-sm custom-select custom-select-sm">
                                                    <option value="10" selected="">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>&nbsp;</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-right dataTables_filter" id="dataTable_filter"><label>

                                                <input name="txtSearch" type="text" class="form-control form-control-sm"
                                                    aria-controls="dataTable" placeholder="Search"></label>

                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>By</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        getAnnouncement("data"); // call the funcation to print all the annoucment 
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>By</strong></td>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Title</strong></td>
                                            <td><strong>Message</strong></td>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing 1 to <?php
                                                        getAnnouncement("count");
                                                        echo "of";
                                                        getAnnouncement("count"); // call the funcation to print all the annoucment 
                                                        ?> </p>
                                </div>
                                <div class="col-md-6">
                                    <nav
                                        class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#"
                                                    aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                                        aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <<?php

                include('footer.php');
                ?> </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i
                        class="fas fa-angle-up"></i></a>
        </div>
        <?php

        include('jsLinks.php');
        ?>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <?php
    include("cssLinks.php");
    $page = 10;
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
                    <h3 class="text-dark mb-4">Teacher</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Teacher</p>
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
                                            <th>Name</th>
                                            <th>Account</th>
                                            <th>Teacher type</th>
                                            <th>Faculty</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Mobile No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['txtSearch'])) {
                                            // $courseData = mysqli_query($conn, "SELECT * from user ") or die(mysqli_error($conn));
                                            // while ($row = mysqli_fetch_array($courseData)) {
                                            //     $id = $row['user_id'];
                                            //     $fname = $row['fname'];
                                            //     $lname = $row['lname'];
                                            //     $img = "guy4.png";
                                            //     if ($id > 690) {
                                            //         $courseData1 = mysqli_query($conn, "UPDATE user set user_image='$img' where user_id='$id' and gender='Male'   ") or die(mysqli_error($conn));
                                            //     }
                                            // }
                                            $searchTarget = $_POST['txtSearch'];
                                            $courseData = mysqli_query($conn, "SELECT 
                                                teacher.*,
                                                user.*,
                                                faculty.*
                                              FROM teacher
                                                LEFT OUTER JOIN user
                                                  ON teacher.user_id = user.user_id
                                                LEFT OUTER JOIN faculty
                                                  ON teacher.faculty_id = faculty.faculty_id where user.fname
                                                   LIKE  '%$searchTarget%'") or die(mysqli_error($conn));
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($courseData)) {
                                                $count += 1;
                                                echo '<tr>
                                                    <td><img class="rounded-circle mr-2" width="30" height="30"
                                                        src="assets/img/' . $row['user_image'] . '">' . $row['teacher_id'] . '</td>    
                                                        <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                                        <td>' . $row['username'] . '</td>
                                                        <td>' . $row['teacher_type'] . '</td>
                                                        <td>' . $row['faculty_title'] . '</td>
                                                        <td>' . $row['email'] . '</td>
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['address'] . '</td>
                                                        <td>' . $row['mobile_No'] . '</td> 
                                                    </tr>';
                                            }
                                        } else {
                                            $courseData = mysqli_query($conn, "SELECT
                                            teacher.*,
                                            user.*,
                                            faculty.*
                                          FROM teacher
                                            LEFT OUTER JOIN user
                                              ON teacher.user_id = user.user_id
                                            LEFT OUTER JOIN faculty
                                              ON teacher.faculty_id = faculty.faculty_id") or die(mysqli_error($conn));
                                            // while (mysqli_num_rows($courseData)) {
                                            // }
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($courseData)) {
                                                $count += 1;
                                                echo '<tr>
                                                <td><img class="rounded-circle mr-2" width="30" height="30"
                                                    src="assets/img/' . $row['user_image'] . '">' . $row['teacher_id'] . '</td>    
                                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                                    <td>' . $row['username'] . '</td>
                                                    <td>' . $row['teacher_type'] . '</td>
                                                    <td>' . $row['faculty_title'] . '</td>
                                                    <td>' . $row['email'] . '</td>
                                                    <td>' . $row['gender'] . '</td>
                                                    <td>' . $row['address'] . '</td>
                                                    <td>' . $row['mobile_No'] . '</td> 
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Name</strong></td>
                                            <td><strong>Account</strong></td>
                                            <td><strong>Teacher type</strong></td>
                                            <td><strong>Faculty</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>Gender</strong></td>
                                            <td><strong>Address</strong></td>
                                            <td><strong>Mobile No</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing 1 to <?php echo $count . " of " . $count; ?></p>
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
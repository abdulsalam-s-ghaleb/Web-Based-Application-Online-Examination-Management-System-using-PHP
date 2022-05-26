<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Exam</title>

    <?php
    include("cssLinks.php");
    $page = 6;
    require("Keepmelogin.php");
    ?>
</head>
<?php

require_once 'process.php';


function GetDataFromDataBase($query)
{
    include("dbConnection.php");
    $data = mysqli_query($conn, $query) or die(mysqli_error($conn));
    return $data;
}
function ShowDataToDorpDownlist($data, $data_id = null)
{
    if (isset($data_id) && $data_id == $data) {
        echo '<option selected value="' . $data . '">' . $data . '</option>';
    } else {
        echo '<option value="' . $data . '">' . $data . '</option>';
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
                    <h3 class="text-dark mb-4">Exam</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Exam Info</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <label>Select&nbsp; <select class="form-control form-control-sm custom-select custom-select-sm" name="category" style="width:fit-content;">
                                                    <option value="exam.exam_title" selected>exam title</option>
                                                    <option value="exam.exam_datetime">exam datetime</option>
                                                    <option value="exam.exam_duration">exam duration</option>
                                                    <option value="exam.total_question">total question</option>
                                                    <option value="exam.status">created on</option>
                                                    <option value="course.course_title">course title</option>
                                                    <option value="faculty.faculty_title">faculty title</option>
                                                    <option value="CONCAT(user.fname, ' ',user.lname)">teacher name</option>
                                                    <option value="exam.exam_code">exam code</option>
                                                </select>&nbsp;</label>&nbsp;&nbsp;
                                            <input type="search" placeholder="Search" name="searcher">&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-sm" type="submit" name="search">Search</button>
                                        </form>
                                    </div>
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <form action="process.php" method="POST" id="formsave" style="min-width:1550px;">
                                            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                            <div class="input-group" style="padding-top: 20px;">
                                                <input type="text" name="exam_title" class="form-control" required placeholder="Enter exam title" value="<?php echo $exam_title;
                                                                                                                                                            ?>">
                                                <input type="datetime-local" data-type="datetime-local" min="<?php echo date('Y-m-d\TH:i'); ?>" required name="exam_datetime" class="form-control" placeholder="Enter exam datetime" value="<?php if (!isset($exam_datetime) && $exam_datetime == "") {
                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                echo date('Y-m-d\TH:i',  strtotime($exam_datetime));
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            ?>">
                                                <input type="number" name="exam_duration" class="form-control" min="0" max="60" required placeholder="Enter exam duration" value="<?php echo $exam_duration;
                                                                                                                                                                                    ?>">
                                                <input type="number" name="total_question" class="form-control" min="0" max="60" required placeholder="Enter total question" value="<?php echo $total_question;
                                                                                                                                                                                    ?>">

                                                <select class="form-control" id="sel1" required name="status">
                                                    <option value="">Select status</option>
                                                    <option value="1" <?php if ($status == 1) {
                                                                            echo 'selected';
                                                                        } ?>>visible</option>
                                                    <option value="0" <?php if ($status == 0) {
                                                                            echo 'selected';
                                                                        } ?>>invisible</option>
                                                </select>
                                                <select class="form-control select" id="dropcourse_title" required name="course_title">
                                                    <option value="">SELECT course title</option>
                                                    <?php
                                                    $course_data = GetDataFromDataBase("SELECT DISTINCT * FROM course");
                                                    while ($data = mysqli_fetch_array($course_data))
                                                        ShowDataToDorpDownlist($data['course_title'], $course_title);
                                                    ?>
                                                </select>
                                                <select class="form-control select" id="dropcourse_title" required name="faculty_title">
                                                    <option value="">SELECT faculty title</option>
                                                    <?php
                                                    $cfaculty_data = GetDataFromDataBase("SELECT DISTINCT * FROM faculty");
                                                    while ($data = mysqli_fetch_array($cfaculty_data))
                                                        ShowDataToDorpDownlist($data['faculty_title'], $faculty_title);
                                                    ?>
                                                </select>
                                                <select class="form-control" id="dropfullname" required name="fullname">
                                                    <option value="">SELECT teacher name</option>
                                                    <?php
                                                    $usersession = $_SESSION['user_id'];
                                                    $user_data = GetDataFromDataBase("SELECT
                                                        CONCAT(user.fname, ' ',user.lname) AS fullname,
                                                        teacher.*,
                                                        user.* 
                                                        FROM teacher
                                                        LEFT OUTER JOIN user
                                                        ON teacher.user_id = user.user_id WHERE user.user_id='$usersession'");
                                                    while ($data = mysqli_fetch_array($user_data))
                                                        ShowDataToDorpDownlist($data['fullname'], $fullname);
                                                    ?>
                                                </select>
                                                <input type="text" name="exam_code" required class="form-control" placeholder="Enter exam code" value="<?php echo $exam_code;
                                                                                                                                                        ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
                                                if (isset($update) && $update == true) {
                                                    echo '<button type="submit" class="btn btn-info" name="update">Update</button>';
                                                } else {
                                                    echo '<button type="submit" class="btn btn-primary" name="save">Save</button>';
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group" style="float: right;padding:20px">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <!-- exam_title	exam_datetime	exam_duration	total_question	created_on	status	course_id	teacher_id	faculty_id	exam_code	 -->
                                        <tr>
                                            <th>exam ID</th>
                                            <th>exam title</th>
                                            <th>exam datetime</th>
                                            <th>exam duration</th>
                                            <th>total question</th>
                                            <th>created on</th>
                                            <th>status</th>
                                            <th>course title</th>
                                            <th>faculty title</th>
                                            <th>teacher name</th>
                                            <th>exam code</th>
                                            <th colspan="2">Action</th>
                                        </tr>

                                    </thead>

                                    <?php
                                    
                                    if (isset($_GET['search'])) {
                                        $searchValue = $_GET['search'];
                                        $category = $_GET['cat'];
                                        $searchResult = $conn->query("SELECT
                                        CONCAT(user.fname, ' ',user.lname) AS fullname,
                                        exam.*,
                                        teacher.*,
                                        faculty.*,
                                        course.*,
                                        user.*
                                        FROM exam
                                        INNER JOIN faculty
                                            ON exam.faculty_id = faculty.faculty_id
                                        INNER JOIN teacher
                                            ON exam.teacher_id = teacher.teacher_id
                                        INNER JOIN user
                                            ON teacher.user_id = user.user_id
                                        INNER JOIN course
                                            ON exam.course_id = course.course_id WHERE $category LIKE '%$searchValue%'") or die($conn->error);
                                        $count = 0;
                                        while ($row = $searchResult->fetch_assoc()) {
                                            //exam_title	exam_datetime	exam_duration	total_question	created_on	status	course_id	teacher_id	faculty_id	exam_code	
                                            if ($row['status'] == 1) {
                                                $status = "visible";
                                            } else {
                                                $status = "invisible";
                                            }
                                            $datetime = date_create($row['exam_datetime']);
                                            $datecreated = date_create($row['created_on']);
                                            $count += 1;

                                            echo '
                                                <tr>
                                                    <td>' . $row['exam_id'] . '</td>
                                                    <td>' . $row['exam_title'] . '</td>
                                                    <td>' . date_format($datetime, "Y/m/d H:i:s") . '</td>
                                                    <td>' . $row['exam_duration'] . ' Minutes</td>
                                                    <td>' . $row['total_question'] . '</td>
                                                    <td>' .  date_format($datecreated, "Y/m/d H:i:s")  . '</td>
                                                    <td>' . $status . '</td>
                                                    <td>' . $row['course_title'] . '</td>
                                                    <td>' . $row['faculty_title'] . '</td>
                                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                                    <td>' . $row['exam_code'] . '</td>
                                                   <td>
                                                    <a  href="./addQs.php?search=' . $row['exam_id'] . '"
                                                    class ="btn btn-success" style="font-size:14px;padding:5px !important;">Add questions</a> 
                                                    <a href="./Exams.php?edit=' . $row['exam_id'] . '"
                                                    class ="btn btn-info" >Edit</a>
                                                    <a  href="./Exams.php?delete=' . $row['exam_id'] . '"
                                                    class ="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>                                                
                                                ';
                                        }
                                    } else {
                                        $searchResult = $conn->query("SELECT
                                            exam.*,
                                            teacher.*,
                                            faculty.*,
                                            course.*,
                                            user.*
                                            FROM exam
                                            INNER JOIN faculty
                                                ON exam.faculty_id = faculty.faculty_id
                                            INNER JOIN teacher
                                                ON exam.teacher_id = teacher.teacher_id
                                            INNER JOIN user
                                                ON teacher.user_id = user.user_id
                                            INNER JOIN course
                                                ON exam.course_id = course.course_id")
                                            or die($conn->error);
                                        $count = 0;
                                        while ($row = $searchResult->fetch_assoc()) {
                                            //exam_title	exam_datetime	exam_duration	total_question	created_on	status	course_id	teacher_id	faculty_id	exam_code	
                                            if ($row['status'] == 1) {
                                                $status = "visible";
                                            } else {
                                                $status = "invisible";
                                            }
                                            $datetime = date_create($row['exam_datetime']);
                                            $datecreated = date_create($row['created_on']);
                                            $count += 1;


                                            echo '
                                                <tr>
                                                    <td>' . $row['exam_id'] . '</td>
                                                    <td>' . $row['exam_title'] . '</td>
                                                    <td>' . date_format($datetime, "Y/m/d H:i:s") . '</td>
                                                    <td>' . $row['exam_duration'] . ' Minutes</td>
                                                    <td>' . $row['total_question'] . '</td>
                                                    <td>' .  date_format($datecreated, "Y/m/d H:i:s")  . '</td>
                                                    <td>' . $status . '</td>
                                                    <td>' . $row['course_title'] . '</td>
                                                    <td>' . $row['faculty_title'] . '</td>
                                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                                    <td>' . $row['exam_code'] . '</td>
                                                    <td>
                                                    <a  href="./addQs.php?search=' . $row['exam_id'] . '"
                                                    class ="btn btn-success" style="font-size:14px;padding:5px !important;">Add questions</a> 
                                                    <a href="./Exams.php?edit=' . $row['exam_id'] . '"
                                                    class ="btn btn-info" >Edit</a>
                                                    <a  href="./Exams.php?delete=' . $row['exam_id'] . '"
                                                    class ="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>                                                
                                                ';
                                        }
                                    }
                                    ?>

                                    <tfoot>
                                        <tr>
                                            <th>exam title</th>
                                            <th>exam datetime</th>
                                            <th>exam duration</th>
                                            <th>total question</th>
                                            <th>created on</th>
                                            <th>status</th>
                                            <th>course title</th>
                                            <th>faculty title</th>
                                            <th>teacher name</th>
                                            <th>exam code</th>
                                            <th colspan="2">Action</th>
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
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
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
                ?> </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

        </div>
        <?php

        include('jsLinks.php');
        ?>
</body>

</html>
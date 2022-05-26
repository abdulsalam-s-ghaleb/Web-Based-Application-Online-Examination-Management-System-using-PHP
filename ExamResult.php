<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Exam results</title>

    <?php
    include("cssLinks.php");
    $page = 8;
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
                    <h3 class="text-dark mb-4">Exams result</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Exams result</p>
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
                                            <th>Exam ID</th>
                                            <th>Exam title</th>
                                            <th>Exam duration</th>
                                            <th>Total quesion</th>
                                            <th>Date</th>
                                            <th>Faculty title</th>
                                            <th>Course title</th>
                                            <th>Student name</th>
                                            <th>account</th>
                                            <th>Q_answered</th>
                                            <th>Mark</th>
                                            <th>Out of</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user_role = "";
                                        if (isset($_SESSION['role']))  // save the user role to avoid user to see other student mark
                                        {
                                            if ($_SESSION['role'] == "2") {
                                                $user_role = "2";
                                            }
                                        }
                                        if (isset($_POST['txtSearch'])) {
                                            $searchTarget = $_POST['txtSearch'];
                                            $courseData = mysqli_query($conn, "SELECT
                                            exam.exam_id,
                                            exam.exam_title,
                                            COUNT(student_record.question_id) AS questions_answered, student_record.user_id,  user.fname,   user.lname,
                                            user.username,    exam.total_question,    exam.exam_duration,    exam.exam_datetime,  course.course_title,
                                            faculty.faculty_title, SUM(student_record.mark) AS totall_mark_score, SUM(question.mark) AS totall_q_mark,
                                              ((SUM(student_record.mark)/SUM(question.mark))*100) AS student_mark
                                          FROM student_record
                                            LEFT OUTER JOIN exam ON student_record.exam_id = exam.exam_id
                                            LEFT OUTER JOIN user ON student_record.user_id = user.user_id
                                            LEFT OUTER JOIN course ON exam.course_id = course.course_id
                                            LEFT OUTER JOIN faculty ON exam.faculty_id = faculty.faculty_id
                                            INNER JOIN question ON student_record.question_id = question.question_id where exam.exam_title LIKE  '%$searchTarget%' and 
                                              user.role LIKE  '%$user_role%'
                                          GROUP BY exam.exam_id,
                                                   exam.exam_title,  exam.exam_datetime,
                                                   exam.exam_duration,   exam.total_question,   student_record.user_id,  user.fname, user.lname,  user.username,course.course_title,
                                                   faculty.faculty_title") or die(mysqli_error($conn));
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($courseData)) {
                                                $count += 1;
                                                $datecreated = date_create($row['exam_datetime']);
                                                echo '<tr>
                                                <td style="color:white;">
                                                
                                                <div class="bg-primary icon-circle">
                                                <i class="fas fa-file-alt text-white">&nbsp;</i>                                                                                                    
                                                    ' . $row['exam_id'] . ' </div></td>

                                                    <td>' . $row['exam_title'] . '</td>
                                                    <td>' . $row['exam_duration'] . '</td>
                                                    <td>' . $row['total_question'] . '</td>
                                                    <td>' . date_format($datecreated, "Y/m/d H:i:s") . '</td>
                                                    <td>' . $row['faculty_title'] . '</td>
                                                    <td>' . $row['course_title'] . '</td>
                                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>      
                                                    <td>' . $row['username'] . '</td>                                                                             
                                                    <td>' . $row['questions_answered'] . '</td>                                               
                                                    <td>' . $row['totall_mark_score'] . '</td>
                                                    <td>' . $row['totall_q_mark'] . '</td>
                                                    <td>' . $row['student_mark'] . '%' . '</td>
                                                </tr>';
                                            }
                                        } else {
                                            $courseData = mysqli_query($conn, "SELECT
                                            exam.exam_id,
                                            exam.exam_title,
                                            COUNT(student_record.question_id) AS questions_answered,
                                            student_record.user_id,   user.fname, user.lname, user.username, exam.total_question,
                                            exam.exam_duration,    exam.exam_datetime, course.course_title, faculty.faculty_title,
                                            SUM(student_record.mark) AS totall_mark_score,  SUM(question.mark) AS totall_q_mark,
                                              ((SUM(student_record.mark)/SUM(question.mark))*100) AS student_mark FROM student_record
                                            LEFT OUTER JOIN exam  ON student_record.exam_id = exam.exam_id
                                            LEFT OUTER JOIN user   ON student_record.user_id = user.user_id
                                            LEFT OUTER JOIN course   ON exam.course_id = course.course_id LEFT OUTER JOIN faculty ON exam.faculty_id = faculty.faculty_id
                                            INNER JOIN question ON student_record.question_id = question.question_id where user.role LIKE  '%$user_role%'                                           
                                          GROUP BY exam.exam_id,  exam.exam_title,   exam.exam_datetime,  exam.exam_duration,  exam.total_question,  student_record.user_id,
                                                   user.fname,  user.lname,  user.username,  course.course_title,  faculty.faculty_title") or die(mysqli_error($conn));
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($courseData)) {
                                                $count += 1;
                                                $datecreated = date_create($row['exam_datetime']);
                                                echo '<tr>
                                                <td style="color:white;">                                              
                                                <div class="bg-primary icon-circle">
                                                <i class="fas fa-file-alt text-white">&nbsp;</i>                                                                                                    
                                                    ' . $row['exam_id'] . ' </div></td>
                                                    <td>' . $row['exam_title'] . '</td>
                                                    <td>' . $row['exam_duration'] . '</td>
                                                    <td>' . $row['total_question'] . '</td>
                                                    <td>' . date_format($datecreated, "Y/m/d H:i:s") . '</td>
                                                    <td>' . $row['faculty_title'] . '</td>
                                                    <td>' . $row['course_title'] . '</td>
                                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td> 
                                                    <td>' . $row['username'] . '</td>                                                                    
                                                    <td>' . $row['questions_answered'] . '</td>                                               
                                                    <td>' . $row['totall_mark_score'] . '</td>
                                                    <td>' . $row['totall_q_mark'] . '</td>
                                                    <td>' . $row['student_mark'] . '%' . '</td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Exam ID</strong></td>
                                            <td><strong>Exam title</strong></td>
                                            <td><strong>Exam duration</strong></td>
                                            <td><strong>Total quesion</strong></td>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Faculty title</strong></td>
                                            <td><strong>Course title</strong></td>
                                            <td><strong>student name</strong></td>
                                            <td><strong>account</strong></td>

                                            <td><strong>Q_answered</strong></td>
                                            <td><strong>Mark</strong></td>
                                            <td><strong>Out of</strong></td>
                                            <td><strong>Grade</strong></td>
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
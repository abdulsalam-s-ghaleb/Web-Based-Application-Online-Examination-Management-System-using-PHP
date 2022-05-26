<?php
include("dbConnection.php");
$exam_id = 0;
$exam_title = "";
$exam_datetime = null;
$exam_duration = "";
$total_question = "";
$status = "";
$course_title = "";
$faculty_title = "";
$fullname = "";
$exam_code = "";

$update = false;

if (isset($_POST['save'])) {

    $exam_title =  mysqli_real_escape_string($conn, $_POST['exam_title']);
    $exam_datetime =    mysqli_real_escape_string($conn, $_POST['exam_datetime']);
    $exam_duration = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $faculty_title = mysqli_real_escape_string($conn, $_POST['faculty_title']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $exam_code = mysqli_real_escape_string($conn, $_POST['exam_code']);


    if (empty($_POST['exam_title'])) {
        echo "<script>
                alert('exam title is required');
                </script>";
    } else if (empty($_POST['exam_datetime'])) {
        echo "<script>
        alert('exam datetime is required');
        </script>";
    } else if (empty($_POST['exam_duration'])) {
        echo "<script>
        alert('exam duration is required');
        </script>";
    } else if (empty($_POST['total_question'])) {
        echo "<script>
        alert('total question is required');
        </script>";
    } else if (empty($_POST['exam_code'])) {
        echo "<script>
        alert('exam code is required');
        </script>";
    } else if (empty($_POST['course_title'])) {
        echo "<script>
        alert('course title  is required');
        </script>";
    } else if (empty($_POST['faculty_title'])) {
        echo "<script>
        alert('faculty title  is required');
        </script>";
    } else if (empty($_POST['fullname'])) {
        echo "<script>
        alert('teacher name  is required');
        </script>";
    } else if ($status == "" || ($status != "0" && $status != "1")) {
        echo "<script>
        alert('status is required');
        </script>";
    } else {

        $course_id = mysqli_query($conn, "SELECT course_id FROM course WHERE course_title='$course_title'") or die(mysqli_error($conn));
        $course_id = mysqli_fetch_array($course_id);
        $faculty_id = mysqli_query($conn, "SELECT faculty_id FROM faculty WHERE faculty_title='$faculty_title'") or die(mysqli_error($conn));
        $faculty_id = mysqli_fetch_array($faculty_id);

        $teacher_id = mysqli_query($conn, " SELECT
                                    teacher.teacher_id
                                    FROM user
                                    RIGHT OUTER JOIN teacher
                                        ON user.user_id = teacher.user_id  
                                    WHERE CONCAT(user.fname, ' ',user.lname) ='$fullname'") or die(mysqli_error($conn));
        if ($teacher_id = mysqli_fetch_array($teacher_id)) {
            $teacher_id = $teacher_id[0];
        } else {
            echo "<script>
            alert('Teatcher name not found in selected course OR faculty. \n select other one');
            window.location.href='Exams.php';
            </script>";
        }

        $success = mysqli_query($conn, "INSERT INTO exam (exam_title, exam_datetime, exam_duration, total_question, status, course_id, teacher_id, faculty_id, exam_code) VALUES ('$exam_title','$exam_datetime','$exam_duration','$total_question','$status','$course_id[0]','$teacher_id','$faculty_id[0]','$exam_code')") or die(mysqli_error($conn));
        if ($success) {
            session_start();
            $_SESSION['message'] = "Record has been saved!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to saved! because this: " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
        }
    }
    echo "<script>window.location.href='Exams.php';</script>";
    exit;
}

if (isset($_POST['search'])) {
    if (empty($_POST['searcher'])) {
        echo "<script>window.location.href='Exams.php';</script>";
        exit;
    } else {
        $searchValue = $conn->real_escape_string($_POST['searcher']);
        $category = $conn->real_escape_string($_POST['category']);
        echo "<script>window.location.href='Exams.php?search=$searchValue&cat=$category';</script>";
        exit;
    }
}
//////////addQs
if (isset($_POST['search2'])) {
    if (empty($_POST['searcher2'])) {
        echo "<script>window.location.href='addQs.php';</script>";
        exit;
    } else {
        $searchValue = $conn->real_escape_string($_POST['searcher2']);        
        echo "<script>window.location.href='addQs.php?search=$searchValue';</script>";
        exit;
    }
}
//////////TakeExam
if (isset($_POST['search3'])) {
    if (empty($_POST['searcher3'])) {
        echo "<script>
        window.location.href='TakeExam.php';
        alert('First you need to enter Exam code');
        </script>";
        exit;
    } else {
        $searchValue = $_POST['searcher3'];
        echo "<script>window.location.href='TakeExam.php?search=$searchValue';</script>";
        exit;
    }
}


//////////////////
if (isset($_GET['delete'])) {
    $exam_id = $_GET['delete'];
    $conn->query("DELETE FROM Exam WHERE exam_id=$exam_id") or die($conn->error);
    session_start();
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['type'] = "danger";
    echo "<script>window.location.href='Exams.php';</script>";
    exit;
}


///////////////////
if (isset($_GET['edit'])) {
    $exam_id = $_GET['edit'];
    $update = true;
    $result = mysqli_query($conn, "SELECT DISTINCT CONCAT(user.fname, ' ',user.lname) AS fullname, exam.*, 
    teacher.*, faculty.*, course.*, user.*  FROM exam INNER JOIN faculty ON exam.faculty_id = faculty.faculty_id 
    INNER JOIN teacher ON exam.teacher_id = teacher.teacher_id INNER JOIN user ON teacher.user_id = user.user_id 
    INNER JOIN course ON exam.course_id = course.course_id WHERE exam.exam_id=$exam_id") or die(mysqli_error($conn));
    $num = mysqli_fetch_array($result);
    if ($num >= 1) {        
        $exam_title =  $num['exam_title'];
        $exam_datetime = $num['exam_datetime'];
        $exam_duration = $num['exam_duration'];
        $total_question = $num['total_question'];
        $status = $num['status'];
        $course_title = $num['course_title'];
        $faculty_title = $num['faculty_title'];
        $fullname = $num['fullname'];
        $exam_code = $num['exam_code'];
    }
}
if (isset($_GET['addQ'])) {
    $exam_id = $_GET['addQ'];
    $result = mysqli_query($conn, "SELECT DISTINCT CONCAT(user.fname, ' ',user.lname) AS fullname, exam.*, teacher.*, faculty.*, course.*, user.*  FROM exam INNER JOIN faculty ON exam.faculty_id = faculty.faculty_id INNER JOIN teacher ON exam.teacher_id = teacher.teacher_id INNER JOIN user ON teacher.user_id = user.user_id INNER JOIN course ON exam.course_id = course.course_id WHERE exam.exam_id=$exam_id") or die(mysqli_error($conn));
    $num = mysqli_fetch_array($result);
    if ($num >= 1) {
        $exam_title =  $num['exam_title'];
        $exam_datetime = $num['exam_datetime'];
        $exam_duration = $num['exam_duration'];
        $total_question = $num['total_question'];
        $status = $num['status'];
        $course_title = $num['course_title'];
        $faculty_title = $num['faculty_title'];
        $fullname = $num['fullname'];
        $exam_code = $num['exam_code'];
      
    }
    echo "<script>window.location.href='addQs.php?';</script>";
        
}

//////////////////////////
if (isset($_POST['update'])) {
    $exam_id = $_POST['exam_id'];
    $exam_title =  mysqli_real_escape_string($conn, $_POST['exam_title']);
    $exam_datetime =    mysqli_real_escape_string($conn, $_POST['exam_datetime']);
    $exam_duration = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $faculty_title = mysqli_real_escape_string($conn, $_POST['faculty_title']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $exam_code = mysqli_real_escape_string($conn, $_POST['exam_code']);


    $course_id = mysqli_query($conn, "SELECT course_id FROM course WHERE course_title='$course_title'") or die(mysqli_error($conn));
    $course_id = mysqli_fetch_array($course_id);
    $faculty_id = mysqli_query($conn, "SELECT faculty_id FROM faculty WHERE faculty_title='$faculty_title'") or die(mysqli_error($conn));
    $faculty_id = mysqli_fetch_array($faculty_id);

    $teacher_id = mysqli_query($conn, "SELECT  DISTINCT teacher.teacher_id FROM exam  INNER JOIN teacher    ON exam.teacher_id = teacher.teacher_id
        INNER JOIN faculty    ON exam.faculty_id = faculty.faculty_id AND teacher.faculty_id = faculty.faculty_id INNER JOIN course
            ON exam.course_id = course.course_id AND course.teacher_id = teacher.teacher_id AND course.faculty_id = faculty.faculty_id
        INNER JOIN user ON teacher.user_id = user.user_id WHERE CONCAT(user.fname, ' ',user.lname)='$fullname'") or die(mysqli_error($conn));
    if ($teacher_id = mysqli_fetch_array($teacher_id)) {
        $teacher_id = $teacher_id[0];
    } else {
        echo "<script>
            alert('Teatcher name not found in selected course OR faculty. \n select other one');
            window.location.href='Exams.php';
            </script>";
    }

    $conn->query("UPDATE Exam SET exam_title='$exam_title',exam_datetime='$exam_datetime',exam_duration='$exam_duration',total_question='$total_question',status='$status',course_id='$course_id[0]',teacher_id='$teacher_id',faculty_id='$faculty_id[0]',exam_code='$exam_code' WHERE exam_id=$exam_id") or die($con->error);
    session_start();
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['type'] = "warning";
    echo "<script>window.location.href='Exams.php';</script>";
}


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Take exam</title>

    <?php
    include("cssLinks.php");
    $page = 11;
    require("Keepmelogin.php");
    ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/TimeCircles.css" />
    <script src="style/TimeCircles.js"></script>
</head>
<?php
$exam_duration = '';
$remaining_minutes = '';
require_once 'process.php';
if (isset($_POST['Submitdata'])) {
    $count = 0;
    $mark = 0;
    $questions = $_SESSION['Qs'];
    $user_id = $_SESSION['user_id'];
    $exam_id1 = $_POST['exam_id'];
    $success2 = mysqli_query($conn, "SELECT DISTINCT * FROM question  LEFT OUTER JOIN exam
        ON question.exam_id = exam.exam_id LEFT OUTER JOIN question_opetions ON question_opetions.question_id = question.question_id
    WHERE exam.exam_id = '$exam_id1' GROUP BY  question.question_id  ") or die(mysqli_error($conn));
    for ($x = 0; $x < $questions; $x++) {
        $answer_option = $_POST['answer_option' . $x . ''];
        $question_id = $_POST['question_id' . $x . ''];

        if ($success2) {
            $row = mysqli_fetch_array($success2);
            $correct_option =  $row['answer_option'];
            $correct_mark =  $row['mark'];

            if ($correct_option == $answer_option) {
                $mark = $correct_mark;
            } else {
                $mark = 0;
            }
            $queryToStudentRec = mysqli_query($conn, "INSERT INTO student_record (user_id, exam_id, question_id, answer, mark)  VALUES ('$user_id','$exam_id1','$question_id','$answer_option','$mark')") or die(mysqli_error($conn));

            if ($queryToStudentRec) {
                $_SESSION['message'] = "Your answer has been saved!";
                $_SESSION['type'] = "success";
                echo "<script>window.location.href='TakeExam.php';</script>";
            } else {
                $_SESSION['message'] = "Failed to saved! because this: " .  mysqli_error($conn);
                $_SESSION['type'] = "danger";
                echo "<script>window.location.href='TakeExam.php';</script>";
            }
        } else {
            $_SESSION['message'] = "Failed to saved! because this: " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
            echo "<script>window.location.href='TakeExam.php';</script>";
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
                    <h3 class="text-dark mb-4">Take Exam</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Exam Question</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <!-- <input type="hidden" name="exam_id" value="<?php $_REQUEST['search']; ?>"> -->
                                            <input type="search" placeholder="Search by exame code" name="searcher3">&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-sm" type="submit" name="search3">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <!-- <input type="hidden" name="exam_id" value="<?php $_GET['search']; ?>"> -->
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Question Title</th>
                                                <th>Question Options</th>
                                                <th>Your Selection NO.</th>
                                                <th>Question marks</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        function console_log($data)
                                        {
                                            echo '<script>';
                                            echo 'console.log(' . json_encode($data) . ')';
                                            echo '</script>';
                                        }
                                        $exam_duration = 0;
                                        if (isset($_GET['search'])) {

                                            $searchValue = $_GET['search'];
                                            $searchResult = $conn->query("SELECT DISTINCT * FROM exam WHERE exam.exam_code = '$searchValue'") or die($conn->error);
                                            $tableQuestion = $conn->query("SELECT DISTINCT * FROM question  LEFT OUTER JOIN exam
                                                            ON question.exam_id = exam.exam_id LEFT OUTER JOIN question_opetions ON question_opetions.question_id = question.question_id
                                                        WHERE exam.exam_code =  '$searchValue' GROUP BY  question.question_id") or die($conn->error);
                                            $count = 0;

                                            while ($row = $searchResult->fetch_assoc()) {
                                                $numberOfQs = $row['total_question'];
                                                $exam_duration = $row['exam_duration'] . ' minute';
                                                $num = 0;
                                                echo '
                                              <input type="hidden" name="exam_id" value="' . $row['exam_id'] . '">
                                                ';

                                                $_SESSION['Qs'] = $numberOfQs;
                                                $rowsnum = 1;
                                                for ($num = 0; $num < $numberOfQs; $num++) {
                                                    $table_Question_arr = mysqli_fetch_array($tableQuestion); ///*************************** ✔✔✔*/
                                                    if (!empty($table_Question_arr)) {
                                                        echo '
                                                    <input type="hidden" name="question_id' . $num . '" value="' . $table_Question_arr['question_id'] . '">
                                                    ';
                                                        echo
                                                        '<tr>
                                                    <td> 
                                                    <label style="color:black;"><h4> Question No ' . $rowsnum . '</h4> <br/>  <h5> ' . $table_Question_arr['question_title'] . '<h6></label>                                                   
                                                    </td>';
                                                        echo '<td>';
                                                        $question_id_table = $table_Question_arr['question_id'];
                                                        $question_opetions_table = $conn->query("SELECT DISTINCT * FROM question  LEFT OUTER JOIN exam
                                                            ON question.exam_id = exam.exam_id LEFT OUTER JOIN question_opetions ON question_opetions.question_id = question.question_id
                                                        WHERE question_opetions.question_id =  '$question_id_table'") or die($conn->error);
                                                        while ($table_question_opetions_arr = mysqli_fetch_array($question_opetions_table)) {
                                                            $count += 1;
                                                            echo '<label style="color:black;" name="opetion_title' . $count . '"><h6> Opetion No. ' . $count . ':   ' . $table_question_opetions_arr['opetion_title'] . '</h6> </label> <br/>';
                                                        }
                                                        $count = 0;
                                                        echo '</td>';
                                                        echo '<td>
                                                        <label style="color:black;"><h5> Select your answer NO. </h5> &nbsp; <select class="form-control form-control-sm custom-select custom-select-sm" name="answer_option' . $num . '" style="width:fit-content;">
                                                            <option value="1" selected>1</option> 
                                                            <option value="2">2</option>
                                                            <option value="3">3</option> 
                                                            <option value="4">4</option>
                                                        </select>&nbsp;</label>
                                                        </td>
                                                        ';
                                                        echo '<td>
                                                        <label style="color:black;" name="question_title' . $num . '"><br/> <h5>  ' . $table_Question_arr['mark'] . ' marks </h5> </label> 
                                                        </td>
                                                        ';
                                                        echo '</tr>';

                                                        echo '</tr>';
                                                    } else {
                                                        $_SESSION['message'] = "Wrong exam code entered Or exam haven't been created by teacher!";
                                                        $_SESSION['type'] = "danger";
                                                        echo "
                                                            <script>
                                                            location.href = 'TakeExam.php';
                                                            </script>
                                                            ";
                                                    }
                                                    $rowsnum++;
                                                }
                                            }
                                            $exam_end_time = strtotime($exam_duration);
                                            $exam_end_time = date('Y-m-d H:i:s', $exam_end_time);
                                            $remaining_minutes = strtotime($exam_end_time) - time();
                                            echo '
                                             <div style="float: right;">
                                                <div id="exam_timer" data-timer="' . $remaining_minutes . '" style="max-width:400; width: 100%; height: 200px;"></div>
                                            </div>
                                            ';
                                        }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>Question Title</th>
                                                <th>Opetions</th>
                                                <th>Correct opetion NO.</th>
                                                <th>Question marks</th>
                                                <!-- <th colspan="2">Action</th> -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button class="btn btn-primary btn-sm" style="float: right;" type="submit" id="butnsubmit" onclick="//alert('clicked')" name=" Submitdata">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <<?php
                include('footer.php');
                ?> </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
</body>
</html>
<script>
    $("#exam_timer").TimeCircles({
        time: {
            Days: {
                show: false
            },
            Hours: {
                show: false
            }
        }
    });
    setInterval(function() {
        var remaining_second = $("#exam_timer").TimeCircles().getTime();
        var i = 1;
        if (remaining_second < i) {           
            document.getElementById("butnsubmit").click(); // Click on the button     
        }
    }, 50);
</script>
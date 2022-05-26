<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add questions</title>

    <?php
    include("cssLinks.php");
    $page = 9;
    require("Keepmelogin.php");
    ?>
</head>
<?php

require_once 'process.php';
$initilizer = array(1, 5, 9, 13, 17, 21, 25, 29, 33, 37, 41, 45, 49, 53, 57, 61, 65, 69, 73, 77, 81, 85, 89, 93, 97, 101, 105, 109, 113, 117, 121, 125);
if (isset($_POST['Submitdata'])) {
    $count = 0;
    $questions = $_SESSION['Qs'];
    $exam_id1 = $_POST['exam_id'];
    for ($x = 0; $x < $questions; $x++) {
        $question_title = $_POST['question_title' . $x . ''];
        $answer_option = $_POST['answer_option' . $x . ''];
        $mark = $_POST['mark' . $x . ''];
        //INSERT INTO `question`(`question_id`, `question_title`, `answer_option`, `mark`, `exam_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
        //INSERT INTO `question_opetions`(`opetion_id`, `question_id`, `opetion_title`, `opetion_number`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $success = mysqli_query($conn, "INSERT INTO question (question_title, answer_option, mark, exam_id ) VALUES ('$question_title','$answer_option','$mark','$exam_id1')") or die(mysqli_error($conn));
        if ($success) {

            $success2 = mysqli_query($conn, "  SELECT 
                MAX(question.question_id) AS LASTQUS
                FROM question
                LEFT OUTER JOIN exam
                ON question.exam_id = exam.exam_id
                LEFT OUTER JOIN question_opetions
                ON question.question_id = question_opetions.question_id
                WHERE exam.exam_id = '$exam_id1' ") or die(mysqli_error($conn));
            $question_id = mysqli_fetch_array($success2);
            // for ($option = $x; $option < $x + 4; $option++) {
            for ($option = $initilizer[$x]; $option < $initilizer[$x] + 4; $option++) {
                $opetion_title = $_POST['opetion_title' . $option . ''];
                $count += 1;
                //$ques_id = $count - 1;
                $success2 = mysqli_query($conn, "INSERT INTO question_opetions (question_id, opetion_title, opetion_number) VALUES ('$question_id[0]','$opetion_title','$count')") or die(mysqli_error($conn));
            }
            $count = 0;
            $_SESSION['message'] = "Record has been saved!";
            $_SESSION['type'] = "success";
            echo "<script>window.location.href='addQs.php';</script>";
        } else {
            $_SESSION['message'] = "Failed to saved! because this: " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
            echo "<script>window.location.href='addQs.php';</script>";
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
                    <h3 class="text-dark mb-4">Exam questions</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Add Question to exam</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <!-- <input type="hidden" name="exam_id" value="<?php $_REQUEST['search']; ?>"> -->
                                            <input type="search" placeholder="Search by exame ID" name="searcher2">&nbsp;&nbsp;
                                            <button class="btn btn-primary btn-sm" type="submit" name="search2">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <!-- <input type="hidden" name="exam_id" value="<?php $_GET['search']; ?>"> -->
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <!-- exam_title	exam_datetime	exam_duration	total_question	created_on	status	course_id	teacher_id	faculty_id	exam_code	 -->
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>Question Title</th>
                                                <th>Options </th>
                                                <th>Correct option NO.</th>
                                                <th>Question marks</th>
                                                <!-- <th colspan="2">Action</th> -->
                                            </tr>

                                        </thead>

                                        <?php
                                        if (isset($_GET['search'])) {                                           
                                            $searchValue = $_GET['search'];
                                            echo '
                                              <input type="hidden" name="exam_id" value="' . $searchValue . '">
                                            ';
                                            $searchResult = $conn->query("SELECT DISTINCT * FROM exam WHERE exam.exam_id = '$searchValue'") or die($conn->error);
                                            $count = 0;

                                            while ($row = $searchResult->fetch_assoc()) {
                                                $numberOfQs = $row['total_question'];
                                                $_SESSION['Qs'] = $numberOfQs;
                                                for ($i = 0; $i < $numberOfQs; $i++) {
                                                    echo
                                                    '<tr><td>  <input type="text" name="question_title' . $i . '" class="form-control"  required placeholder="Enter your question title" value=""></td>';
                                                    echo '<td>';
                                                    for ($option = $initilizer[$i]; $option < $initilizer[$i] + 4; $option++) {
                                                        $count += 1;
                                                        echo '<input type="text" name="opetion_title' . $option . '" class="form-control" style="margin:10px" required placeholder="Enter the NO.' . $count . ' option title" value="">';
                                                    }
                                                    $count = 0;

                                                    echo '</td>';
                                                    echo '<td>
                                                <label>Select correct opetion NO.&nbsp; <select class="form-control form-control-sm custom-select custom-select-sm" name="answer_option' . $i . '" style="width:fit-content;">
                                                    <option value="1" selected>1</option> 
                                                    <option value="2">2</option>
                                                    <option value="3" >3</option> 
                                                    <option value="4">4</option>
                                                </select>&nbsp;</label>
                                                </td>
                                                ';
                                                    echo '<td>
                                                <input type="text" name="mark' . $i . '" class="form-control" style="margin:10px" required placeholder="Enter the marks" value="">
                                                </td>
                                                ';
                                                    echo '</tr>';
                                                }
                                                echo '</tr>';
                                            }
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
                                    <button class="btn btn-primary btn-sm" style="float: right;" type="submit" name="Submitdata">Submit</button>
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
        <?php

        include('jsLinks.php');
        ?>
</body>

</html>
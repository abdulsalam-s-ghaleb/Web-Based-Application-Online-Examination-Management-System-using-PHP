<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <?php
    include("cssLinks.php");
    $page = 12;
    require("Keepmelogin.php");
    ?>
</head>
<?php
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
function getfaculty()
{
    include 'dbConnection.php';
    $getcoursesQ = mysqli_query($conn, "SELECT faculty.faculty_title FROM faculty");
    while ($row = mysqli_fetch_array($getcoursesQ)) {
        $course = $row['faculty_title'];
        echo '<option value="' . $course . '">' . $course . '</option>';
    }
}
function createAnnouncement()
{
    include 'dbConnection.php';
    $faculty = $_POST['faculty'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $user = $_SESSION['user_id'];
    // create new annoument first
    $create = mysqli_query($conn, "INSERT INTO announcement 
    (announcement_title, announcement_text, createdby_user_id)VALUES ('$title','$message', '$user')") or die(mysqli_error($conn));;
    if ($create) {
        // create in anncoument record to be visible to specifc student
        $getfacultyQ = mysqli_query($conn, "SELECT * FROM student  LEFT OUTER JOIN faculty
          ON student.faculty_id = faculty.faculty_id INNER JOIN user
          ON student.user_id = user.user_id where faculty_title='$faculty'") or die(mysqli_error($conn)); // to get the student id who has same faculty
        while ($row = mysqli_fetch_array($getfacultyQ)) {
            $user_id = $row['user_id']; // get student_id who has same faculty
            $getannoucment_id = mysqli_query($conn, "SELECT *
      FROM Announcement  WHERE announcement.announcement_title='$title'") or die(mysqli_error($conn)); // to get the student id who has same faculty
            if ($row1 = mysqli_fetch_array($getannoucment_id)) {
                $announcementid = $row1['announcement_id'];
                // after getting the annoucment id , then now print the data to anncoument record based on the users selction 
                $createannouncmentRecord = mysqli_query($conn, "INSERT INTO announcement_record (announcement_id, user_id, is_readed)
                VALUES ('$announcementid', '$user_id', '0')") or die(mysqli_error($conn));;
                if ($createannouncmentRecord) {
                    // the annoument for this user has been created
                }
            }
        }
        $_SESSION['message'] = "Announcement has been sent successfully! ";
        $_SESSION['type'] = "success";
        echo "<script>window.location.href='addAnnouncement.php';</script>";
    } else {
        $_SESSION['message'] = "Failed to sent! because this: " .  mysqli_error($conn);
        $_SESSION['type'] = "danger";
        echo "<script>window.location.href='addAnnouncement.php';</script>";
    }
}

if (isset($_POST['submit'])) {
    createAnnouncement();
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
                    <h3 class="text-dark mb-4">Send announcement</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Send announcement</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>To course</th>
                                                <th>Annoucment title</th>
                                                <th>message</th>
                                                <th>send </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width:20%">
                                                    <select class="form-control" style="width:100%" name="faculty"
                                                        id="faculty">
                                                        <?php
                                                        getfaculty(); // call the function to print the all the type of courses 
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea style="width:100%; " name="title" id="title"></textarea>
                                                </td>
                                                <td> <textarea style="width:100%; height:200px; " name="message"
                                                        id="message"></textarea></td>
                                                <td style="width:0.5%">
                                                    <button class="btn btn-primary btn-sm" style="width:100%;  "
                                                        name="submit" id="submit" type="submit">Send
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>To</strong></td>
                                                <td><strong>Annoucment title</strong></td>
                                                <td><strong>message</strong></td>
                                                <td><strong>send</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                            <div class=" row">
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
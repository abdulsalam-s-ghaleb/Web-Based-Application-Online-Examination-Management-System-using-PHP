 <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
     <div class="container-fluid d-flex flex-column p-0">
         <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
             <div class="sidebar-brand-icon rotate-n-15"> <img data-aos="fade-right" data-aos-duration="1700"
                     src="assets/img/php%20(1).png" style="height: 40px;margin-top: 5px;"></div>
             <div class="sidebar-brand-text mx-3" style="margin-left: -5px;"><span>Online <br>Examination</span></div>
         </a>
         <hr class="sidebar-divider my-0">
         <ul class="nav navbar-nav text-light" id="accordionSidebar">
             <?php if ($_SESSION["role"] == 2) { ?>
             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 2) {
                                                                                    echo "active";
                                                                                } ?>" href="profile.php"><i
                         class="fas fa-user"></i><span>User Profile</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 7) {
                                                                                    echo "active";
                                                                                } ?>" href="announcement.php"><i
                         class="fas fa-table"></i><span>Announcement</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 8) {
                                                                                    echo "active";
                                                                                } ?>" href="ExamResult.php"><i
                         class="fas fa-table""></i><span>Exams result</span></a></li>
                <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 11) {
                                                                                    echo "active";
                                                                                } ?>" href="TakeExam.php"><i
                                 class="fas fa-user"></i><span>Take Exam</span></a></li>
             <?php } else { ?>

             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 2) {
                                                                                    echo "active";
                                                                                } ?>" href="profile.php"><i
                         class="fas fa-user"></i><span>User Profile</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 4) {
                                                                                    echo "active";
                                                                                } ?>" href="course.php"><i
                         class="fas fa-tachometer-alt"></i><span>Course</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 5) {
                                                                                    echo "active";
                                                                                } ?>" href="student.php"><i
                         class="fas fa-user"></i><span>student</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 6) {
                                                                                    echo "active";
                                                                                } ?>" href="Exams.php"><i
                         class="fas fa-user"></i><span>Exam</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 7) {
                                                                                    echo "active";
                                                                                } ?>" href="announcement.php"><i
                         class="fas fa-table"></i><span>Announcement</span></a></li>
             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 12) {
                                                                                    echo "active";
                                                                                } ?>" href="addAnnouncement.php"><i
                         class="fas fa-user"></i><span>Send announcement</span></a></li>
             <li class="nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 8) {
                                                                                    echo "active";
                                                                                } ?>" href="ExamResult.php"><i
                         class="fas fa-table""></i><span>Exams result</span></a></li>
             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 9) {
                                                                                echo "active";
                                                                            } ?>" href="addQs.php"><i
                                 class="fas fa-table""></i><span>Add questions</span></a></li>
             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 10) {
                                                                                echo "active";
                                                                            } ?>" href="teacher.php"><i
                                         class="fas fa-user"></i><span>Teacher</span></a></li>
             <li class=" nav-item" role="presentation"><a class="nav-link <?php if (isset($page) && $page == 11) {
                                                                                    echo "active";
                                                                                } ?>" href="TakeExam.php"><i
                         class="fas fa-user"></i><span>Take Exam</span></a></li>
             <?php } ?>
         </ul>
         <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle"
                 type="button"></button></div>
     </div>
 </nav>
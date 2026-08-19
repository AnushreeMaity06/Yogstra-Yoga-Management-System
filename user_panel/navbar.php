
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


 

    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" style=" padding: 6px 12px; ">

      <div class="container-fluid">

        <!-- LOGO -->

        <a class="navbar-brand"
          href="#"
          >

          <!-- <i class="fa-solid fa-leaf"
            style="color:#f57847;"></i> -->
            <img src="../assets/image/f4faab5c-a29f-4582-8c93-6be2c62fee75-removebg-preview.png" style="width:110px;height:48px; object-fit:contain;">

          <!-- yogsTra -->

        </a>

        <!-- TOGGLER -->

        <button class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo02">

          <span class="navbar-toggler-icon"></span>

        </button>

        <!-- NAVBAR -->

        <div class="collapse navbar-collapse"
          id="navbarTogglerDemo02">

          <!-- LEFT MENU -->

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item" style="font-size:20px;font-weight:600;">
              <a class="nav-link active" href="#">
                Home
              </a>
            </li>

            <li class="nav-item" style="font-size:20px;font-weight:600;">
              <a class="nav-link" href="#aboutus">
                About
              </a>
            </li>
            <?php
            if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'student') {
               
            ?>

              <!-- LOGIN KORLE SHOW HOBE -->

              <li class="nav-item" style="font-size:20px;font-weight:600;">
                <a class="nav-link" href="class_user.php">
                  Classes
                </a>
              </li>

              <!-- <li class="nav-item" style="font-size:20px;">
        <a class="nav-link" href="booking.php">
            Bookings
        </a>
    </li> -->

            <?php
            }
            ?>

            <!-- <li class="nav-item" style="font-size:20px;">
              <a class="nav-link" href="class_user.php">
                Services
              </a>
            </li> -->

            <li class="nav-item" style="font-size:20px;font-weight:600;">
              <a class="nav-link" href="#pricing">
                Pricing
              </a>
            </li>

            <li class="nav-item" style="font-size:20px;font-weight:600;">
              <a class="nav-link" href="#review">
                Review
              </a>
            </li>

            <li class="nav-item" style="font-size:20px;font-weight:600;">
              <a class="nav-link" href="#team">
                Team
              </a>
            </li>

            <!-- <li class="nav-item" style="font-size:20px;">
              <a class="nav-link" href="#">
                Blog
              </a>
            </li> -->

          </ul>

          <!-- RIGHT SIDE -->

          <?php

        
if (isset($_SESSION['user_id'])) {

          ?>


            <!-- PROFILE DROPDOWN -->

            <div class="dropdown">

              <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                style="gap:8px;"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <!-- PROFILE IMAGE -->

                <img
                  src="../uploads/image/<?php echo $_SESSION['user_image']; ?>"
                  width="45"
                  height="45"
                  style="border-radius:50%;object-fit:cover;">

                <!-- USER NAME -->


              </a>

              <!-- DROPDOWN MENU -->

              <ul class="dropdown-menu dropdown-menu-end">

                <?php

                if ($_SESSION['role'] == 'teacher') {

                ?>

                  <li>

                    <a class="dropdown-item"
                      href="teacher_panel/overview.php">

                      Dashboard

                    </a>

                  </li>

                <?php

                } else {

                ?>

                  <li>

                    <a class="dropdown-item"
                      href="user_panel/overview.php">

                      Dashboard

                    </a>

                  </li>

                <?php
                }
                ?>

                <!-- PROFILE -->

                <?php
                if ($_SESSION['role'] == 'teacher') {
                ?>

                  <li>

                    <a class="dropdown-item"
                      href="teacher_panel/teacher_profile.php">

                      My Profile

                    </a>

                  </li>

                <?php
                } else {
                ?>


                  <li>

                    <!-- <a class="dropdown-item"
                      href="miniprofile.php">

                      My Profile

                    </a> -->

                  </li>


                   <li>

                  <!-- <a class="dropdown-item"
                    href="booking_outside.php">

                    My Booking

                  </a> -->

                </li>

                <?php
                }
                ?>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <!-- LOGOUT -->

                <li>

                  <a class="dropdown-item text-danger"
                    href="logout.php">

                    Logout

                  </a>

                </li>

              </ul>

            </div>

          <?php

          } else {

          ?>

            <!-- SIGNUP -->

            <a href="signup.php"
              style="background:#ba6a4a;
            color:white;
            padding:10px 14px;
            border-radius:8px;
            text-decoration:none;
            margin-right:10px;">

              Signup

            </a>

            <!-- SIGNIN -->

            <a href="login.php"
              style="background:#ba6a4a;
            color:white;
            padding:10px 14px;
            border-radius:8px;
            text-decoration:none;">

              Signin

            </a>

          <?php
          }
          ?>

        </div>

      </div>

    </nav>


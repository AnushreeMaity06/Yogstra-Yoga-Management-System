<?php
include('db_connect.php');
global $conn;

// session_start();

// If not logged in
// if(!isset($_SESSION['user_name'])){
//     header("Location:index.php");
//     exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
     <style>
     .sidebar {
  height: 95vh;
  background: #e9eaee;
  padding: 10px;
  width:220px;
}

.sidebar a {
  display: block;
  color: #000000;
  padding: 10px;
  text-decoration: none;
  border-radius: 6px;
  margin-bottom: 5px;
  font-size:20px;
    /* width:180px; */
}

.sidebar a:hover {
  background: #f57847;
  width:200px;
  color: white;
}

.sidebar a.active {
  background: #f57847;
  color: white;
  font-weight: bold;
}
</style>
</head>
<body>
    <div>
        <div class="col-md-2 sidebar">
            <h5 style="color:#f57847;font-size:30px;"><i class="fa-solid fa-leaf" style="color:#f57847;"></i> yogsTra</h5>
            <a href="miniprofile.php" class="<?= ($active == 'miniprofile') ? 'active' : '' ?>"><i class="fa-solid fa-circle-user"></i> My Profile</a>
            <a href="overview.php" class="<?= ($active == 'overview') ? 'active' : '' ?>"><i class="fa fa-home"></i> Overview</a>
            <a href="user_class.php" class="<?= ($active == 'user_class') ? 'active' : '' ?>"><i class="fa fa-dumbbell"></i> My Classes</a>
            <a href="bookings.php" class="<?= ($active == 'bookings') ? 'active' : '' ?>"><i class="fa fa-calendar"></i> My Bookings</a>
            <!-- <a href="user_list.php" class="<?= ($active == 'user_list') ? 'active' : '' ?>"><i class="fa fa-user-graduate"></i> Students</a> -->
            <!-- <a href="analytics.php" class="<?= ($active == 'analytics') ? 'active' : '' ?>"><i class="fa fa-chart-line"></i> Analytics</a>
            <a href="settings.php" class="<?= ($active == 'settings') ? 'active' : '' ?>"><i class="fa fa-cog"></i> Settings</a> -->
        <hr>
            <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js">
        </script>
</body>
</html>
<?php
session_start();
include('../db_connect.php');
global $conn;



// if(!isset($_SESSION['user_name'])){
//     header("Location:index.php");
//     exit();
// }

$active = 'overview';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yoga Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
       

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: none;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .confirmed { background: #ba6a4a; color: white; }
        .pending { background: #eaeaea; }
    </style>
</head>
<body style="background-color:#ba6a4a;">
<div class="container-fluid">
    <div class="row">
       
        <!-- Sidebar -->
        <div class="col-md-2 " >
      <?php include('sidebar.php'); ?>
  

        </div>
        <div class="col-md-10">
            <!-- <h4>Overview Dashboard</h4> -->
            <h1 style="color:white;">Welcome, <?php echo $_SESSION['user_name']; ?></h1>

            <!-- Top Cards -->

            <?php
// Total Students
$student_query = mysqli_query($conn, "SELECT COUNT(*) AS total_students FROM users where role='student'");
$student_data = mysqli_fetch_assoc($student_query);
$total_students = $student_data['total_students'];
?>
            <div class="row g-3 mt-2">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Total Students</h6>
                         <h3><?php echo $total_students; ?></h3>
                        <small class="text-success">+12%</small>
                    </div>
                </div>
                <?php     
// Total Teachers
$teacher_query= mysqli_query($conn, "SELECT COUNT(*) AS total_teachers FROM users where role='teacher'");
$teacher_data = mysqli_fetch_assoc($teacher_query);
$total_teachers = $teacher_data['total_teachers'];
// Total Revenue
$revenue_query = mysqli_query(
    $conn,
    "SELECT COALESCE(SUM(total_price), 0) AS total_revenue FROM booking"
);

$revenue_data = mysqli_fetch_assoc($revenue_query);
$total_revenue = $revenue_data['total_revenue'];
?>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Total Teachers</h6>
                        <h3><?php echo $total_teachers; ?></h3>
                        <small class="text-success">+5%</small>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Revenue</h6>
                        <h3>$4,280</h3>
                        <small class="text-success">+18%</small>
                    </div>
                </div> -->
                <div class="col-md-3"> 
    <div class="card card-custom p-3"> 
        <h6>Total Revenue</h6> 

        <h3>
            ₹<?php echo number_format($total_revenue, 2); ?>
        </h3> 

        <small class="text-success">
            From Bookings
        </small>
    </div> 
</div>
<?php

$booking_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_bookings FROM booking"
);

$booking_data = mysqli_fetch_assoc($booking_query);
$total_bookings = $booking_data['total_bookings'];
?>
                <div class="col-md-3">
    <div class="card card-custom p-3">
        <h6>Total Bookings</h6>

        <h3>
            <?php echo $total_bookings; ?>
        </h3>

        <small class="text-success">
            Total Class Bookings
        </small>
    </div>
</div>
            </div>

            <!-- Tables -->
             <div class="d-flex justify-content-between align-items-center mt-3">

    <h4 style="color:#fff;">Banner Management</h4>

    <a href="add_banner.php" class="btn btn-dark">
        <i class="fa fa-plus"></i> Add Banner
    </a>

</div>

<div class="card card-custom p-3 mt-4">

    <h4 class="mb-3">All Banners</h4>

    <table class="table table-bordered table-hover bg-white">

        <thead>
            <tr>
               
                <th>Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql = "SELECT * FROM banners ORDER BY id DESC";

        $run = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($run)){

        ?>

            <tr>

                

                <td>
                    <img src="../uploads/bannerimage/<?php echo $row['image']; ?>"
                    width="120" height="60"
                    style="object-fit:cover;border-radius:10px;">
                </td>

                <td><?php echo $row['title']; ?></td>

                <td>

                    <?php

                    if($row['status'] == 1){
                        echo "<span class='badge bg-success'>Enabled</span>";
                    }else{
                        echo "<span class='badge bg-danger'>Disabled</span>";
                    }

                    ?>

                </td>

                <td>

                    <?php

                    if($row['status'] == 1){

                    ?>

                    <a href="disable_banner.php?id=<?php echo $row['id']; ?>"
                    class="btn btn-warning btn-sm" style="border-radius:30px;">
                        Disable
                    </a>

                    <?php } else { ?>

                    <a href="enable_banner.php?id=<?php echo $row['id']; ?>"
                    class="btn btn-success btn-sm"style="border-radius:30px;">
                        Enable
                    </a>

                    <?php } ?>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>
          

        </div>
    </div>
</div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
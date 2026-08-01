<?php
include('db_connect.php');
global $conn;


session_start();
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
        .sidebar {
            height: 100vh;
            background: #e9ebf1;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #000000;
            padding: 10px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 5px;
            font-size: 20px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #f57847;
            color: white;
            font-weight: bold;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .confirmed {
            background: #f57847;
            color: white;
        }

        .pending {
            background: #eaeaea;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 left pt-2" style="background-color:#e9eaee;">
                <!-- Sidebar -->
                <?php
                include 'sidebar.php';
                ?>

            </div>
            <div class="col-md-10" style="background-color:#f57847;">
                <!-- <h4>Overview Dashboard</h4> -->
                <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>

                <!-- Top Cards -->
                <div class="row g-3 mt-2">
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h6>Total Students</h6>
                            <h3>142</h3>
                            <small class="text-success">+12%</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h6>This Week’s Classes</h6>
                            <h3>28</h3>
                            <small class="text-success">+5%</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h6>Revenue</h6>
                            <h3>$4,280</h3>
                            <small class="text-success">+18%</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h6>Rating</h6>
                            <h3>4.8 ⭐</h3>
                        </div>
                    </div>
                </div>

                <!-- Tables -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-custom p-3">
                            <h5>Recent Bookings</h5>
                            <div class="mt-3">
                                <p><strong>Sarah Miller</strong><br>Hatha Yoga
                                    <span class="status confirmed float-end">confirmed</span>
                                </p>
                                <p><strong>John Davis</strong><br>Vinyasa Flow
                                    <span class="status pending float-end">pending</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-custom p-3">
                            <h5>Today’s Classes</h5>
                            <div class="mt-3">
                                <p><strong>Hatha Yoga</strong><br>15/20 enrolled</p>
                                <p><strong>Vinyasa Flow</strong><br>18/25 enrolled</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html> --
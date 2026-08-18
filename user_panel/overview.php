<?php
include('../db_connect.php');
global $conn;

session_start();

$active = 'overview';
$user_id = $_SESSION['user_id'];

$sql = "SELECT COUNT(*) AS total_bookings 
        FROM booking 
        WHERE user_id = $user_id";

$result = $conn->query($sql);
$total_bookings = 0;

if ($result) {
    $row = $result->fetch_assoc();
    $total_bookings = $row['total_bookings'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Yoga Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        } */

        body {
            /* background: #f8f3f1; */
            overflow-x: hidden;
            background:#f57847;
        }

        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding: 20px;
        }



        /* Main */
        .main-content {
            min-height: 100vh;
            padding: 30px;
            /* background: #f8f3f1; */
        }

        /* Welcome Box */
        .welcome-box {
            background: linear-gradient(135deg, #ba6a4a, #9f5b40);
            border-radius: 25px;
            padding: 35px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(186, 106, 74, 0.25);
        }

        .welcome-box::before {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            right: -80px;
            top: -80px;
        }

        .welcome-box h1 {
            font-size: 30px;
            font-weight: 700;
        }

        .welcome-box p {
            margin-top: 10px;
            opacity: 0.9;
        }

        /* Cards */
        .card-custom {
            border: none;
            border-radius: 22px;
            background: #fff;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(186, 106, 74, 0.15);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            background: rgba(186, 106, 74, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ba6a4a;
            font-size: 22px;
            margin-bottom: 15px;
        }

        /* Sections */
        .section-card {
            background: white;
            border-radius: 22px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .section-card h5 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #ba6a4a;
        }

        /* Items */
        .booking-item,
        .class-item {
            display: flex;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .confirmed {
            background: rgba(186, 106, 74, 0.15);
            color: #ba6a4a;
        }

        .pending {
            background: rgba(159, 91, 64, 0.15);
            color: #9f5b40;
        }

        @media(max-width:768px) {
            .main-content {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 ">
                <?php include('sidebar.php'); ?>
            </div>
            <!-- Main -->
            <div class="col-lg-10 main-content">
                <div class="main-card">

                    <!-- Welcome -->
                    <div class="welcome-box mb-4">
                        <h1>Welcome Back, <?php echo $_SESSION['user_name']; ?> 👋</h1>
                        <p>Manage your yoga classes, students, bookings and revenue easily.</p>
                    </div>

                    <div class="row mt-4 g-4">

<div class="col-lg-4 col-md-6">
    <div class="card-custom">
        <div class="icon-box">
            <i class="fa-solid fa-calendar-check"></i>
        </div>

        <h6>Total Booked Classes</h6>

        <h2><?php echo $total_bookings; ?></h2>

        <p class="text-muted mb-0">
            Classes you have booked
        </p>
    </div>
</div>
                        <!-- Recent Bookings
                <div class="col-lg-6">
                    <div class="section-card">
                        <h5><i class="fa fa-bookmark"></i> Recent Bookings</h5>

                        <div class="booking-item">
                            <div>
                                <strong>Sarah Miller</strong><br>
                                <small>Hatha Yoga</small>
                            </div>
                            <span class="status confirmed">Confirmed</span>
                        </div>

                        <div class="booking-item">
                            <div>
                                <strong>John Davis</strong><br>
                                <small>Vinyasa Flow</small>
                            </div>
                            <span class="status pending">Pending</span>
                        </div>

                    </div>
                </div> -->

                        <!-- Today's Classes -->
                        <!-- <div class="col-lg-6">
                    <div class="section-card">
                        <h5><i class="fa fa-spa"></i> Today's Classes</h5>

                        <div class="class-item">
                            <div>
                                <strong>Hatha Yoga</strong><br>
                                <small>Morning Session</small>
                            </div>
                            <span>15/20</span>
                        </div>

                        <div class="class-item">
                            <div>
                                <strong>Vinyasa Flow</strong><br>
                                <small>Evening Session</small>
                            </div>
                            <span>18/25</span>
                        </div>

                    </div>
                </div> -->

                    </div>

                </div>
</div>

            </div>
        </div>

</body>

</html>
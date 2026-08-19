<?php
include('../db_connect.php');
global $conn;

session_start();

// if(!isset($_SESSION['user_name'])){
//     header("Location:index.php");
//     exit();
// }

$active = 'overview';


// Logged-in teacher ID
$teacher_id = $_SESSION['user_id'] ?? 0;


// =========================
// Total Classes of Teacher
// =========================
$class_sql = "SELECT COUNT(*) AS total_classes
              FROM classes
              WHERE teacher_id = '$teacher_id'";

$class_result = $conn->query($class_sql);
$class_data = $class_result->fetch_assoc();

$total_classes = $class_data['total_classes'] ?? 0;


// =========================
// Total Seats Booked
// for Teacher's Assigned Classes
// =========================

$booking_sql = "SELECT COALESCE(SUM(b.seats), 0) AS total_seats_booked
                FROM booking b
                INNER JOIN classes c 
                    ON b.class_id = c.id
                WHERE c.teacher_id = '$teacher_id'";

$booking_result = $conn->query($booking_sql);
$booking_data = $booking_result->fetch_assoc();

$total_seats_booked = $booking_data['total_seats_booked'] ?? 0;
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

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family: 'Poppins', sans-serif; */
        }

        body {
           
            overflow-x: hidden; 
        }

        /* Sidebar */
        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding: 20px;
        }


        /* Main Content */
        .main-content {
            min-height: 100vh;
            padding: 30px;
            /* background:
                linear-gradient(rgba(255, 255, 255, 0.95),
                    rgba(255, 255, 255, 0.95)),
                url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1400&auto=format&fit=crop'); */
            background-size: cover;
            background-position: center;
        }

        /* Welcome Box */
        .welcome-box {
            background: #ba6a4a;
            border-radius: 25px;
            padding: 35px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(245, 120, 71, 0.3);
        }

        .welcome-box::before {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            right: -80px;
            top: -80px;
        }

        .welcome-box h1 {
            font-size: 32px;
            font-weight: 700;
        }

        .welcome-box p {
            margin-top: 10px;
            font-size: 15px;
            opacity: 0.9;
        }

        /* Dashboard Cards */
        .card-custom {
            border: none;
            border-radius: 22px;
            background: #fff;
            padding: 25px;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            background: rgba(245, 120, 71, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ba6a4a;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .card-custom h6 {
            color: #777;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .card-custom h3 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .growth {
            color: #1db954;
            font-size: 14px;
            font-weight: 600;
        }

        /* Sections */
        .section-card {
            background: white;
            border-radius: 22px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .section-card h5 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        /* Booking Item */
        .booking-item,
        .class-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .booking-item:last-child,
        .class-item:last-child {
            border-bottom: none;
        }

        .booking-item strong,
        .class-item strong {
            font-size: 15px;
        }

        .booking-item small,
        .class-item small {
            color: gray;
        }

        /* Status */
        .status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .confirmed {
            background: rgba(29, 185, 84, 0.15);
            color: #1db954;
        }

        .pending {
            background: rgba(255, 193, 7, 0.15);
            color: #e6a700;
        }

        /* Responsive */
        @media(max-width:768px) {
            .main-content {
                padding: 20px;
            }

            .welcome-box h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body style="background-color:#ba6a4a;">

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 ">
                <?php include('sidebar.php'); ?>
            </div>
            <!-- Main Content -->
            <div class="col-lg-10 main-content">
                <div class="main-card">
                    <!-- Welcome -->
                    <div class="welcome-box mb-4">
                        <h1>
                            Welcome Back,
                            <?php echo $_SESSION['user_name']; ?> 👋
                        </h1>

                        <p>
                            Manage your yoga classes, students, bookings and revenue easily.
                        </p>

                    </div>

<!-- Dashboard Statistics -->
<div class="row g-4 mb-4">

    <!-- Total Classes -->
    <div class="col-md-6">
        <div class="card-custom">

            <div class="icon-box">
                <i class="fa-solid fa-person-chalkboard"></i>
            </div>

            <h6>My Classes</h6>

            <h3>
                <?php echo $total_classes; ?>
            </h3>

            <span class="text-muted">
                Classes assigned to you
            </span>

        </div>
    </div>


    <!-- Total Bookings
    <div class="col-md-6">
        <div class="card-custom">

            <div class="icon-box">
                <i class="fa-solid fa-calendar-check"></i>
            </div>

            <h6>Total Bookings</h6>

            <h3>
                <?php echo $total_seats_booked; ?>
            </h3>

            <span class="text-muted">
                Bookings for your classes
            </span>

        </div>
    </div> -->

</div>

    </div>
                </div>

            </div>
        </div>

        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
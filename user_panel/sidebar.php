<?php
include('../db_connect.php');
global $conn;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sidebar</title>

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar {
            background: #e9eaee;
            padding: 10px;
            width: 220px;
            height: 100vh;
            border-radius: 0 20px 20px 0;

            position: fixed;
            top: 0;
            left: 0;
        }

        /* LOGO */
        .sidebar h5 {
            margin-bottom: 25px;
        }

        /* MENU LINKS */
        .sidebar a {
            display: block;
            color: #000;
            padding: 10px 12px;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 8px;
            font-size: 20px;
            transition: 0.3s;
        }

        /* HOVER EFFECT (ADMIN STYLE) */
        .sidebar a:hover {
            background: #ba6a4a;
            color: #fff;
            transform: translateX(5px);
            font-weight: 600;
        }

        /* ACTIVE LINK */
        .sidebar a.active {
            background: #ba6a4a;
            color: #fff;

        }

        /* ICON ALIGNMENT */
        .sidebar a i {
            margin-right: 8px;
        }

        /* MOBILE */
        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                border-radius: 0;
                padding: 15px;
            }

            .sidebar a {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <h5>
            <img src="../assets/image/f4faab5c-a29f-4582-8c93-6be2c62fee75-removebg-preview.png"
                style="width:150px;height:48px;object-fit:contain;">
        </h5>

        <a href="miniprofile.php" class="<?= ($active == 'miniprofile') ? 'active' : '' ?>">
            <i class="fa-solid fa-circle-user"></i> My Profile
        </a>

        <a href="overview.php" class="<?= ($active == 'overview') ? 'active' : '' ?>">
            <i class="fa fa-home"></i> Overview
        </a>

        <a href="class_user.php" class="<?= ($active == 'classes_user') ? 'active' : '' ?>">
            <i class="fa fa-dumbbell"></i> Classes
        </a>

        <a href="videos.php" class="<?= ($active == 'video_classes') ? 'active' : '' ?>">
            <i class="fa-solid fa-circle-play"></i> Video Classes
        </a>

        <a href="myclasses_user.php" class="<?= ($active == 'myclasses_user') ? 'active' : '' ?>">
            <i class="fa fa-dumbbell"></i> My Classes
        </a>

        <a href="mybooking_user.php" class="<?= ($active == 'mybooking_user') ? 'active' : '' ?>">
            <i class="fa fa-calendar"></i> My Bookings
        </a>

        <hr>

        <a href="../logout.php">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>

    </div>

</body>

</html>
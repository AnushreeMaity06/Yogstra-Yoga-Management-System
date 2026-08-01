<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">


    <!-- Font Awesome -->
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

        /* Menu */
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

        /* Hover */
        .sidebar a:hover {
            background: #ba6a4a;
            color: white;
            transform: translateX(5px);
            font-weight: 600;
        }

        /* Active */
        .sidebar a.active {
            background: #ba6a4a;
            color: white;
            font-weight: bold;
        }

        /* Logo */
        .sidebar h5 {
            color: #ba6a4a;
            font-size: 30px;
            margin-bottom: 25px;
        }

        @media(max-width:768px) {

            .sidebar {
                width: 100%;
                height: auto;
                border-radius: 0;
                padding: 15px;
            }

            .sidebar a {
                font-size: 16px;
                padding: 9px 10px;
            }
        }
    </style>
</head>

<div class="sidebar">

    <h5>
        <!-- <i class="fa-solid fa-leaf"></i> yogsTra -->
                     <img src="../assets/image/f4faab5c-a29f-4582-8c93-6be2c62fee75-removebg-preview.png" style="width:150px;height:48px; object-fit:contain;">

    </h5>

    <a href="overview.php" class="<?= ($active == 'overview') ? 'active' : '' ?>">
        <i class="fa fa-home"></i> Overview
    </a>

    <a href="classes.php" class="<?= ($active == 'classes') ? 'active' : '' ?>">
        <i class="fa fa-dumbbell"></i> Classes
    </a>

    <a href="membership.php" class="<?= ($active == 'membership') ? 'active' : '' ?>">
        <i class="fa fa-crown"></i> Membership
    </a>

    <a href="videos.php" class="<?= ($active == 'videos') ? 'active' : '' ?>">
        <i class="fa-solid fa-circle-play"></i> Video Classes
    </a>


    <a href="bookings.php" class="<?= ($active == 'bookings') ? 'active' : '' ?>">
        <i class="fa fa-calendar"></i> Bookings
    </a>

    <a href="user_list.php" class="<?= ($active == 'user_list') ? 'active' : '' ?>">
        <i class="fa fa-user-graduate"></i> Students
    </a>

    <a href="teacher_list.php" class="<?= ($active == 'teacher_list') ? 'active' : '' ?>">
        <i class="fa fa-users"></i> Teachers
    </a>

    <!-- <a href="settings.php" class="<?= ($active == 'settings') ? 'active' : '' ?>">
        <i class="fa fa-cog"></i> Settings
    </a> -->

     <a href="blogs.php" class="<?= ($active == 'blogs') ? 'active' : '' ?>">
        <i class="fa fa-newspaper"></i> Blogs
    </a>

    <hr>

    <a href="index.php">
        <i class="fa fa-sign-out-alt"></i> Logout
    </a>

</div>

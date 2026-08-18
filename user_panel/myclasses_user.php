<?php
global $conn;
session_start();

$active = 'myclasses_user';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

include('../db_connect.php');

$user_id = $_SESSION['user_id'];

$sql = "SELECT booking.*, classes.name, classes.instructor
        FROM booking
        JOIN classes ON booking.class_id = classes.id
        WHERE booking.user_id = $user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Classes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* background: #ba6a4a; */
            overflow-x: hidden;
        }

        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding: 20px;
            margin-top: 20px;
            min-height: calc(100vh - 40px);
        }

        .classes-section {
            padding: 50px 15px;
        }

        .section-title {

            font-size: 30px;
            font-weight: bold;
            color: #ba6a4a;
        }


        .section-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: #2c2c2c;
        }

        .section-title p {
            color: #555;
            font-size: 16px;
        }

        .class-card {
            background: #fff;
            border-radius: 25px;
            padding: 20px;
            transition: .3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            width: 100%;
        }

        .class-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 18px;
            background: linear-gradient(45deg, #ba6a4a, #9f5b40);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            margin-bottom: 15px;
            animation: floatUpDown 3s infinite ease-in-out;
        }

        @keyframes floatUpDown {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .class-title {
            font-size: 24px;
            font-family: Georgia, serif;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .class-info {
            font-size: 14px;
            line-height: 1.6;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
        }

        .booked {
            background: #28a745;
        }

        .pending {
            background: #ffc107;
            color: black;
        }

        .btn-custom {
            border-radius: 30px;
            padding: 8px 20px;
            font-size: 14px;
        }

        .action-btn {
            margin-top: 15px;
        }


        @media(max-width:992px) {
            .class-title {
                font-size: 26px;
            }
        }

        @media(max-width:768px) {

            .main-card {
                border-radius: 20px;
            }

            .section-title h1 {
                font-size: 32px;
            }

            .class-title {
                font-size: 24px;
            }
        }

        @media(max-width:576px) {

            .classes-section {
                padding: 30px 10px;
            }

            .section-title h1 {
                font-size: 28px;
            }

            .section-title p {
                font-size: 14px;
            }

            .class-card {
                padding: 20px;
            }

            .action-btn .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .action-btn .btn-danger {
                margin-left: 0 !important;
            }
        }
    </style>

</head>

<body style="background-color:#ba6a4a;">

    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2">
                <?php include('sidebar.php'); ?>
            </div>

            <!-- Main -->
            <div class="col-md-10">

                <div class="main-card">

                    <section class="classes-section">

                        <div class="section-title">
                            <h2> <i class="fa fa-dumbbell"></i>My Classes</h2>
                            <p>
                                Manage your booked yoga sessions and continue your wellness journey.
                            </p>
                        </div>

                        <div class="container-fluid">

                            <div class="row g-4">

                                <?php if ($result && $result->num_rows > 0) { ?>

                                    <?php while ($row = $result->fetch_assoc()) { ?>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">

                                            <div class="class-card">

                                                <div class="icon-box">
                                                    <i class="fa-solid fa-leaf"></i>
                                                </div>

                                                <h2 class="class-title">
                                                    <?php echo $row['name']; ?>
                                                </h2>

                                                <div class="class-info">

                                                    <p>
                                                        👨‍🏫 Instructor:
                                                        <b><?php echo $row['instructor']; ?></b>
                                                    </p>

                                                    <p class="mt-3">
                                                        Status:

                                                        <?php
                                                        if ($row['status'] == 'Booked') {
                                                        ?>

                                                            <span class="status-badge booked">
                                                                Booked
                                                            </span>

                                                        <?php
                                                        } elseif ($row['status'] == 'Cancelled') {
                                                        ?>

                                                            <span class="status-badge bg-danger">
                                                                Cancelled
                                                            </span>

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <span class="status-badge pending">
                                                                Pending
                                                            </span>

                                                        <?php
                                                        }
                                                        ?>

                                                    </p>

                                                </div>

                                                <div class="action-btn">

                                                    <?php if ($row['status'] == 'Booked') { ?>

                                                        <a href="#"
                                                            class="btn btn-success btn-custom">
                                                            Join Class
                                                        </a>

                                                    <?php } else { ?>

                                                        <button
                                                            class="btn btn-secondary btn-custom"
                                                            disabled>
                                                            Not Available
                                                        </button>

                                                    <?php } ?>

                                                    <a href="cancel.php?id=<?php echo $row['id']; ?>"
                                                        class="btn btn-danger btn-custom ms-2"
                                                        onclick="return confirm('Are you sure to cancel this class?')">

                                                        Cancel

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    <?php } ?>

                                <?php } else { ?>

                                    <div class="col-12">

                                        <div class="alert alert-info text-center" style="background-color:#ba6a4a;font-size:20px;font-weight:bold;color:#fff;">

                                            No classes booked yet 🧘

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
<?php
global $conn;
session_start();
$active = 'classes_user';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
    
}

include('../db_connect.php');

$result = $conn->query("SELECT * FROM classes WHERE status='Active'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Classes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* body{
    background:#f8f3f1;
    font-family:Arial, sans-serif;
    overflow-x:hidden;
} */

        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding:  20px;
            margin-top:20px;
        }


        /* SECTION */
        .classes-section {
            padding: 50px 15px;
        }

        /* TITLE */
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 8px;
            /* color:#ba6a4a; */
        }

        .section-title p {
            font-size: 16px;
            max-width: 700px;
            margin: auto;
            color: #555;
        }

        /* CARD */
        .class-card {
            background: #fff;
            border-radius: 22px;
            padding: 20px;
            transition: 0.3s;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        /* ICON */
        /* .icon-box{
    width:58px;
    height:58px;
    border:2px solid #ba6a4a;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
    background:#fff;
}

.icon-box i{
    font-size:24px;
    color:#ba6a4a;
} */
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #ba6a4a, #9f5b40);
            color: #fff;
            font-size: 24px;
            margin-bottom: 15px;

            /* floating animation */
            animation: floatUpDown 3s ease-in-out infinite;
        }

        /* smooth floating up-down */
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

        /* TITLE */
        .class-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
            font-family: Georgia, serif;
            color: #ba6a4a ;
        }

        /* INFO */
        .class-info {
            font-size: 15px;
            line-height: 1.7;
            color: #333;
        }

        /* BADGE */
        .level-badge {
            background: #ba6a4a;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* BUTTON */
        .book-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 18px;
            text-decoration: none;
            color: #ba6a4a;
            font-size: 20px;
            font-weight: 700;
            transition: 0.3s;
        }

        .book-btn:hover {
            color: #9f5b40;
        }

        /* TABLET */
        @media(max-width:992px) {
            .class-title {
                font-size: 24px;
            }

            .class-info {
                font-size: 14px;
            }
        }

        /* MOBILE */
        @media(max-width:576px) {

            .classes-section {
                padding: 35px 12px;
            }

            .section-title h1 {
                font-size: 30px;
            }

            .section-title p {
                font-size: 14px;
            }

            .class-card {
                padding: 18px;
            }

            .class-title {
                font-size: 22px;
            }

            .class-info {
                font-size: 13px;
            }

            .book-btn {
                font-size: 17px;
            }

            .icon-box {
                width: 52px;
                height: 52px;
            }

            .icon-box i {
                font-size: 20px;
            }
        }
    </style>

</head>

<body style="background-color:   #ba6a4a;">

    <div class="container-fluid ">

        <div class="row">


            <!-- Sidebar -->
            <div class="col-md-2 ">
                <?php include('sidebar.php'); ?>
            </div>


            <div class="col-md-10 ">
                <div class="main-card">

                    <section class="classes-section">

                        <div class="section-title">
                            <h1 style="margin:auto;text-align:center;font-family: 'Playfair Display', serif;font-size: 38px;font-weight: 600;color: #2c2c2c;line-height: 1.2;">Curated Practices</h1>
                            <p style="margin:auto;text-align:center;font-family: 'Poppins', sans-serif;">
                                Explore our signature yoga styles designed to meet you exactly
                                where you are on your path.
                            </p>
                        </div>

                        <div class="container-fluid">
                            <div class="row g-4">

                                <?php while ($row = $result->fetch_assoc()) { ?>

                                    <div class="col-12 col-md-3">

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

                                                <p class="mt-3 mb-1">
                                                    Level:
                                                    <span class="level-badge">
                                                        <?php echo $row['level']; ?>
                                                    </span>
                                                </p>

                                            </div>

                                            <a href="book.php?class_id=<?php echo $row['id']; ?>"
                                                class="book-btn">
                                                Book Now →
                                            </a>

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>
                        </div>



                    </section>
                </div>
</div>

</body>

</html>
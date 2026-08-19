<?php
global $conn;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../db_connect.php');


// =====================================================
// LOGIN CHECK
// =====================================================

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}


// =====================================================
// GET CLASS ID
// =====================================================

if (!isset($_GET['class_id']) || empty($_GET['class_id'])) {
    header("Location: ../index.php");
    exit;
}

$class_id = intval($_GET['class_id']);


// =====================================================
// GET CLASS DETAILS
// =====================================================

$sql = "SELECT * FROM classes WHERE id = '$class_id' LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Class not found.");
}

$row = mysqli_fetch_assoc($result);


// =====================================================
// BOOKING
// =====================================================

if (isset($_POST['book_btn'])) {

    $user_id = intval($_SESSION['user_id']);

    // Seats only comes from user
    $seats = intval($_POST['seats']);

    // Safety check
    if ($seats < 1) {
        $msg = "Please select at least 1 seat.";
    } else {

        // =================================================
        // CLASS DATE & TIME
        // Automatically taken from classes table
        // =================================================

        $date = $row['schedule_date'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];

        /*
         * Booking table has only one 'time' column,
         * so we store:
         *
         * 10:00 AM - 11:00 AM
         *
         * If your time column is TIME type, use start_time only.
         */

        $time = $start_time;


        // =================================================
        // PRICE CALCULATION
        // =================================================

        $price_per_seat = floatval($row['price']);

        $total_price = $price_per_seat * $seats;


        // =================================================
        // CHECK DUPLICATE BOOKING
        // =================================================

        $check = "SELECT * FROM booking
                  WHERE user_id = '$user_id'
                  AND class_id = '$class_id'";

        $check_result = mysqli_query($conn, $check);


        if ($check_result && mysqli_num_rows($check_result) > 0) {

            $msg = "You already booked this class.";

        } else {

            // =================================================
            // INSERT BOOKING
            // =================================================

            $sql = "INSERT INTO booking
                    (user_id, class_id, date, time, seats, total_price)
                    VALUES
                    ('$user_id',
                     '$class_id',
                     '$date',
                     '$time',
                     '$seats',
                     '$total_price')";

            $insert_result = mysqli_query($conn, $sql);


            if ($insert_result) {

                $msg = "Booking Successful";

            } else {

                $msg = "Booking failed: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Book Yoga Class</title>


    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            font-family: 'Poppins', sans-serif;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 15px;

            background:
                linear-gradient(
                    rgba(0, 0, 0, 0.65),
                    rgba(0, 0, 0, 0.65)
                ),
                url('../assets/image/yoga1.jpg');

            background-size: cover;

            background-position: center;
        }


        .main-wrapper {

            width: 100%;

            max-width: 900px;
        }


        /* IMAGE */

        .image-box {

            overflow: hidden;

            border-radius: 20px;

            height: 100%;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.35);
        }


        .image-box img {

            width: 100%;

            height: 100%;

            min-height: 420px;

            object-fit: cover;

            transition: 0.5s ease;
        }


        .image-box:hover img {

            transform: scale(1.05);
        }


        /* CARD */

        .card-box {

            background:
                rgba(255, 255, 255, 0.12);

            backdrop-filter: blur(10px);

            border:
                1px solid rgba(255, 255, 255, 0.2);

            padding: 26px;

            border-radius: 22px;

            box-shadow:
                0 8px 28px rgba(0, 0, 0, 0.3);
        }


        /* TITLE */

        .title {

            font-size: 28px;

            font-weight: 700;

            text-align: center;

            color: white;

            margin-bottom: 5px;
        }


        .title i {

            color: #ff914d;
        }


        /* SMALL TEXT */

        .small-text {

            text-align: center;

            color: #f1f1f1;

            font-size: 13px;

            margin-bottom: 20px;
        }


        /* CLASS INFO */

        .class-info {

            background:
                rgba(255, 255, 255, 0.12);

            padding: 14px;

            border-radius: 14px;

            margin-bottom: 18px;

            color: white;
        }


        .class-info h4 {

            font-weight: 700;

            color: #ffb37b;
        }


        /* LABEL */

        .form-label {

            color: white;

            font-size: 14px;

            font-weight: 500;

            margin-bottom: 6px;
        }


        /* INPUT */

        .custom-input {

            width: 100%;

            height: 44px;

            border: none;

            outline: none;

            border-radius: 12px;

            background:
                rgba(255, 255, 255, 0.95);

            padding: 10px 12px;

            font-size: 14px;

            transition: 0.3s ease;
        }


        .custom-input:focus {

            transform: scale(1.01);

            box-shadow:
                0 0 8px rgba(255, 145, 77, 0.6);
        }


        /* SCHEDULE BOX */

        .schedule-box {

            width: 100%;

            min-height: 44px;

            border: none;

            border-radius: 12px;

            background:
                rgba(255, 255, 255, 0.95);

            padding: 10px 12px;

            font-size: 14px;

            color: #333;

            display: flex;

            align-items: center;

            gap: 8px;

            flex-wrap: wrap;
        }


        /* BUTTON */

        .btn-submit {

            width: 100%;

            border: none;

            background:
                linear-gradient(
                    45deg,
                    #ff7b54,
                    #ff416c
                );

            color: white;

            padding: 12px;

            border-radius: 12px;

            font-size: 15px;

            font-weight: 600;

            margin-top: 10px;

            transition: 0.4s ease;
        }


        .btn-submit:hover {

            transform: translateY(-2px);

            box-shadow:
                0 6px 18px rgba(255, 65, 108, 0.5);
        }


        /* RESPONSIVE */

        @media(max-width:768px) {

            .image-box {

                margin-bottom: 20px;
            }


            .image-box img {

                min-height: 250px;
            }


            .card-box {

                padding: 18px;
            }


            .title {

                font-size: 22px;
            }
        }

    </style>

</head>


<body>


<div class="container main-wrapper">

    <div class="row align-items-center g-4">


        <!-- =====================================================
             IMAGE
        ====================================================== -->

        <div class="col-lg-5">

            <div class="image-box">

                <img src="../assets/image/yoga1.jpg"
                    alt="Yoga Image">

            </div>

        </div>



        <!-- =====================================================
             FORM
        ====================================================== -->

        <div class="col-lg-7">

            <div class="card-box">


                <!-- TITLE -->

                <div class="title">

                    <h2 style="font-size:20px;">
                        🗓️ Book Yoga Class
                    </h2>

                </div>



                <!-- =================================================
                     MESSAGE
                ================================================== -->

                <?php if (isset($msg)) { ?>

                    <div class="alert alert-info">

                        <?php echo htmlspecialchars($msg); ?>

                    </div>

                <?php } ?>



                <!-- =================================================
                     CLASS INFO
                ================================================== -->

                <div class="class-info">


                    <p>
                        🧘 Class:
                        <?php
                        echo htmlspecialchars(
                            $row['class_name'] ??
                            $row['name'] ??
                            'Yoga Class'
                        );
                        ?>
                    </p>


                    <p>
                        👨‍🏫 Instructor:
                        <?php
                        echo htmlspecialchars($row['instructor']);
                        ?>
                    </p>


                    <p>
                        🧘 Level:
                        <?php
                        echo htmlspecialchars($row['level']);
                        ?>
                    </p>


                    <p>
                        ⏳ Duration:
                        <?php
                        echo htmlspecialchars($row['duration']);
                        ?>
                    </p>


                    <p>
                        💰 Price:
                        ₹<?php
                        echo htmlspecialchars($row['price']);
                        ?>
                    </p>


                    <p>
                        🧾 Total Price:
                        ₹<span id="totalPrice">
                            <?php echo htmlspecialchars($row['price']); ?>
                        </span>
                    </p>


                </div>



                <!-- =================================================
                     BOOKING FORM
                ================================================== -->

                <form method="POST">


                    <!-- =================================================
                         CLASS SCHEDULE
                    ================================================== -->

                    <div class="mb-3">

                        <label class="form-label">

                            Class Schedule

                        </label>


                        <div class="schedule-box">

                            📅

                            <?php
                            echo date(
                                'd M Y',
                                strtotime($row['schedule_date'])
                            );
                            ?>


                            <span>|</span>


                            ⏰

                            <?php
                            echo date(
                                'h:i A',
                                strtotime($row['start_time'])
                            );
                            ?>

                            -

                            <?php
                            echo date(
                                'h:i A',
                                strtotime($row['end_time'])
                            );
                            ?>

                        </div>

                    </div>



                    <!-- =================================================
                         SEATS
                    ================================================== -->

                    <div class="mb-3">

                        <label class="form-label">

                            Seats

                        </label>


                        <input type="number"
                            name="seats"
                            id="seats"
                            class="custom-input"
                            value="1"
                            min="1"
                            required>

                    </div>



                    <!-- =================================================
                         CONFIRM BUTTON
                    ================================================== -->

                    <button type="submit"
                        name="book_btn"
                        class="btn-submit">

                        Confirm Booking

                    </button>


                </form>


            </div>

        </div>


    </div>

</div>



<!-- =========================================================
     TOTAL PRICE SCRIPT
========================================================= -->

<script>

    let pricePerSeat =
        <?php echo floatval($row['price']); ?>;


    document
        .getElementById("seats")
        .addEventListener("input", function () {


            let seats =
                parseInt(this.value) || 1;


            let totalPrice =
                seats * pricePerSeat;


            document
                .getElementById("totalPrice")
                .innerText = totalPrice;

        });

</script>


</body>

</html>
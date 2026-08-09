<?php



global $conn;

session_start();

include 'db_connect.php';


/* =========================================
   CHECK CLASS ID
========================================= */

if (!isset($_GET['id'])) {

    die("Class ID not found");

}

$id = (int) $_GET['id'];


/* =========================================
   GET CLASS DETAILS
========================================= */

$query = "SELECT * FROM classes WHERE id = '$id'";

$result = mysqli_query($conn, $query);

if (!$result) {

    die("Database Error : " . mysqli_error($conn));

}

$row = mysqli_fetch_assoc($result);

if (!$row) {

    die("Class not found");

}


/* =========================================
   SUBMIT CLASS FEEDBACK
========================================= */

$feedback_error = "";

if (isset($_POST['submit_class_feedback'])) {


    /* CHECK USER LOGIN */

    if (!isset($_SESSION['user_id'])) {

        $feedback_error = "Please login first to submit feedback.";

    } else {


        $user_id = (int) $_SESSION['user_id'];

        $message = trim($_POST['message'] ?? '');


        /* CHECK MESSAGE */

        if ($message == "") {

            $feedback_error = "Please enter your feedback.";

        } else {


            /* GET USER DETAILS */

            $user_query = "
                SELECT name, email, image
                FROM users
                WHERE id = '$user_id'
                LIMIT 1
            ";

            $user_result = mysqli_query($conn, $user_query);


            if (!$user_result) {

                $feedback_error =
                    "User data error: " . mysqli_error($conn);

            } else {


                $user = mysqli_fetch_assoc($user_result);


                if (!$user) {

                    $feedback_error = "User not found.";

                } else {


                    $name = mysqli_real_escape_string(
                        $conn,
                        $user['name']
                    );

                    $email = mysqli_real_escape_string(
                        $conn,
                        $user['email']
                    );

                    $image = mysqli_real_escape_string(
                        $conn,
                        $user['image'] ?? ''
                    );

                    $message = mysqli_real_escape_string(
                        $conn,
                        $message
                    );


                    /* MEMBER SINCE */

                    $member_since = date('Y');


                    /* INSERT FEEDBACK */

                    $insert_query = "
                        INSERT INTO feedback
                        (
                            name,
                            email,
                            image,
                            message,
                            member_since,
                            user_id,
                            class_id
                        )
                        VALUES
                        (
                            '$name',
                            '$email',
                            '$image',
                            '$message',
                            '$member_since',
                            '$user_id',
                            '$id'
                        )
                    ";


                    if (mysqli_query($conn, $insert_query)) {


                        /* REDIRECT */

                        header(
                            "Location: viewclassdetails.php?id=$id&feedback=success"
                        );

                        exit;


                    } else {

                        $feedback_error =
                            "Feedback submit failed: "
                            . mysqli_error($conn);

                    }

                }

            }

        }

    }

}


/* =========================================
   GET PREVIOUS FEEDBACK FOR THIS CLASS
========================================= */

$feedback_query = "
    SELECT
        id,
        name,
        email,
        image,
        message,
        member_since,
        created_at,
        user_id,
        class_id
    FROM feedback
    WHERE class_id = '$id'
    ORDER BY created_at DESC
";


$feedback_result = mysqli_query(
    $conn,
    $feedback_query
);


if (!$feedback_result) {

    die(
        "Feedback Query Error : "
        . mysqli_error($conn)
    );

}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Class Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>
        body {
            background: #ba6a4a;
        }


        /* BACK BUTTON */

        .back-btn {

            display: inline-flex;
            align-items: center;
            gap: 10px;

            background: rgba(255, 255, 255, .15);

            color: white;

            text-decoration: none;

            padding: 14px 24px;

            border-radius: 50px;

            font-weight: 600;

            backdrop-filter: blur(12px);

            transition: .4s;

        }


        .back-btn:hover {

            background: white;

            color: #ba6a4a;

            transform: translateX(-5px);

        }



        /* CARD */


        .details-card {

            background: white;

            border-radius: 35px;

            overflow: hidden;

            box-shadow: 0 25px 60px rgba(0, 0, 0, .18);

        }



        /* HEADER */


        .header-section {

            background: linear-gradient(135deg, #f8eee7, #f3dfd2);

            color: #8f5037;

            padding: 35px;

            text-align: center;

        }



        .header-icon {

            width: 70px;

            height: 70px;

            margin: auto;

            border-radius: 50%;

            background: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 35px;

            color: #ba6a4a;

        }



        .class-name {

            font-size: 32px;

            font-weight: 700;

            margin-top: 20px;

        }



        /* LEFT */


        .left-panel {

            background: #fff9f6;

            padding: 35px;

            height: 100%;

        }


        .info-item {

            background: white;

            border-radius: 20px;

            padding: 20px;

            margin-bottom: 18px;

            box-shadow: 0 5px 20px rgba(0, 0, 0, .06);

        }


        .info-title {

            color: #ba6a4a;

            font-size: 13px;

            font-weight: 600;

            text-transform: uppercase;

        }


        .info-value {

            font-size: 22px;

            font-weight: 700;

        }


        /* RIGHT */


        .right-panel {

            padding: 35px;

        }


        .section-title {

            color: #ba6a4a;

            font-weight: 700;

            margin-bottom: 20px;

        }


        .benefit-box {

            background: #faf7f4;

            border-left: 5px solid #ba6a4a;

            padding: 15px 20px;

            border-radius: 18px;

            margin-bottom: 15px;

        }

        .feedback-section {
            max-width: 1000px;
            margin: 50px auto;
        }

        .feedback-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .feedback-header h2,
        .feedback-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 600;
            color: #2c2c2c;
        }

        .feedback-header p,
        .feedback-subtitle {
            font-family: 'Poppins', sans-serif;
            color: #666;
            font-size: 15px;
        }

        .feedback-form-card {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 35px;
        }

        .feedback-form-card label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #444;
        }

        .feedback-form-card textarea {
            border-radius: 10px;
            border: 1px solid #ddd;
            resize: none;
        }

        .feedback-form-card textarea:focus {
            border-color: #ba6a4a;
            box-shadow: 0 0 0 0.15rem rgba(186, 106, 74, 0.15);
        }

        .feedback-submit-btn {
            background: #ba6a4a;
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
        }

        .feedback-submit-btn:hover {
            background: #a85d41;
        }

        /* .feedback-card {
            background: #fff;
            padding: 22px;
            margin-bottom: 18px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        } */

    .feedback-section {
    max-width: 1000px;
    margin: 50px auto;
}

.feedback-header {
    text-align: center;
    margin-bottom: 25px;
}

.feedback-header h2,
.feedback-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
}

.feedback-header p,
.feedback-subtitle {
    font-family: 'Poppins', sans-serif;
    color: #666;
    font-size: 15px;
}

.feedback-card {
    background: #fff;
    padding: 25px;
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
    height: fit-content;
}

.feedback-form-card {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
}

.feedback-form-card label {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: #444;
}

.feedback-form-card textarea {
    border-radius: 10px;
    border: 1px solid #ddd;
    resize: none;
}

.feedback-form-card textarea:focus {
    border-color: #ba6a4a;
    box-shadow: 0 0 0 0.15rem rgba(186, 106, 74, 0.15);
}

.feedback-submit-btn {
    background: #ba6a4a;
    color: white;
    border: none;
    padding: 11px 22px;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    cursor: pointer;
}

.feedback-submit-btn:hover {
    background: #a85d41;
}

.previous-feedback {
    margin-top: 25px;
}

.previous-feedback h3 {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 600;
    color: #2c2c2c;
    margin-bottom: 5px;
}

.single-feedback {
    background: #faf7f4;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 15px;
}

.feedback-user {
    display: flex;
    align-items: center;
    gap: 15px;
}

.feedback-user img,
.feedback-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.feedback-user img {
    object-fit: cover;
}

.feedback-avatar {
    background: #ba6a4a;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.feedback-user h5 {
    margin: 0;
    font-weight: 600;
    color: #2c2c2c;
}

.feedback-user small {
    color: #888;
}

.feedback-message {
    margin-top: 15px;
    margin-bottom: 0;
    color: #555;
    line-height: 1.7;
}

.no-feedback {
    text-align: center;
    background: #faf7f4;
    padding: 25px;
    border-radius: 15px;
    color: #777;
}

.no-feedback i {
    font-size: 30px;
    color: #ba6a4a;
    margin-bottom: 10px;
}


/* MAIN TWO COLUMN LAYOUT */

.class-page-row {
    display: flex;
    align-items: flex-start;
    gap: 24px;
}

.class-details-column {
    flex: 0 0 calc(66.666% - 12px);
    max-width: calc(66.666% - 12px);
}

.feedback-column {
    flex: 0 0 calc(33.333% - 12px);
    max-width: calc(33.333% - 12px);
}


/* RESPONSIVE */

@media (max-width: 991px) {

    .class-page-row {
        flex-direction: column;
    }

    .class-details-column,
    .feedback-column {
        flex: 0 0 100%;
        max-width: 100%;
        width: 100%;
    }

}
    </style>


</head>

<body>
    <?php include('navbar.php'); ?>

 <div class="class-page-row p-4">

    <!-- LEFT: CLASS DETAILS -->
    <div class="class-details-column">

        <div class="details-card">

            <!-- তোমার HEADER -->
            <div class="header-section">

                <div class="header-icon">
                    <i class="fa-solid fa-spa"></i>
                </div>

                <h1 class="class-name">
                    <?php echo $row['name'] ?? 'Yoga Class'; ?>
                </h1>

                <p>
                    Balance • Strength • Inner Peace
                </p>

            </div>


            <!-- DETAILS -->
            <div class="row g-0">

                <!-- LEFT PANEL -->
                <div class="col-md-4">

                    <div class="left-panel">

                        <div class="info-item">
                            <div class="info-title">Instructor</div>

                            <div class="info-value">
                                <?php echo $row['instructor'] ?? 'Not Available'; ?>
                            </div>
                        </div>


                        <div class="info-item">
                            <div class="info-title">Level</div>

                            <div class="info-value">
                                <?php echo $row['level'] ?? 'Beginner'; ?>
                            </div>
                        </div>


                        <div class="info-item">
                            <div class="info-title">Duration</div>

                            <div class="info-value">
                                <?php echo $row['duration'] ?? '0'; ?> min
                            </div>
                        </div>


                        <div class="info-item">
                            <div class="info-title">Date</div>

                            <div class="info-value">
                                <?php echo $row['schedule_date'] ?? 'Not Available'; ?>
                            </div>
                        </div>


                        <div class="info-item">
                            <div class="info-title">Price</div>

                            <div class="info-value">
                                ₹ <?php echo $row['price'] ?? '0'; ?>
                            </div>
                        </div>

                    </div>

                </div>


                <!-- RIGHT PANEL -->
                <div class="col-md-8">

                    <div class="right-panel">

                        <h3 class="section-title">
                            Description
                        </h3>

                        <p>
                            <?php
                            echo $row['description'] ?? 'No description available';
                            ?>
                        </p>


                        <h3 class="section-title mt-5">
                            Benefits
                        </h3>


                        <?php

                        if (!empty($row['benefits'])) {

                            $benefits = explode(',', $row['benefits']);

                            foreach ($benefits as $benefit) {

                        ?>

                                <div class="benefit-box">

                                    <i class="fa-regular fa-circle-check"
                                        style="color:#ba6a4a;">
                                    </i>

                                    <?php echo trim($benefit); ?>

                                </div>

                        <?php

                            }

                        } else {

                        ?>

                            <div class="benefit-box">
                                No benefits available
                            </div>

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>

    </div>
        <!-- RIGHT: FEEDBACK -->
    <div class="feedback-column">

        <div class="feedback-card">

            <!-- FEEDBACK HEADER -->

            <div class="feedback-header">

                <h2>Class Feedback</h2>

                <p>
                    Share your experience with this yoga class.
                </p>

            </div>


            <!-- SUCCESS -->

            <?php if (
                isset($_GET['feedback']) &&
                $_GET['feedback'] == 'success'
            ) { ?>

                <div class="alert alert-success">
                    Your feedback has been submitted successfully.
                </div>

            <?php } ?>


            <!-- ERROR -->

            <?php if (!empty($feedback_error)) { ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($feedback_error); ?>
                </div>

            <?php } ?>


            <!-- FORM -->

            <div class="feedback-form-card">

                <form method="POST">

                    <div class="mb-3">

                        <label class="form-label">
                            Your Feedback
                        </label>

                        <textarea
                            name="message"
                            class="form-control"
                            rows="4"
                            placeholder="Share your experience with this class..."
                            required></textarea>

                    </div>


                    <button
                        type="submit"
                        name="submit_class_feedback"
                        class="feedback-submit-btn">

                        <i class="fa-solid fa-paper-plane"></i>
                        Submit Feedback

                    </button>

                </form>

            </div>


            <!-- PREVIOUS FEEDBACK -->

            <div class="previous-feedback">

                <h3>What Others Say</h3>

                <p class="feedback-subtitle">
                    Feedback from other students.
                </p>


                <?php

                if (
                    $feedback_query &&
                    mysqli_num_rows($feedback_query) > 0
                ) {

                    while (
                        $feedback = mysqli_fetch_assoc($feedback_query)
                    ) {

                ?>

                        <div class="single-feedback">

                            <div class="feedback-user">

                                <?php if (!empty($feedback['image'])) { ?>

                                    <img
                                        src="images/<?php echo htmlspecialchars($feedback['image']); ?>"
                                        alt="User">

                                <?php } else { ?>

                                    <div class="feedback-avatar">

                                        <?php
                                        echo strtoupper(
                                            substr(
                                                $feedback['name'],
                                                0,
                                                1
                                            )
                                        );
                                        ?>

                                    </div>

                                <?php } ?>


                                <div>

                                    <h5>
                                        <?php
                                        echo htmlspecialchars(
                                            $feedback['name']
                                        );
                                        ?>
                                    </h5>

                                    <small>
                                        <?php
                                        echo date(
                                            'd M Y',
                                            strtotime(
                                                $feedback['created_at']
                                            )
                                        );
                                        ?>
                                    </small>

                                </div>

                            </div>


                            <p class="feedback-message">

                                <?php
                                echo htmlspecialchars(
                                    $feedback['message']
                                );
                                ?>

                            </p>

                        </div>

                <?php

                    }

                } else {

                ?>

                    <div class="no-feedback">

                        <i class="fa-regular fa-comment"></i>

                        <p>No feedback yet.</p>

                        <small>
                            Be the first to share your experience!
                        </small>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>



</body>

</html>
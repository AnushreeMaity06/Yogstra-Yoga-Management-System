<?php
global $conn;
include_once '../db_connect.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM classes WHERE id='$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>

    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                linear-gradient(rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)),
                url('../assets/image/il_fullxfull.6188745219_riqb.webp');

            background-size: cover;
            background-position: center;
        }

        .main-wrapper {
            width: 100%;
            max-width: 850px;
        }

        /* IMAGE */
        .image-box {
            overflow: hidden;
            border-radius: 20px;
            height: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
        }

        .image-box img {
            width: 100%;
            height: 100%;
            min-height: 370px;
            object-fit: cover;
            transition: 0.5s ease;
        }

        .image-box:hover img {
            transform: scale(1.05);
        }

        /* FORM CARD */
        .card-box {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);

            border: 1px solid rgba(255, 255, 255, 0.2);

            padding: 24px;
            border-radius: 20px;

            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.3);

            transition: 0.4s ease;
        }

        .card-box:hover {
            transform: translateY(-3px);
        }

        /* TITLE */
        .title {
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            color: white;
            margin-bottom: 5px;
        }

        .title i {
            color: #ff914d;
            margin-right: 6px;
        }

        /* SUBTITLE */
        .small-text {
            text-align: center;
            color: #f1f1f1;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* LABEL */
        .form-label {
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        /* INPUT */
        .custom-input,
        .custom-select {
            width: 100%;
            height: 42px;

            border: none;
            outline: none;

            border-radius: 12px;

            background: rgba(255, 255, 255, 0.95);

            padding: 8px 12px;

            font-size: 14px;

            transition: 0.3s ease;
        }

        .custom-input:focus,
        .custom-select:focus {

            transform: scale(1.01);

            box-shadow:
                0 0 8px rgba(255, 145, 77, 0.6);
        }

        /* BUTTON */
        .btn-submit {
            width: 100%;
            border: none;

            background: linear-gradient(45deg, #ff914d, #ba6a4a);

            color: white;

            padding: 11px;

            border-radius: 12px;

            font-size: 15px;
            font-weight: 600;

            margin-top: 8px;

            transition: 0.4s ease;
        }

        .btn-submit:hover {

            transform: translateY(-2px);

            box-shadow:
                0 6px 18px rgba(255, 65, 108, 0.5);
        }

        /* MOBILE */
        @media(max-width:768px) {

            body {
                padding: 12px;
            }

            .image-box {
                margin-bottom: 18px;
            }

            .image-box img {
                min-height: 220px;
            }

            .card-box {
                padding: 18px;
            }

            .title {
                font-size: 22px;
            }

            .custom-input,
            .custom-select {
                height: 40px;
                font-size: 13px;
            }
        }
    </style>

</head>

<body>

    <div class="container main-wrapper">

        <div class="row align-items-center g-4">

            <!-- IMAGE -->
            <div class="col-lg-5">

                <div class="image-box">

                    <img src="../assets/image/il_fullxfull.6188745219_riqb.webp"
                        alt="Yoga Image">

                </div>

            </div>

            <!-- FORM -->
            <div class="col-lg-7">

                <div class="card-box">

                    <div class="title">
                       
                    </div>

                    <div class="small-text">
                        Update your yoga class details professionally
                    </div>

                    <form action="classedit_action.php" method="POST">

                        <!-- Hidden ID -->
                        <input type="hidden"
                            name="id"
                            value="<?php echo $row['id']; ?>">

                        <!-- Class Name -->
                        <div class="mb-2">

                            <label class="form-label">
                                Class Name
                            </label>

                            <input type="text"
                                name="name"
                                class="custom-input"
                                value="<?php echo $row['name']; ?>"
                                required>

                        </div>

                        <!-- Instructor -->
                        <div class="mb-2">

                            <label class="form-label">
                                Instructor
                            </label>

                            <input type="text"
                                name="instructor"
                                class="custom-input"
                                value="<?php echo $row['instructor']; ?>"
                                required>

                        </div>

                        <!-- Level -->
                        <div class="mb-2">

                            <label class="form-label">
                                Level
                            </label>

                            <select name="level"
                                class="custom-select">

                                <option value="Beginner"
                                    <?php if($row['level']=="Beginner") echo "selected"; ?>>
                                    Beginner
                                </option>

                                <option value="Intermediate"
                                    <?php if($row['level']=="Intermediate") echo "selected"; ?>>
                                    Intermediate
                                </option>

                                <option value="Advanced"
                                    <?php if($row['level']=="Advanced") echo "selected"; ?>>
                                    Advanced
                                </option>

                            </select>

                        </div>

                        <!-- Duration -->
                        <div class="mb-2">

                            <label class="form-label">
                                Duration (mins)
                            </label>

                            <input type="number"
                                name="duration"
                                class="custom-input"
                                value="<?php echo $row['duration']; ?>"
                                required>

                        </div>

                        <!-- Price -->
                        <div class="mb-2">

                            <label class="form-label">
                                Price
                            </label>

                            <input type="number"
                                name="price"
                                class="custom-input"
                                value="<?php echo $row['price']; ?>"
                                required>

                        </div>

                        <!-- Status -->
                        <div class="mb-2">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status"
                                class="custom-select">

                                <option value="Active"
                                    <?php if($row['status']=="Active") echo "selected"; ?>>
                                    Active
                                </option>

                                <option value="Inactive"
                                    <?php if($row['status']=="Inactive") echo "selected"; ?>>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <button type="submit"
                            class="btn-submit">

                            Update Class

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
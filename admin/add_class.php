<?php

session_start();

include '../db_connect.php';
global $conn;

/* =========================
   Teacher List
========================= */

$teacher_query = mysqli_query(
    $conn,
    "SELECT id, name FROM users WHERE role = 'teacher'"
);


/* =========================
   Add Class
========================= */

if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    // Selected teacher ID
    $teacher_id = $_POST['teacher_id'];

    $level = $_POST['level'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $schedule_date = $_POST['schedule_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $description = $_POST['description'];
    $benefits = $_POST['benefits'];


    /*
     * Admin যেই teacher select করেছে
     * তার name বের করা হচ্ছে
     */
    $teacher_result = mysqli_query(
        $conn,
        "SELECT name FROM users
         WHERE id = '$teacher_id'
         AND role = 'teacher'"
    );

    $teacher_data = mysqli_fetch_assoc($teacher_result);

    $instructor = $teacher_data['name'];


    /*
     * যে Admin class তৈরি করেছে
     * তার user ID
     */
    $created_by = $_SESSION['user_id'];


    /*
     * Class Insert
     */
    $sql = "
        INSERT INTO classes
        (
            name,
            instructor,
            level,
            duration,
            price,
            schedule_date,
            start_time,
            end_time,
            description,
            benefits,
            status,
            created_by,
            teacher_id
        )
        VALUES
        (
            '$name',
            '$instructor',
            '$level',
            '$duration',
            '$price',
            '$schedule_date',
            '$start_time',
            '$end_time',
            '$description',
            '$benefits',
            'Active',
            '$created_by',
            '$teacher_id'
        )
    ";


    if (mysqli_query($conn, $sql)) {

        header("Location: classes.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Class</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


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
                    rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.55)
                ),
                url('../assets/image/il_fullxfull.6188745219_riqb.webp');

            background-size: cover;

            background-position: center;
        }


        /* MAIN CARD */

        .card-box {

            width: 100%;

            max-width: 430px;

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

            color: #fff;

            margin-bottom: 5px;
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

            color: #fff;

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


        /* FORM SPACING */

        .mb-3 {

            margin-bottom: 12px !important;
        }


        /* BUTTON */

        .btn-submit {

            width: 100%;

            border: none;

            background:
                linear-gradient(
                    45deg,
                    #ff914d,
                    #ba6a4a
                );

            color: #fff;

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

        @media(max-width:480px) {

            .card-box {

                max-width: 350px;

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


<div class="card-box">


    <div class="title">

        Create New Class

    </div>


    <div class="small-text">

        Fill details to add a new yoga session

    </div>



    <form method="POST" action="add_class.php">


        <div class="row">


            <!-- Class Name -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Class Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="custom-input"
                    required
                >

            </div>



            <!-- Instructor -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Instructor
                </label>


                <select
                    name="teacher_id"
                    class="custom-select"
                    required
                >

                    <option value="">
                        Select Instructor
                    </option>


                    <?php while ($teacher = mysqli_fetch_assoc($teacher_query)) { ?>

                        <option value="<?php echo $teacher['id']; ?>">

                            <?php echo htmlspecialchars($teacher['name']); ?>

                        </option>

                    <?php } ?>


                </select>

            </div>



            <!-- Level -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Level
                </label>


                <select
                    name="level"
                    class="custom-select"
                    required
                >

                    <option value="Beginner">
                        Beginner
                    </option>

                    <option value="Intermediate">
                        Intermediate
                    </option>

                    <option value="Advanced">
                        Advanced
                    </option>

                </select>

            </div>



            <!-- Duration -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Duration (mins)
                </label>


                <input
                    type="number"
                    id="duration"
                    name="duration"
                    class="custom-input"
                    required
                >

            </div>



            <!-- Date -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Class Date
                </label>


                <input
                    type="date"
                    name="schedule_date"
                    class="custom-input"
                    value="<?php echo date('Y-m-d'); ?>"
                    min="<?php echo date('Y-m-d'); ?>"
                    required
                >

            </div>



            <!-- Price -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Price
                </label>


                <input
                    type="number"
                    name="price"
                    class="custom-input"
                    required
                >

            </div>



            <!-- Start Time -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Start Time
                </label>


                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    class="custom-input"
                    required
                >

            </div>



            <!-- End Time -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    End Time
                </label>


                <input
                    type="time"
                    id="end_time"
                    name="end_time"
                    class="custom-input"
                    required
                >

            </div>



            <!-- Description -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Class Description
                </label>


                <textarea
                    name="description"
                    class="custom-input"
                    style="height:80px; resize:none;"
                    required
                ></textarea>

            </div>



            <!-- Benefits -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Class Benefits
                </label>


                <textarea
                    name="benefits"
                    class="custom-input"
                    style="height:80px; resize:none;"
                    required
                ></textarea>

            </div>


        </div>



        <button
            type="submit"
            name="submit"
            class="btn-submit"
        >

            Save Class

        </button>


    </form>



</div>



<script type="text/javascript">

    const startInput =
        document.getElementById("start_time");

    const endInput =
        document.getElementById("end_time");

    const durationInput =
        document.getElementById("duration");


    // Start Time + Duration => End Time

    function updateEndTime() {

        let start = startInput.value;

        let duration =
            parseInt(durationInput.value);


        if (start && !isNaN(duration)) {

            let [hours, minutes] =
                start.split(":");


            let totalMinutes =
                parseInt(hours) * 60 +
                parseInt(minutes) +
                duration;


            let endHours =
                Math.floor(totalMinutes / 60) % 24;


            let endMinutes =
                totalMinutes % 60;


            endInput.value =

                String(endHours).padStart(2, '0')
                + ":" +

                String(endMinutes).padStart(2, '0');

        }

    }



    // Start Time + End Time => Duration

    function updateDuration() {

        let start = startInput.value;

        let end = endInput.value;


        if (start && end) {

            let [sh, sm] =
                start.split(":");

            let [eh, em] =
                end.split(":");


            let startMinutes =
                parseInt(sh) * 60 +
                parseInt(sm);


            let endMinutes =
                parseInt(eh) * 60 +
                parseInt(em);


            let diff =
                endMinutes - startMinutes;


            if (diff > 0) {

                durationInput.value =
                    diff;

            }

        }

    }



    // Event Listeners

    durationInput.addEventListener(
        "input",
        updateEndTime
    );


    startInput.addEventListener(
        "input",
        updateEndTime
    );


    endInput.addEventListener(
        "input",
        updateDuration
    );

</script>


</body>

</html>
<?php

session_start();
include '../db_connect.php';
global $conn;

if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    // Logged-in teacher
    $instructor = $_SESSION['user_name'];

    $level = $_POST['level'];
    $description = $_POST['description'];
    $benefits = $_POST['benefits'];

    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $schedule_date = $_POST['schedule_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Logged-in teacher's ID
    $teacher_id = $_SESSION['user_id'];

    // Teacher himself created the class
    $created_by = $_SESSION['user_id'];


    $sql = "
        INSERT INTO classes
        (
            name,
            instructor,
            level,
            description,
            benefits,
            duration,
            price,
            schedule_date,
            start_time,
            end_time,
            status,
            created_by,
            teacher_id
        )
        VALUES
        (
            '$name',
            '$instructor',
            '$level',
            '$description',
            '$benefits',
            '$duration',
            '$price',
            '$schedule_date',
            '$start_time',
            '$end_time',
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


<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>


<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    background:

    linear-gradient(
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.55)
    ),

    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;

    background-position:center;

    font-family:'Poppins',sans-serif;

    min-height:100vh;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:10px;

    overflow:hidden;
}


.card-box{

    width:100%;

    max-width:430px;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,0.2);

    padding:18px;

    border-radius:18px;

    box-shadow:0 8px 28px rgba(0,0,0,0.3);
}


.title{

    font-size:22px;

    font-weight:700;

    text-align:center;

    color:white;

    margin-bottom:3px;
}


.small-text{

    text-align:center;

    color:#f1f1f1;

    font-size:12px;

    margin-bottom:12px;
}


.form-label{

    color:white;

    font-size:14px;

    font-weight:500;
}


.custom-input,
.custom-select{

    width:100%;

    border:none;

    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,0.95);

    height:40px;

    padding:8px 12px;

    font-size:13px;
}


.custom-input:focus,
.custom-select:focus{

    box-shadow:
        0 0 8px rgba(255,145,77,0.6);
}


.mb-3{

    margin-bottom:8px !important;
}


.btn-submit{

    width:100%;

    border:none;

    background:
        linear-gradient(
            45deg,
            #ff914d,
            #ba6a4a
        );

    color:white;

    border-radius:12px;

    font-size:15px;

    font-weight:600;

    padding:10px;

    margin-top:5px;
}


.btn-submit:hover{

    transform:translateY(-2px);

}


textarea.custom-input{

    height:70px;

    resize:none;
}


@media(max-width:480px){

    .card-box{

        max-width:350px;

        padding:15px;
    }

    .title{

        font-size:20px;
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



<form method="POST">


    <!-- Class Name + Instructor -->

    <div class="row">


        <div class="col-md-6 mb-2">

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



        <div class="col-md-6 mb-2">

            <label class="form-label">

                Instructor

            </label>

            <input
                type="text"
                class="custom-input"
                value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>"
                readonly
            >

        </div>


    </div>



    <!-- Level + Duration -->

    <div class="row">


        <div class="col-md-6 mb-2">

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



        <div class="col-md-6 mb-2">

            <label class="form-label">

                Duration (mins)

            </label>


            <input
                type="number"
                id="duration"
                name="duration"
                class="custom-input"
                min="1"
                required
            >

        </div>


    </div>



    <!-- Date + Price -->

    <div class="row">


        <div class="col-md-6 mb-2">

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



        <div class="col-md-6 mb-2">

            <label class="form-label">

                Price

            </label>


            <input
                type="number"
                name="price"
                class="custom-input"
                min="0"
                required
            >

        </div>


    </div>



    <!-- Start Time + End Time -->

    <div class="row">


        <div class="col-md-6 mb-2">

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



        <div class="col-md-6 mb-2">

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


    </div>



    <!-- Description -->

    <div class="mb-2">

        <label class="form-label">

            Description

        </label>


        <textarea
            name="description"
            class="custom-input"
            style="height:60px; resize:none;"
            required
        ></textarea>

    </div>



    <!-- Benefits -->

    <div class="mb-2">

        <label class="form-label">

            Benefits

        </label>


        <textarea
            name="benefits"
            class="custom-input"
            style="height:60px; resize:none;"
            required
        ></textarea>

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



<script>

const startInput =
    document.getElementById("start_time");

const endInput =
    document.getElementById("end_time");

const durationInput =
    document.getElementById("duration");


// =====================================
// Start Time + Duration = End Time
// =====================================

function updateEndTime(){

    let start =
        startInput.value;

    let duration =
        parseInt(durationInput.value);


    if(start && !isNaN(duration)){

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

            String(endHours).padStart(2,'0')
            + ":" +

            String(endMinutes).padStart(2,'0');

    }

}



// =====================================
// Start Time + End Time = Duration
// =====================================

function updateDuration(){

    let start =
        startInput.value;

    let end =
        endInput.value;


    if(start && end){

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


        if(diff > 0){

            durationInput.value =
                diff;

        }

    }

}



// =====================================
// Events
// =====================================

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
<?php
global $conn;
include('../db_connect.php');

if (isset($_POST['add_teacher'])) {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $gender  = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $image = "";

    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../images/" . $image
        );
    }

    $sql = "INSERT INTO users
            (name,email,gender,ph_no,address,image,role)
            VALUES
            ('$name','$email','$gender','$phone','$address','$image','teacher')";

    if (mysqli_query($conn, $sql)) {
        header("Location: teacher_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Teacher</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
   *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;

    background:
    linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;
    background-position:center;
}

/* MAIN CARD */
.card-box{
    width:100%;
    max-width:430px;

    background:rgba(255,255,255,0.10);
    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,0.25);
    border-radius:22px;

    padding:30px;

    box-shadow:0 10px 35px rgba(0,0,0,0.45);
}

/* TITLE */
.title{
    text-align:center;
    color:#fff;
    font-size:30px;
    font-weight:700;
}

.small-text{
    text-align:center;
    color:#ddd;
    font-size:13px;
    margin-bottom:20px;
}

/* LABEL */
.form-label{
    color:#fff;
    font-size:13px;
    font-weight:500;
}

/* INPUT */
.custom-input{

    width:100%;
    height:45px;

    border:none;
    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,0.95);

    padding:10px 12px;

    font-size:14px;

    transition:0.3s;
}

.custom-input:focus{
    transform:scale(1.02);
    box-shadow:0 0 12px rgba(255,145,77,0.6);
}

/* TEXTAREA */
textarea.custom-input{
    height:90px;
    resize:none;
}

/* FILE INPUT */
.file-input{
    width:100%;
    background:#fff;
    padding:10px;
    border-radius:12px;
    font-size:13px;
}

/* BUTTON */
.btn-submit{

    width:100%;

    border:none;

    background:linear-gradient(45deg,#ff7b54,#ff416c);

    color:#fff;

    padding:12px;

    border-radius:12px;

    font-size:16px;
    font-weight:600;

    margin-top:15px;

    transition:0.3s;
}

.btn-submit:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(255,65,108,0.5);
}

/* SPACING */
.mb-3{
    margin-bottom:15px !important;
}

/* RESPONSIVE */
@media(max-width:768px){
    .card-box{
        max-width:420px;
        padding:18px;
    }

    .title{
        font-size:24px;
    }
}
</style>

</head>

<body>

    <div class="card-box">

        <div class="title">Add Teacher</div>
        <div class="small-text">Create a new teacher profile</div>

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teacher Name</label>
                    <input type="text" name="name" class="custom-input" required>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="custom-input" required>
                </div>

                <!-- Gender -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="custom-input">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="custom-input">
                </div>

                <!-- Address -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="custom-input"></textarea>
                </div>

                <!-- Image -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Teacher Image</label>
                    <input type="file" name="image" class="file-input">
                </div>

            </div>

            <button type="submit" name="add_teacher" class="btn-submit">
                Add Teacher
            </button>

        </form>

    </div>

</body>

</html>
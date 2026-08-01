<?php

include('../db_connect.php');

global $conn;


// ============banner upload=====================
if(isset($_POST['upload'])){

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    // $button_text = $_POST['button_text'];
    // $button_link = $_POST['button_link'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"../uploads/bannerimage/".$image);

    $sql = "INSERT INTO banners(title,subtitle,image,status)
            VALUES('$title','$subtitle','$image','1')";

    $run = mysqli_query($conn,$sql);

    if($run){

        header("Location: overview.php");
        exit();

    }else{

        echo mysqli_error($conn);

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Banner</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:'Poppins', sans-serif;

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:15px;

    background:
    linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;
    background-position:center;
}

/* CARD */

.card-box{

    width:100%;
    max-width:450px;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,0.2);

    padding:25px;

    border-radius:22px;

    box-shadow:0 8px 28px rgba(0,0,0,0.3);

    transition:0.4s ease;
}

.card-box:hover{
    transform:translateY(-3px);
}

/* TITLE */

.title{

    font-size:28px;

    font-weight:700;

    text-align:center;

    color:#fff;

    margin-bottom:5px;
}

/* SUBTITLE */

.small-text{

    text-align:center;

    color:#f1f1f1;

    font-size:13px;

    margin-bottom:20px;
}

/* LABEL */

.form-label{

    color:#fff;

    font-size:14px;

    font-weight:500;

    margin-bottom:6px;
}

/* INPUT */

.custom-input{

    width:100%;

    height:44px;

    border:none;

    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,0.95);

    padding:8px 12px;

    font-size:14px;

    transition:0.3s ease;
}

.custom-input:focus{

    transform:scale(1.01);

    box-shadow:
    0 0 8px rgba(255,145,77,0.6);
}

/* FILE INPUT */

.file-input{

    width:100%;

    background:rgba(255,255,255,0.95);

    border-radius:12px;

    padding:10px;

    font-size:14px;
}

/* BUTTON */

.btn-submit{

    width:100%;

    border:none;

    background:
    linear-gradient(45deg,#f57847,#ba6a4a);

    color:#fff;

    padding:11px;

    border-radius:12px;

    font-size:15px;

    font-weight:600;

    margin-top:10px;

    transition:0.4s ease;
}

.btn-submit:hover{

    transform:translateY(-2px);

    box-shadow:
    0 6px 18px rgba(255,65,108,0.5);
}

/* SPACING */

.mb-3{
    margin-bottom:14px !important;
}

/* MOBILE */

@media(max-width:480px){

    .card-box{

        max-width:360px;

        padding:18px;
    }

    .title{
        font-size:24px;
    }

    .custom-input{
        height:40px;
        font-size:13px;
    }
}

</style>

</head>

<body>

<div class="card-box">

    <div class="title">
        Add New Banner
    </div>

    <div class="small-text">
        Upload beautiful homepage banners
    </div>

    <form method="POST" enctype="multipart/form-data">

        <!-- TITLE -->

        <div class="mb-3">

            <label class="form-label">
                Banner Title
            </label>

            <input type="text"
                name="title"
                class="custom-input"
                required>

        </div>

        <!-- SUBTITLE -->

        <div class="mb-3">

            <label class="form-label">
                Subtitle
            </label>

            <input type="text"
                name="subtitle"
                class="custom-input"
                required>

        </div>

        <!-- BUTTON TEXT -->

        <!-- <div class="mb-3">

            <label class="form-label">
                Button Text
            </label>

            <input type="text"
                name="button_text"
                class="custom-input"
                required>

        </div> -->

        <!-- BUTTON LINK -->

        <!-- <div class="mb-3">

            <label class="form-label">
                Button Link
            </label>

            <input type="text"
                name="button_link"
                class="custom-input"
                required>

        </div> -->

        <!-- IMAGE -->

        <div class="mb-3">

            <label class="form-label">
                Banner Image
            </label>

            <input type="file"
                name="image"
                class="file-input"
                required>

        </div>

        <!-- BUTTON -->

        <button type="submit"
            name="upload"
            class="btn-submit">

            Upload Banner

        </button>

    </form>

</div>

</body>
</html>
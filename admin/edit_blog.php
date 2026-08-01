<?php
global $conn;
include("../db_connect.php");

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM `blogs`WHERE id='$id' ");

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {


    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = $_POST['category'];
    $read_time = $_POST['read_time'];
    $description = $_POST['description'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Check image uploaded or not 
    if ($_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "../uploads/blog_image/" . $image);
    } else {
        // keep old image 
        $image = $row['image'];
    }


    $sql = "UPDATE blogs SET title='$title',
     category='$category',
      read_time='$read_time', 
      description='$description', 
      image='$image'
       WHERE id='$id'";


    if (mysqli_query($conn, $sql)) {
        header("Location: blogs.php");
    }
} ?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>


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

<body>
    
    <div class="container main-wrapper">

        <div class="row align-items-center g-4">

            <!-- Left Side Image -->
            <div class="col-lg-5">

                <div class="image-box">

                    <img src="../assets/image/il_fullxfull.6188745219_riqb.webp"
                        alt="Yoga Image">

                </div>

            </div>

            <!-- Right Side Form -->
            <div class="col-lg-7">

                <div class="card-box">

                    <div class="title">
                        <i class="fa fa-pen" style="color:white;"></i>
                        Edit Blog
                    </div>

                    <div class="small-text">
                        Update your blog details professionally
                    </div>


<form method="POST" enctype="multipart/form-data">

    <div class="row">

        <!-- IMAGE (SEPARATE BLOCK) -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Image</label><br>

            <img src="../uploads/blog_image/<?php echo $row['image']; ?>"
                 width="120"
                 class="rounded mb-2 d-block">

            <input type="file"
                   name="image"
                   class="custom-input">
        </div>

        <!-- TITLE (SEPARATE ROW) -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Title</label>
            <input type="text"
                   name="title"
                   class="custom-input"
                   value="<?php echo $row['title']; ?>"
                   required>
        </div>

        <!-- CATEGORY -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <input type="text"
                   name="category"
                   class="custom-input"
                   value="<?php echo $row['category']; ?>"
                   required>
        </div>

        <!-- READ TIME -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Read Time</label>
            <input type="text"
                   name="read_time"
                   class="custom-input"
                   value="<?php echo $row['read_time']; ?>"
                   required>
        </div>

        <!-- DESCRIPTION -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>

            <textarea name="description"
                      class="custom-input"
                      style="height:130px;"><?php echo $row['description']; ?></textarea>
        </div>

    </div>

    <button type="submit"
            name="update"
            class="btn-submit">

        Update Blog

    </button>

</form> 
                </div>
            </div>
        </div>
    </div>


</body>

</html>
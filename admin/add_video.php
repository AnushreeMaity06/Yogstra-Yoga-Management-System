<?php
include('../db_connect.php');

global $conn;

session_start();

if(isset($_POST['add_video'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $uploaded_by=$_SESSION['user_id'];
    $uploader_role=$_SESSION['role'];

    // thumbnail
    $thumbnail = $_FILES['thumbnail']['name'];
    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
    $upload="../uploads/thumbnails/".$thumbnail;


    // video
    $video = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];

    // upload thumbnail
    move_uploaded_file($thumbnail_tmp,$upload);

    // upload video
    move_uploaded_file(
        $video_tmp,
        "../uploads/videos/".$video
    );

    // insert database
    $sql = "INSERT INTO videos
    (title, description, thumbnail, video_file, category,uploaded_by,uploader_role)

    VALUES
    ('$title','$description',
    '$thumbnail','$video','$category','$uploaded_by','$uploader_role')";

    $result = mysqli_query($conn,$sql);

    if($result){

        $msg = "Video Uploaded Successfully";

    }else{

        $msg = "Upload Failed";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Video</title>

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Google Font -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
rel="stylesheet">

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
    linear-gradient(rgba(0,0,0,0.55),
    rgba(0,0,0,0.55)),
    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;

    background-position:center;
}

/* MAIN CARD */

.card-box{

    width:100%;

    max-width:430px;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,0.2);

    padding:20px;

    border-radius:20px;

    box-shadow:0 8px 28px rgba(0,0,0,0.3);

    transition:0.4s ease;
}

.card-box:hover{

    transform:translateY(-3px);
}

/* TITLE */

.title{

    font-size:25px;

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

    margin-bottom:12px;
}

/* LABEL */

.form-label{

    color:#fff;

    font-size:14px;

    font-weight:500;

    margin-bottom:6px;
}

/* INPUT */

.custom-input,
.custom-textarea{

    width:100%;

    border:none;

    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,0.95);

    padding:10px;

    font-size:14px;

    transition:0.3s ease;
}

.custom-input{

    height:40px;
}

.custom-textarea{

    resize:none;
}

/* FOCUS */

.custom-input:focus,
.custom-textarea:focus{

    transform:scale(1.01);

    box-shadow:
    0 0 8px rgba(255,145,77,0.6);
}

/* BUTTON */

.btn-submit{

    width:100%;

    border:none;

       background: linear-gradient(45deg, #ff914d, #ba6a4a);
    color:#fff;

    padding:11px;

    border-radius:12px;

    font-size:15px;

    font-weight:600;

    margin-top:8px;

    transition:0.4s ease;
}

.btn-submit:hover{

    transform:translateY(-2px);

    box-shadow:
    0 6px 18px #ba6a4a;
}

/* ALERT */

.alert{

    border-radius:12px;
}

/* MOBILE */

@media(max-width:480px){

    .card-box{

        max-width:350px;

        padding:18px;
    }

    .title{

        font-size:22px;
    }

    .custom-input,
    .custom-textarea{

        font-size:13px;
    }
}

</style>

</head>

<body>

<div class="card-box">

    <div class="title">
        Upload Video
    </div>

    <div class="small-text">
        Add yoga tutorial videos for students
    </div>

    <?php if(isset($msg)){ ?>

        <div class="alert alert-info">

            <?php echo $msg; ?>

        </div>

    <?php } ?>

    <form method="POST"
    enctype="multipart/form-data">

        <!-- Title -->

        <div class="mb-3">

            <label class="form-label">

                Video Title

            </label>

            <input type="text"
            name="title"
            class="custom-input"
            required>

        </div>

        <!-- Description -->

        <div class="mb-3">

            <label class="form-label">

                Description

            </label>

            <textarea name="description"
            rows="3"
            class="custom-textarea"
            required></textarea>

        </div>

        <!-- Category -->

        <div class="mb-3">

            <label class="form-label">

                Category

            </label>

            <input type="text"
            name="category"
            class="custom-input"
            required>

        </div>

        <!-- Thumbnail -->

        <div class="mb-3">

            <label class="form-label">

                Thumbnail Image

            </label>

            <input type="file"
            name="thumbnail"
            class="custom-input"
            required>

        </div>

        <!-- Video -->

        <div class="mb-3">

            <label class="form-label">

                Video File

            </label>

            <input type="file"
            name="video"
            class="custom-input"
            required>

        </div>

        <!-- BUTTON -->

        <button type="submit"
        name="add_video"
        class="btn-submit">

            Upload Video

        </button>

    </form>

</div>

</body>

</html>
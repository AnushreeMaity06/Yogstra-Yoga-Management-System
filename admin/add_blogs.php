<?php

global $conn;
include('../db_connect.php');



if(isset($_POST['submit'])){


// $title=$_POST['title'];

$title = mysqli_real_escape_string($conn, $_POST['title']);
$category=$_POST['category'];
$description = mysqli_real_escape_string($conn, $_POST['description']);
$read_time=$_POST['read_time'];

$image=$_FILES['image']['name'];
$tmp_name=$_FILES['image']['tmp_name'];


move_uploaded_file($tmp_name,"../uploads/blog_image/".$image);

$conn->query("INSERT INTO `blogs`(`title`, `category`, `description`,`read_time`, `image`) 
VALUES ('$title','$category','$description','$read_time','$image')");

header("Location:blogs.php");
exit();


}
?>


<!--  -->



<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    justify-content:center;
    align-items:center;
    padding:15px;

    background:
    linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;
    background-position:center;
}

.card-box{

    width:100%;
    max-width:450px;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,.2);

    border-radius:20px;

    padding:24px;

    box-shadow:0 8px 28px rgba(0,0,0,.3);
}

.title{
    color:#fff;
    text-align:center;
    font-size:26px;
    font-weight:700;
}

.small-text{
    text-align:center;
    color:#f1f1f1;
    font-size:13px;
    margin-bottom:18px;
}

.form-label{
    color:#fff;
    font-size:14px;
    font-weight:500;
}

.custom-input{

    width:100%;

    border:none;
    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,.95);

    padding:10px 12px;

    font-size:14px;
}

.custom-input:focus{

    box-shadow:0 0 8px rgba(255,145,77,.6);
}

textarea.custom-input{
    resize:none;
}

.btn-submit{

    width:100%;

    border:none;

    background:linear-gradient(45deg,#ff914d,#ba6a4a);

    color:#fff;

    padding:11px;

    border-radius:12px;

    font-weight:600;

    transition:.4s;
}

.btn-submit:hover{

    transform:translateY(-2px);

    box-shadow:0 6px 18px rgba(255,65,108,.5);
}

</style>

</head>
<body>

<div class="card-box">

    <div class="title">
        Add New Blog
    </div>

    <div class="small-text">
        Fill details to publish a blog
    </div>

   <form method="POST" enctype="multipart/form-data">

    <div class="row">

        <!-- Blog Title -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Blog Title</label>
            <input type="text" name="title" class="custom-input" required>
        </div>

        <!-- Category -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="custom-input" required>
        </div>

        <!-- Read Time -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Read Time</label>
            <input type="text" name="read_time" class="custom-input" placeholder="5 Min Read" required>
        </div>

        <!-- Image -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" name="image" class="custom-input" required>
        </div>

        <!-- Description (FULL ROW) -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      rows="6"
                      class="custom-input"
                      required></textarea>
        </div>

    </div>

    <button type="submit"
            name="submit"
            class="btn-submit">

        Publish Blog

    </button>

</form>

</div>

</body>
</html>
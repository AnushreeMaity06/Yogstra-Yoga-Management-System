<?php
global $conn;
include '../db_connect.php';


if(isset($_POST['add_membership'])){

$title=$_POST['title'];
$description=$_POST['description'];
$price=$_POST['price'];
$feature1=$_POST['feature1'];
$feature2=$_POST['feature2'];
$feature3=$_POST['feature3'];




$conn->query("INSERT INTO `membership_plans`(`title`, `description`, `price`, `feature1`, `feature2`, `feature3`)
 VALUES ('$title','$description','$price','$feature1','$feature2','$feature3')");
}
//  header("Location:membership.php");
//  exit();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Membership</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;

    background:
    linear-gradient(rgba(0,0,0,.55),
    rgba(0,0,0,.55)),
    url('../assets/image/il_fullxfull.6188745219_riqb.webp');

    background-size:cover;
    background-position:center;
}

.card-box{
    width:100%;
    max-width:500px;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(10px);

    border:1px solid rgba(255,255,255,.2);

    border-radius:20px;

    padding:25px;

    box-shadow:0 8px 28px rgba(0,0,0,.3);
}

.title{
    text-align:center;
    color:#fff;
    font-size:28px;
    font-weight:700;
}

.small-text{
    text-align:center;
    color:#eee;
    margin-bottom:20px;
}

.form-label{
    color:#fff;
    font-weight:500;
}

.custom-input{
    width:100%;
    height:45px;

    border:none;
    outline:none;

    border-radius:12px;

    padding:10px 15px;

    background:rgba(255,255,255,.95);
}

.custom-input:focus{
    box-shadow:0 0 8px rgba(255,145,77,.6);
}

.btn-submit{
    width:100%;

    border:none;

    background: linear-gradient(45deg, #ff914d, #ba6a4a);

    color:#fff;

    padding:12px;

    border-radius:12px;

    font-weight:600;

    margin-top:10px;
}

.btn-submit:hover{
    transform:translateY(-2px);
}

</style>
</head>

<body>

<div class="card-box">

    <div class="title">
        Add Membership
    </div>

    <div class="small-text">
        Create a new membership plan
    </div>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Plan Name</label>
            <input type="text"
                   name="title"
                   class="custom-input"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text"
                   name="description"
                   class="custom-input"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number"
                   name="price"
                   class="custom-input"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Feature 1</label>
            <input type="text"
                   name="feature1"
                   class="custom-input"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Feature 2</label>
            <input type="text"
                   name="feature2"
                   class="custom-input"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Feature 3</label>
            <input type="text"
                   name="feature3"
                   class="custom-input"
                   required>
        </div>

        <button type="submit"
                name="add_membership"
                class="btn-submit">

            Save Membership

        </button>

    </form>

</div>

</body>
</html>



<!-- <form method="POST" class="card p-4 mb-4">

    <input type="text" name="title"
        class="form-control mb-3"
        placeholder="Plan Name" required>

    <input type="text" name="description"
        class="form-control mb-3"
        placeholder="Description" required>

    <input type="number" name="price"
        class="form-control mb-3"
        placeholder="Price" required>

    <input type="text" name="feature1"
        class="form-control mb-3"
        placeholder="Feature 1" required>

    <input type="text" name="feature2"
        class="form-control mb-3"
        placeholder="Feature 2" required>

    <input type="text" name="feature3"
        class="form-control mb-3"
        placeholder="Feature 3" required>

    <button type="submit"
        name="add_membership"
        class="btn btn-success">
        Add Membership
    </button>

</form> -->
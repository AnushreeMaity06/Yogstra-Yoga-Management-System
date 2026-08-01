<?php
global $conn;
include('../db_connect.php');
session_start();

// 🔴 SAFE ID CHECK
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$user_id){
    die("Invalid User ID");
}

// 🔴 SECURE QUERY (SQL Injection fix)
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if(!$data){
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User</title>

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
            linear-gradient(rgba(0,0,0,0.55),
            rgba(0,0,0,0.55)),
            url('../assets/image/25770324-magnifique-fille-faire-yoga-dans-lever-du-soleil-illustration-vectoriel.jpg');
            background-size:cover;
            background-position:center;
        }

        .card-box{
            width:100%;
            max-width:420px;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,0.2);
            padding:22px;
            border-radius:20px;
            box-shadow:0 8px 28px rgba(0,0,0,0.3);
        }

        .title{
            text-align:center;
            font-size:26px;
            font-weight:700;
            color:#fff;
            margin-bottom:5px;
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
            margin-bottom:6px;
        }

        .custom-input{
            width:100%;
            height:42px;
            border:none;
            outline:none;
            border-radius:12px;
            background:rgba(255,255,255,0.95);
            padding:8px 12px;
            font-size:14px;
        }

        .preview-img{
            width:100px;
            height:100px;
            object-fit:cover;
            border-radius:12px;
            margin-top:10px;
            border:3px solid #fff;
            display:block;
        }

        .btn-submit{
            width:100%;
            border:none;
            background:linear-gradient(45deg,#ff7b54,#ff416c);
            color:#fff;
            padding:11px;
            border-radius:12px;
            font-size:15px;
            font-weight:600;
            margin-top:10px;
        }

    </style>

</head>

<body>

<div class="card-box">

    <div class="title">Edit User</div>
    <div class="small-text">Update user details easily</div>

    <form action="update_action.php" method="POST" enctype="multipart/form-data">

        <!-- ID -->
        <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">

        <!-- NAME -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="custom-input"
                value="<?php echo htmlspecialchars($data['name']); ?>" required>
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="custom-input"
                value="<?php echo htmlspecialchars($data['email']); ?>" required>
        </div>

        <!-- GENDER -->
        <div class="mb-3">
            <label class="form-label">Gender</label>

            <select name="gender" class="custom-input">

                <option value="male" <?php if($data['gender']=="male") echo "selected"; ?>>Male</option>
                <option value="female" <?php if($data['gender']=="female") echo "selected"; ?>>Female</option>
                <option value="other" <?php if($data['gender']=="other") echo "selected"; ?>>Other</option>

            </select>

        </div>

        <!-- IMAGE -->
        <div class="mb-3">

            <label class="form-label">Upload Image</label>

            <input type="hidden" name="old_image" value="<?php echo $data['image']; ?>">

            <input type="file" name="image" id="image" class="form-control" accept="image/*">

            
                 <img src="../<?php echo htmlspecialchars($data['image']); ?>"
     id="imgpreview"
     class="preview-img">

        </div>

        <!-- BUTTON -->
        <button type="submit" name="edit_btn" class="btn-submit">
            Update User
        </button>

    </form>

</div>

<script>

const fileinput = document.getElementById('image');
const imgpreview = document.getElementById('imgpreview');

fileinput.addEventListener("change", function () {

    const file = this.files[0];

    if (file && file.type.startsWith('image/')) {

        const reader = new FileReader();

        reader.onload = function () {
            imgpreview.src = reader.result;
        };

        reader.readAsDataURL(file);

    } else {
        alert("Please select an image file");
    }

});

</script>

</body>
</html>
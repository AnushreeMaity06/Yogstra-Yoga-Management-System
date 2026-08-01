<?php
global $conn;
include('../db_connect.php');
session_start();


// If not logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}


// takes the data from database using email
$user_email = $_SESSION['user_email'];

$sql = "SELECT * FROM users WHERE email='$user_email'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);


// UPDATE update button er name ['update'] diye jeta lekha a6e=====================\
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $ph_no = $_POST['ph_no'];
    $address = $_POST['address'];


    // for IMAGE==================

    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];


    $old_image = $row['image'];


    // IF NEW IMAGE SELECTED==============
    if (!empty($image_name)) {
        $old_image = time() . '_' . $image_name;

        move_uploaded_file(
            $tmp_name,
            "../images/" . $old_image
        );
    }


    $update = "UPDATE `users` SET

    name='$name',
    ph_no='$ph_no',
    address='$address',
    image='$old_image'

    WHERE email='$user_email'";

    mysqli_query($conn, $update);
    $_SESSION['user_name'] = $name;


    header("Location:miniprofile.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background:
                linear-gradient(rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)),
                url('../assets/image/yoga1.jpg');

            background-size: cover;
            background-position: center;
            padding: 20px;
        }

        .profile-card {
            width: 100%;
            max-width: 450px;

            background: rgba(255, 255, 255, 0.12);

            border: 1px solid rgba(255, 255, 255, 0.2);

            backdrop-filter: blur(14px);

            border-radius: 25px;

            padding: 35px;

            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);

            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-card h2 {
            text-align: center;
            color: white;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .profile-card h2 i {
            color: #ff914d;
            margin-right: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff914d;
            font-size: 16px;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 14px 14px 45px;

            border: none;
            outline: none;

            border-radius: 14px;

            background: rgba(255, 255, 255, 0.95);

            font-size: 15px;

            transition: 0.3s ease;
        }

        .input-group-custom input:focus {
            transform: scale(1.02);

            box-shadow: 0 0 12px rgba(255, 145, 77, 0.6);
        }

        .update-btn {
            width: 100%;

            border: none;

            padding: 14px;

            border-radius: 15px;

            background:
                linear-gradient(45deg,
                    #ff914d,
                    #ff5e62);

            color: white;

            font-size: 18px;
            font-weight: 600;

            transition: 0.3s ease;
        }

        .update-btn:hover {
            transform: translateY(-3px);

            box-shadow: 0 8px 20px rgba(255, 94, 98, 0.5);
        }
    </style>

</head>

<body>

    <div class="profile-card">

        <h2>
            <i class="fa-solid fa-user-pen"></i>
            Edit Profile
        </h2>

        <form method="POST" enctype="multipart/form-data">

            <!-- NAME -->
            <div class="input-group-custom">
                <i class="fa-solid fa-user"></i>

                <input type="text"
                    name="name"
                    value="<?php echo $row['name']; ?>"
                    placeholder="Enter your name">
            </div>

            <!-- PHONE -->
            <div class="input-group-custom">
                <i class="fa-solid fa-phone"></i>

                <input type="text"
                    name="ph_no"
                    value="<?php echo $row['ph_no']; ?>"
                    placeholder="Enter phone number">
            </div>

            <!-- ADDRESS -->
            <div class="input-group-custom">
                <i class="fa-solid fa-location-dot"></i>

                <input type="text"
                    name="address"
                    value="<?php echo $row['address']; ?>"
                    placeholder="Enter address">
              
            </div>

            <!-- OLD IMAGE -->
            <img src="../images/<?php echo $row['image']; ?>"
                width="120" id="previewImage">

            <br><br>

            <!-- NEW IMAGE -->
            <input type="file" name="image" onchange="previewFile(this)">

            <br><br>

            <!-- BUTTON -->
            <button name="update" class="update-btn">
                Update Profile
            </button>

        </form>

    </div>

    <script type="text/javascript">


function previewFile(input){

    // selected file
    let file = input.files[0];

    // old image tag
    let preview = document.getElementById('previewImage');

    // file reader
    let reader = new FileReader();

    reader.onload = function(e){

        // replace old image with new selected image
        preview.src = e.target.result;
    }

    // read file
    reader.readAsDataURL(file);
}


    </script>

</body>

</html>
<?php
global $conn;
include('db_connect.php');

if (!isset($_GET['email'])) {
    header("Location: signup.php");
    exit();
}

$email = $_GET['email'];

if (isset($_POST['verify'])) {

    $otp = $_POST['otp'];

    $check = "SELECT * FROM users
              WHERE email='$email'
              AND otp='$otp'";

    $run = mysqli_query($conn, $check);

    if (mysqli_num_rows($run) > 0) {

        $update = "UPDATE users
                   SET is_verified=1,
                       otp=NULL
                   WHERE email='$email'";

        mysqli_query($conn, $update);

        echo "
        <script>
            alert('Email verified successfully');
            window.location.href='login.php';
        </script>";
    }
    else {

        echo "
        <script>
            alert('Invalid OTP');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OTP Verification</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
               url('assets/image/yoga1.jpg');
    background-size:cover;
    background-position:center;
    padding:20px;
}

/* Card */
.verify-card{
    width:100%;
    max-width:420px;
    background:rgba(255,255,255,0.12);
    border:1px solid rgba(255,255,255,0.2);
    backdrop-filter:blur(14px);
    border-radius:25px;
    padding:35px;
    box-shadow:0 10px 40px rgba(0,0,0,0.4);
}

/* Title */
.verify-card h2{
    text-align:center;
    color:white;
    font-weight:700;
    margin-bottom:10px;
}

.verify-card p{
    text-align:center;
    color:#ddd;
    margin-bottom:25px;
    font-size:14px;
}

/* Input */
.input-group-custom{
    position:relative;
    margin-bottom:20px;
}

.input-group-custom i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#ff914d;
}

.input-group-custom input{
    width:100%;
    padding:14px 14px 14px 45px;
    border:none;
    outline:none;
    border-radius:14px;
}

/* Button */
.verify-btn{
    width:100%;
    border:none;
    padding:14px;
    border-radius:15px;
    background:linear-gradient(45deg,#ff914d,#ba6a4a);
    color:white;
    font-size:18px;
    font-weight:600;
    transition:0.3s;
}

.verify-btn:hover{
    transform:translateY(-2px);
}

/* Extra text */
.extra{
    text-align:center;
    margin-top:15px;
    color:white;
    font-size:14px;
}

.extra a{
    color:#ff914d;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>

<body>

<div class="verify-card">

    <h2>
        <i class="fa-solid fa-shield-halved"></i>
        Verify Email
    </h2>

    <p>Enter the 6-digit OTP sent to your email</p>

    <form method="POST">

        <div class="input-group-custom">
            <i class="fa-solid fa-key"></i>
            <input
                type="text"
                name="otp"
                placeholder="Enter 6 digit OTP"
                maxlength="6"
                required>
        </div>

        <button type="submit" name="verify" class="verify-btn">
            Verify OTP
        </button>

    </form>

    <div class="extra">
        Back to <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>
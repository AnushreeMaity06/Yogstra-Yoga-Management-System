<?php
global $conn;
include 'db_connect.php';
session_start();

// If not logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];

// SAFE QUERY
$sql = "SELECT * FROM users WHERE email='$user_email'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

// If user not found
if (!$row) {
    echo "<h3 style='text-align:center;margin-top:50px;color:red;'>User data not found</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Modern Profile</title>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:
    linear-gradient(135deg,#fff5f0,#f3f7ff);
    overflow-x:hidden;
}

/* SIDEBAR */


/* MAIN */
.main-content{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

/* PROFILE CARD */
.profile-card{
    width:100%;
    max-width:950px;

    border:none;
    border-radius:35px;

    overflow:hidden;

    position:relative;

    background:#fff;

    box-shadow:
    0 20px 50px rgba(0,0,0,0.08);
}

/* TOP SHAPE */
.profile-card::before{
    content:'';
    position:absolute;
    top:-120px;
    right:-120px;

    width:300px;
    height:300px;

    background:
    linear-gradient(135deg,#ff914d,#ff5e62);

    border-radius:50%;

    opacity:.12;
    pointer-events:none;
}

/* LEFT SIDE */
.profile-left{
    background:
    linear-gradient(135deg,#ff914d,#ff5e62);

    padding:45px 25px;
    text-align:center;
    color:#fff;

    position:relative;
}

/* GLOW */
.profile-left::before{
    content:'';
    position:absolute;
    top:20px;
    left:20px;

    width:120px;
    height:120px;

    background:rgba(255,255,255,0.15);

    border-radius:50%;
}

/* IMAGE */
.profile-img{
    width:180px;
    height:180px;

    border-radius:30px;

    object-fit:cover;

    border:5px solid rgba(255,255,255,0.9);

    box-shadow:
    0 15px 35px rgba(0,0,0,0.25);

    transition:.4s;

    position:relative;
    z-index:2;
}

.profile-img:hover{
    transform:scale(1.04) rotate(-2deg);
}

/* USER NAME */
.welcome{
    margin-top:25px;
    font-size:30px;
    font-weight:700;
    position:relative;
    z-index:2;
}

/* SUB */
.subtitle{
    margin-top:8px;
    font-size:15px;
    opacity:.95;
    position:relative;
    z-index:2;
}

/* MEMBER BADGE */
.member-badge{
    display:inline-block;
    margin-top:20px;

    padding:10px 22px;

    border-radius:50px;

    background:rgba(255,255,255,0.18);

    backdrop-filter:blur(8px);

    border:1px solid rgba(255,255,255,0.25);

    font-size:14px;
    font-weight:600;

    position:relative;
    z-index:2;
}

/* RIGHT SIDE */
.profile-right{
    padding:45px 35px;
    background:#fff;
}

/* HEADER */
.profile-header{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:30px;
     position:relative;
    z-index:5;
}

.profile-title{
    font-size:30px;
    font-weight:700;
    color:#222;
}

/* EDIT BUTTON */
.edit-btn{
    border:none;

    background:
    linear-gradient(45deg,#ff914d,#ff5e62);

    color:#fff;

    padding:10px 22px;

    border-radius:14px;

    font-size:14px;
    font-weight:600;

    transition:.3s;

    text-decoration:none;   /* ADD */
    display:inline-block;   /* ADD */
    position:relative;
    z-index:10;
}

.edit-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(255,94,98,0.25);
}

/* INFO BOX */
.info-box{
    display:flex;
    align-items:center;
    gap:18px;

    padding:18px;

    border-radius:20px;

    background:#f8f9ff;

    margin-bottom:18px;

    transition:.35s;

    border:1px solid transparent;
}

.info-box:hover{
    transform:translateY(-4px);
    background:#fff;

    border-color:#ffe2d5;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.06);
}

/* ICON */
.info-icon{
    width:58px;
    height:58px;

    min-width:58px;

    display:flex;
    justify-content:center;
    align-items:center;

    border-radius:18px;

    background:
    linear-gradient(135deg,#ff914d,#ff5e62);

    color:#fff;

    font-size:22px;

    box-shadow:
    0 8px 18px rgba(255,94,98,0.25);
}

/* INFO TEXT */
.info-text small{
    display:block;

    color:#888;

    margin-bottom:4px;

    font-size:12px;
}

.info-text span{
    color:#222;

    font-size:16px;
    font-weight:600;
}

/* STATS */
.stats{
    margin-top:30px;

    display:grid;
    grid-template-columns:repeat(3,1fr);

    gap:15px;
}

.stat-card{
    background:#fff7f3;

    border-radius:20px;

    padding:18px;

    text-align:center;

    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,0.05);
}

.stat-card h4{
    font-size:24px;
    color:#ff5e62;
    font-weight:700;
}

.stat-card p{
    margin-top:5px;
    font-size:13px;
    color:#777;
}

/* MOBILE */
@media(max-width:768px){

    .main-content{
        padding:15px;
    }

    .profile-right{
        padding:30px 20px;
    }

    .profile-header{
        flex-direction:column;
        gap:15px;
        align-items:flex-start;
    }

    .welcome{
        font-size:25px;
    }

    .profile-title{
        font-size:26px;
    }

    .profile-img{
        width:150px;
        height:150px;
    }

    .stats{
        grid-template-columns:1fr;
    }

}

</style>
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 left p-0">
            <?php include 'sidebar.php'; ?>
        </div>


         <!-- MAIN CONTENT -->
        <div class="col-md-10 main-content">

            <div class="profile-card">

                <div class="row g-0 align-items-center">

                    <!-- LEFT -->
                    <div class="col-md-4 profile-left">

                        <img src="image/<?php echo $row['image'] ?? 'default.png'; ?>" class="profile-img">
           
                        <h2 class="welcome">
                            <?php echo $_SESSION['user_name']; ?>
                        </h2>

                        <p class="subtitle">
                            Yoga Enthusiast 🧘‍♀️
                        </p>

                        <div class="member-badge">
                            <i class="fa-solid fa-crown"></i>
                            Active Teacher
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-md-8 profile-right">

                        <div class="profile-header">

                            <h2 class="profile-title">
                                My Profile
                            </h2>

                           <a href="edit_profile.php" class="edit-btn text-decoration-none">
    <i class="fa-solid fa-pen"></i>
    Edit Profile
</a>

                        </div>

                        <!-- EMAIL -->
                        <div class="info-box">

                            <div class="info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>

                            <div class="info-text">
                                <small>Email Address</small>

                                <span>
                                    <?php echo $_SESSION['user_email']; ?>
                                </span>
                            </div>

                        </div>

                        <!-- GENDER -->
                        <div class="info-box">

                            <div class="info-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div class="info-text">
                                <small>Gender</small>

                                <span>
                                    <?php echo $_SESSION['user_gen'] ?? 'Not Set'; ?>
                                </span>
                            </div>

                        </div>

                        <!-- PHONE -->
                        <div class="info-box">

                            <div class="info-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>

                            <div class="info-text">
                                <small>Phone Number</small>

                                <span>
                                    <?php echo $row['ph_no'] ?? 'Not Available'; ?>
                                </span>
                            </div>

                        </div>

                        <!-- ADDRESS -->
                        <div class="info-box">

                            <div class="info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div class="info-text">
                                <small>Address</small>

                                <span>
                                    <?php echo $row['address'] ?? 'Not Available'; ?>
                                </span>
                            </div>

                        </div>

                        <!-- STATS -->
                        
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
global $conn;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('../db_connect.php');

$result = $conn->query("SELECT * FROM classes WHERE status='Active'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Available Classes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>

/* BODY */
body{
    background:#f57847;
    margin:0;
}



/* MAIN */
.main-content{
    background:#ffffff;
    min-height:100vh;
    border-radius:10px;
}

/* CARD */
.class-card{
    border:none;
    border-radius:15px;
    transition:0.3s;
    background:white;
    width:100%;
}

.class-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* BUTTON */
.theme-btn{
    background:#f57847;
    border:none;
    color:white;
}

.theme-btn:hover{
    background:#e06635;
}

/* BADGE */
.level-badge{
    background:#f57847;
    color:white;
    padding:4px 10px;
    border-radius:10px;
    font-size:12px;
}

</style>

</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR ADDED HERE -->
        <div class=" col-md-2 left p-0">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-12 col-md-10 p-4 main-content">

            <h2 class="mb-4 fw-bold" style="color:#f57847;">
                🧘 Available Classes
            </h2>

            <div class="row g-4">

                <?php while($row = $result->fetch_assoc()) { ?>

                <div class="col-12 col-sm-6 col-lg-4">

                    <div class="card class-card shadow-sm p-3">

                        <h5 style="color:#f57847;" class="fw-bold">
                            <?php echo $row['name']; ?>
                        </h5>

                        <p class="mb-1">
                            👨‍🏫 <b><?php echo $row['instructor']; ?></b>
                        </p>

                        <p class="mt-2">
                            Level:
                            <span class="level-badge">
                                <?php echo $row['level']; ?>
                            </span>
                        </p>

                        <a href="book.php?class_id=<?php echo $row['id']; ?>"
                           class="btn theme-btn w-100 mt-3" style="border:2px solid #f57847;color:#f57847;font-weight:700;">
                           📌 Book Now
                        </a>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>

    </div>
</div>

</body>
</html>
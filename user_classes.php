<?php
session_start();
global $conn;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('db_connect.php');

$sql = "SELECT * FROM classes WHERE status='Active'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Available Classes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>
body{
    background:#ba6a4a;
    overflow-x:hidden;
}

.classes-section{
    padding:60px 15px;
}

.section-title{
    text-align:center;
    margin-bottom:40px;
    color:#fff;
}

.section-title h1{
    font-size:42px;
    font-weight:700;
}

.section-title p{
    font-size:16px;
    max-width:700px;
    margin:auto;
}

.class-card{
    background:#fff;
    border-radius:20px;
    padding:20px;
    height:100%;
    transition:0.3s;
}

.class-card:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.icon-box{
    width:60px;
    height:60px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(45deg,#ba6a4a,#9f5b40);
    color:#fff;
    font-size:22px;
    margin-bottom:15px;
    animation:float 3s ease-in-out infinite;
}

@keyframes float{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-8px);}
}

.class-title{
    font-size:24px;
    font-weight:700;
    color:#222;
}

.class-info{
    font-size:14px;
    color:#444;
    line-height:1.6;
}

.level-badge{
    background:#ba6a4a;
    color:#fff;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
}

.book-btn{
    display:inline-block;
    margin-top:15px;
    color:#ba6a4a;
    font-weight:700;
    text-decoration:none;
    font-size:16px;
}

@media(max-width:768px){
    .section-title h1{font-size:30px;}
}
</style>
</head>

<body>

<?php include('navbar.php'); ?>

<section class="classes-section">

    <div class="section-title">
        <h1>Curated Practices</h1>
        <p>Explore our signature yoga styles designed for every level of your journey.</p>
    </div>

    <div class="container">
        <div class="row g-4">

        <?php if ($result && $result->num_rows > 0): ?>

            <?php while($row = $result->fetch_assoc()): ?>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <div class="class-card">

                    <div class="icon-box">
                        <i class="fa-solid fa-leaf"></i>
                    </div>

                    <h2 class="class-title">
                        <?= htmlspecialchars($row['name']) ?>
                    </h2>

                    <div class="class-info">
                        <p>
                            👨‍🏫 Instructor:
                            <b><?= htmlspecialchars($row['instructor']) ?></b>
                        </p>

                        <p>
                            Level:
                            <span class="level-badge">
                                <?= htmlspecialchars($row['level']) ?>
                            </span>
                        </p>
                    </div>

                    <a href="./view_classdetails.php?id=<?= $row['id'] ?>"
                       class="book-btn">
                        View Details →
                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="col-12 text-center text-white">
                <h4>No active classes available</h4>
            </div>

        <?php endif; ?>

        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
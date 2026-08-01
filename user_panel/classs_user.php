<?php
global $conn;
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit;
}

include('db_connect.php');

$result = $conn->query("SELECT * FROM classes WHERE status='Active'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Available Classes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f57847;
    font-family:Arial, sans-serif;
    overflow-x:hidden;
}

/* SECTION */

  
  /* SECTION */
.classes-section{
    padding:50px 15px;
}

/* TITLE */
.section-title{
    text-align:center;
    margin-bottom:40px;
}

.section-title h1{
    font-size:42px;
    font-weight:700;
    margin-bottom:8px;
}

.section-title p{
    font-size:16px;
    max-width:700px;
    margin:auto;
}

/* CARD */
.class-card{
    background:#f3f3f3;
    border-radius:22px;
    padding:20px;
    transition:0.3s;
    height:100%;
}

.class-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,0.12);
}

/* ICON */
.icon-box{
    width:58px;
    height:58px;
    border:2px solid #f57847;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
    background:#fff;
}

.icon-box i{
    font-size:24px;
    color:#f57847;
}

/* TITLE */
.class-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:10px;
    font-family:Georgia, serif;
    color:#1d1d1d;
}

/* INFO */
.class-info{
    font-size:15px;
    line-height:1.7;
    color:#333;
}

/* BADGE */
.level-badge{
    background:#f57847;
    color:white;
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
}

/* BUTTON */
.book-btn{
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-top:18px;
    text-decoration:none;
    color:#f57847;
    font-size:20px;
    font-weight:700;
}

/* TABLET */
@media(max-width:992px){

    .class-title{
        font-size:24px;
    }

    .class-info{
        font-size:14px;
    }
}

/* MOBILE */
@media(max-width:576px){

    .classes-section{
        padding:35px 12px;
    }

    .section-title h1{
        font-size:30px;
    }

    .section-title p{
        font-size:14px;
    }

    .class-card{
        padding:18px;
    }

    .class-title{
        font-size:22px;
    }

    .class-info{
        font-size:13px;
    }

    .book-btn{
        font-size:17px;
    }

    .icon-box{
        width:52px;
        height:52px;
    }

    .icon-box i{
        font-size:20px;
    }
}

</style>

</head>

<body>
     <!--  -->



 <?php include('navbar.php'); ?>
<section class="classes-section">

    <!-- TITLE -->
    <div class="section-title">

        <h1>Curated Practices</h1>

        <p>
            Explore our signature yoga styles designed to meet you exactly
            where you are on your path.
        </p>

    </div>

    <div class="container-fluid">

        <div class="row g-4">

            <?php while($row = $result->fetch_assoc()) { ?>

            <div class="col-12 col-md-3 ">

                <div class="class-card">

                    <!-- ICON -->
                    <div class="icon-box">
                        <i class="fa-solid fa-leaf"></i>
                    </div>

                    <!-- CLASS TITLE -->
                    <h2 class="class-title">
                        <?php echo $row['name']; ?>
                    </h2>

                    <!-- INFO -->
                    <div class="class-info">

                        <p>
                            👨‍🏫 Instructor:
                            <b><?php echo $row['instructor']; ?></b>
                        </p>

                        <p class="mt-3 mb-1">
                            Level:<span class="level-badge"><?php echo $row['level'];?> </span>
                        </p>

                       

                    </div>

                    <!-- BUTTON -->
                    <a href="./user_panel/book.php?class_id=<?php echo $row['id']; ?>"
                       class="book-btn">

                        Book Now →
                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>

</body>
</html>
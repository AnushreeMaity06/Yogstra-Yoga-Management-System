<?php
global $conn;
include('db_connect.php');

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM blogs WHERE id='$id'");
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* body {
            background: #f5efeb;
            font-family: 'Poppins', sans-serif;
        } */

        .back-btn {
            background: #ba6a4a;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: .3s;
        }

        .back-btn:hover {
            background: #9f593d;
            color: white;
        }

        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding: 35px;

        }

        .blog-card {

            border-radius: 25px;
            overflow: visible;
            
            background-color: transparent;
        }



        .sticky-image {
            position: sticky;
            top: 20px;
            z-index: 1;
        }

        .blog-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 25px 25px 0 0;
        }

        .blog-content {
           background: white;
    margin-top: -40px;
    position: relative;
    z-index: 2;
    border-radius: 30px;
    padding: 40px 50px;
    box-shadow: 0 10px 35px rgba(0,0,0,.1);
        }



        .blog-category {
            color: #ba6a4a;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .blog-title {
            font-size: 30px;
            font-weight: 700;
            color: #2d2522;
            margin-top: 15px;
        }

        .blog-info {
            color: #777;
            font-size: 15px;
        }

        .blog-desc {
            color: #555;
            font-size: 16px;
            line-height: 1.9;
            text-align: justify;
        }

        @media(max-width:768px) {

            .blog-image {
                height: 280px;
            }

            .blog-content {
                padding: 25px;
            }

            .blog-title {
                font-size: 28px;
            }

            .blog-desc {
                font-size: 16px;
                line-height: 1.8;
            }
        }

        @media(max-width:576px) {

            .blog-image {
                height: 220px;
            }

            .blog-title {
                font-size: 24px;
            }

            .blog-content {
                padding: 20px;
            }
        }

        @media(max-width:991px) {

            .sticky-image {
                position: static;
            }

            .blog-image {
                height: 300px;
            }

        }
    </style>

</head>


<body style="background-color:#ba6a4a;">
            <!-- navbar -->
           <?php include('navbar.php'); ?>

    <div class="container-fluid">
        <div class="row">


            <!-- Main Content -->
            <div class="col-md-12 py-2 px-2">

                <!-- White Card -->
                <div class="main-card">

                    <a href="index.php" class="back-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Blogs
                    </a>

                    <!-- Journal Card -->
                    <div class="blog-card mt-4">

                        <div class="row">

                            <!-- Image -->
                           <div class="blog-card mt-4">

    <!-- Sticky Image -->
    <div class=" sticky-image">
        <img src="uploads/blog_image/<?php echo $row['image']; ?>"
            class="blog-image">
    </div>

    <!-- Content Card -->
    <div class="blog-content">

        <div class="blog-category">
            <?php echo $row['category']; ?>
            •
            <?php echo $row['read_time']; ?>
        </div>

        <h1 class="blog-title">
            <?php echo $row['title']; ?>
        </h1>

        <div class="blog-info mb-4">
            <i class="fa-regular fa-calendar"></i>
            <?php echo $row['created_at']; ?>
        </div>

        <hr>

        <div class="blog-desc">
            <?php echo nl2br($row['description']); ?>
        </div>

    </div>

</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</body>




</html>
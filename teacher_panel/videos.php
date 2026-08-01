<?php
include('../db_connect.php');

global $conn;

$sql = "SELECT * FROM videos ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Video Classes</title>

    <!-- Bootstrap -->

    <link href="../assets/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->

    <link rel="stylesheet"
        href="../assets/bootstrap/css/bootstrap.min.css">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: 'Poppins', sans-serif;
        }

       
        .page-title{
      font-size:30px;
      font-weight:bold;
      color:#f57847;
    }

    .add-btn{
      background:#f57847;
      color:white;
      border:none;
      padding:10px 18px;
      border-radius:10px;
      transition:0.3s;
      text-decoration:none;
      font-weight:600;
    }

    .add-btn:hover{
      background:#e56735;
      color:white;
      transform:translateY(-2px);
    }


        .video-card {

            background: white;

            border-radius: 18px;

            overflow: hidden;

            transition: 0.4s;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);

            height: 100%;
            width: 100%;
        }
        .video-item{
    flex:0 0 350px;          /* প্রতিটি card-এর width */
}


        .video-card:hover {

            transform: translateY(-6px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .thumbnail-box {

            position: relative;

            overflow: hidden;
        }

        .thumbnail-box img {

            width: 100%;

            height: 220px;

            object-fit: cover;

            transition: 0.4s;
        }

        .video-card:hover img {

            transform: scale(1.05);
        }

        .play-icon {

            position: absolute;

            top: 50%;

            left: 50%;

            transform: translate(-50%, -50%);

            width: 70px;

            height: 70px;

            background: rgba(255, 255, 255, 0.85);

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            color: #ff4b5c;
        }

        .card-body {

            padding: 18px;
        }

        .video-title {

            font-size: 20px;

            font-weight: 600;

            margin-bottom: 10px;

            color: #222;
        }

        .category {

            font-size: 14px;

            color: #777;

            margin-bottom: 15px;
        }

        .watch-btn {

            display: inline-block;

            text-decoration: none;

            background: #ff4b5c;

            color: white;

            padding: 10px 18px;

            border-radius: 10px;

            transition: 0.3s;
        }

        .watch-btn:hover {

            background: #e63b4c;
        }

        .video-scroll{
    display: flex;
    gap: 20px;
    overflow-x: auto;
    overflow-y: hidden;
    padding: 20px 0;
    scroll-behavior: smooth;
    flex-wrap: nowrap;       /* নিচে যেতে দেবে না */
    overflow-x:auto; 
}

.video-scroll::-webkit-scrollbar{
    height: 8px;
}

.video-scroll::-webkit-scrollbar-thumb{
    background: #f57847;
    border-radius: 10px;
}

.video-scroll::-webkit-scrollbar-track{
    background: #ddd;
}

.video-item{
    min-width: 350px;
    flex-shrink: 0;
}
    </style>

</head>

<body style="background-color:#ba6a4a;">

    <div class="container-fluid ">

        <div class="row">


            <!-- Sidebar -->
            <div class="col-md-2 left pt-3" style="background:#e9eaee;">
                <?php include('sidebar.php'); ?>
            </div>


            <div class="col-md-10 ">

                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h1 class="page-title">
                        🎬 Video Classes
                    </h1>

                    <a href="../admin/add_video.php" class="add-btn">
                        <i class="fa fa-plus"></i> Add Videos
                    </a>
                </div>

                <div class="video-scroll">

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                        <div class="video-item">

                            <div class="video-card">

                                <div class="thumbnail-box">

                                    <img src="../uploads/thumbnails/<?php echo $row['thumbnail']; ?>">

                                    <div class="play-icon">

                                        <i class="fa-solid fa-play"></i>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <div class="video-title">

                                        <?php echo $row['title']; ?>

                                    </div>

                                    <div class="category">

                                        Category :
                                        <?php echo $row['category']; ?>

                                    </div>

                                    <a href="single-video.php?id=<?php echo $row['id']; ?>"
                                        class="watch-btn">

                                        Watch Now

                                    </a>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
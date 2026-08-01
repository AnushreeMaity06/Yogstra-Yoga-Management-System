<?php
include('../db_connect.php');

global $conn;

$active = 'video_classes';

/* Total Videos */
$count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM videos");
$count_row = mysqli_fetch_assoc($count_query);
$total_videos = $count_row['total'];

/* Videos */
$sql = "SELECT * FROM videos ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Video Classes</title>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {

            background: #ba6a4a;

            font-family: 'Poppins', sans-serif;
        }

        .main-card {
            background: #f4f4f4;
            border-radius: 35px;
            padding: 20px;
        }

        /* Header */

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            color: #ba6a4a;
            margin: 0;
        }

        .add-btn {
            background: #ba6a4a;
            color: white;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: 600;
            transition: .3s;
        }

        .add-btn:hover {
            color: white;
            background: #a85c3d;
        }

        /* Small Stats Card */

        .stats-card {
            width: 180px;
            background: white;
            border-radius: 18px;
            padding: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .stats-card h3 {
            margin: 0;
            color: #ba6a4a;
            font-size: 30px;
            font-weight: 700;
        }

        .stats-card span {
            color: #777;
            font-size: 13px;
        }

        /* Video Card */

        .video-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            height: 100%;
            transition: .3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .12);
        }

        .thumbnail-box {
            position: relative;
            overflow: hidden;
        }

        .thumbnail-box img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            transition: .4s;
        }

        .video-card:hover img {
            transform: scale(1.05);
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 55px;
            height: 55px;
            background: rgba(255, 255, 255, .95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ba6a4a;
            font-size: 20px;
        }

        .card-body {
            padding: 14px;
        }

        .video-title {
            font-size: 16px;
            font-weight: 600;
            color: #222;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .category-badge {
            display: inline-block;
            background: #fdf1eb;
            color: #ba6a4a;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .watch-btn {
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            background: #ba6a4a;
            color: white;
            padding: 9px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: .3s;
        }

        .watch-btn:hover {
            color: white;
            background: #a85c3d;
        }

        .button-group {
            display: flex;
            gap: 8px;
        }

        .watch-btn {
            flex: 1;
            text-align: center;
            text-decoration: none;
            background: #ba6a4a;
            color: white;
            padding: 9px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .delete-btn {
            width: 45px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: #dc3545;
            color: white;
            border-radius: 10px;
            font-size: 14px;
        }

        .delete-btn:hover {
            color: white;
            background: #bb2d3b;
        }

        @media(max-width:768px) {

            .page-title {
                font-size: 28px;
            }

            .top-header {
                gap: 15px;
            }

            .add-btn {
                width: 100%;
                text-align: center;
            }

            .stats-card {
                width: 100%;
            }

            .thumbnail-box img {
                height: 180px;
            }
        }
    </style>

</head>

<body style="background-color:#ba6a4a;">

    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->

            <div class="col-md-2 ">
                <?php include('sidebar.php'); ?>
            </div>

            <!-- Content -->

            <div class="col-lg-10 col-md-9 p-4">

                <!-- Header -->
                <div class="main-card">
                    <div class="top-header">

                        <h1 class="page-title">
                            <i class="fa-solid fa-circle-play"></i>
                            Video Classes
                        </h1>

                        <!-- <a href="add_video.php" class="add-btn">
                            <i class="fa-solid fa-plus"></i>
                            Add Video
                        </a> -->

                    </div>

                    <!-- Small Total Card -->

                   <div class="row g-3 mt-2">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Total Videos</h6>
                         <h3><?php echo $total_videos; ?></h3>
                        <small class="text-success">+12%</small>
                    </div>
                </div>

                    <!-- Video Grid -->

                    <div class="row g-3">

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <div class="col-xl-3 col-lg-4 col-md-6">

                                <div class="video-card">

                                    <div class="thumbnail-box">

                                        <img src="../uploads/thumbnails/<?php echo $row['thumbnail']; ?>"
                                            alt="Thumbnail">

                                        <div class="play-icon">
                                            <i class="fa-solid fa-play"></i>
                                        </div>

                                    </div>

                                    <div class="card-body">

                                        <div class="video-title">
                                            <?php echo htmlspecialchars($row['title']); ?>
                                        </div>

                                        <div class="category-badge">
                                            <?php echo htmlspecialchars($row['category']); ?>
                                        </div>

                                        <div class="button-group">

                                            <a href="single_videos.php?id=<?php echo $row['id']; ?>"
                                                class="watch-btn">
                                                Watch Video
                                            </a>

                                            <a href="delete_video.php?delete_btn=class&id=<?php echo $row['id']; ?>"
                                                onclick="return confirm('Are you sure to delete this video?');"
                                                class="delete-btn">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </div>


                                    </div>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                </div>
</div>

            </div>

        </div>

</body>

</html>
```
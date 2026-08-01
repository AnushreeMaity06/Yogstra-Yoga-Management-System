
<?php

include('../db_connect.php');

global $conn;

$id = $_GET['id'];

$sql = "SELECT * FROM videos WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$category = $row['category'];

$suggest_query = mysqli_query(
    $conn,
    "SELECT * FROM videos
     WHERE category='$category'
     AND id != '$id'
     ORDER BY id DESC
     LIMIT 6"
);

if (!$row) {
    die("Video not found!");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?></title>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff8f5, #f5f7fb);
            min-height: 100vh;
            padding: 20px 10px;
        }

        .video-container {
            max-width: 720px;
            margin: auto;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            background: #ba6a4a;
            color: white;
            padding: 10px 18px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            transition: .3s;
        }

        .back-btn:hover {
            color: white;
            background: #a65c3f;
        }

        .video-card {
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .video-header {
            background: linear-gradient(135deg, #ba6a4a, #d88b69);
            color: white;
            padding: 18px 20px;
        }

        .badge-custom {
            display: inline-block;
            background: rgba(255, 255, 255, .2);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .video-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 13px;
            opacity: .9;
            margin: 0;
        }

        .video-player {
            padding: 10px;
        }

        .video-player video {
            width: 100%;
            border-radius: 16px;
            background: black;
            max-height: 380px;
        }

        .content-section {
            padding: 18px;
        }

        .category-badge {
            display: inline-block;
            background: #fdf0ea;
            color: #ba6a4a;
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .section-title {
            color: #ba6a4a;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .description {
            color: #666;
            line-height: 1.7;
            font-size: 14px;
            margin-bottom: 0;
        }

.suggestion-box{
    padding-top:20px;
}

.suggest-card{
    display:flex;
    gap:12px;
    text-decoration:none;
    background:#fff;
    padding:10px;
    border-radius:15px;
    margin-bottom:15px;
    color:#333;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    transition:.3s;
}

.suggest-card:hover{
    transform:translateY(-3px);
    color:#ba6a4a;
}

.suggest-card img{
    width:120px;
    height:75px;
    object-fit:cover;
    border-radius:10px;
}

.suggest-card h6{
    font-size:14px;
    margin-bottom:4px;
    font-weight:600;
}

.suggest-card small{
    color:#777;
}

@media(max-width:991px){

    .suggestion-box{
        margin-top:20px;
    }

}



        @media (max-width: 768px) {

            body {
                padding: 10px;
            }

            .video-container {
                max-width: 100%;
            }

            .video-header {
                padding: 15px;
            }

            .video-title {
                font-size: 20px;
            }

            .video-player video {
                max-height: 250px;
            }

            .content-section {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {

            .video-title {
                font-size: 18px;
            }

            .badge-custom,
            .category-badge {
                font-size: 11px;
            }

            .description {
                font-size: 13px;
            }

            .video-player video {
                max-height: 220px;
            }
        }
    </style>

</head>

<body>

  
<div class="container-fluid">

    <div class="row g-4">

        <!-- Main Video -->

        <div class="col-lg-8">

            <div class="video-container">

                <a href="videos.php" class="back-btn">
                    ← Back
                </a>

                <div class="video-card">

                    <div class="video-header">

                        <div class="badge-custom">
                            ✨ Premium Yoga Class
                        </div>

                        <h1 class="video-title">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h1>

                        <p class="subtitle">
                            Learn • Practice • Transform
                        </p>

                    </div>

                    <div class="video-player">

                        <video controls controlsList="nodownload">

                            <source
                                src="../uploads/videos/<?php echo $row['video_file']; ?>"
                                type="video/mp4">

                        </video>

                    </div>

                    <div class="content-section">

                        <div class="category-badge">
                            📚 <?php echo htmlspecialchars($row['category']); ?>
                        </div>

                        <h3 class="section-title">
                            About This Video
                        </h3>

                        <p class="description">
                            <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Suggested Videos -->

        <div class="col-lg-4">

            <div class="suggestion-box">

                <h4 class="mb-3">
                    Suggested Videos
                </h4>

                <?php while($video = mysqli_fetch_assoc($suggest_query)){ ?>

                    <a href="../user_panel/single_videos.php?id=<?php echo $video['id']; ?>"
                        class="suggest-card">

                        <img src="../uploads/thumbnails/<?php echo $video['thumbnail']; ?>">

                        <div>

                            <h6>
                                <?php echo htmlspecialchars($video['title']); ?>
                            </h6>

                            <small>
                                <?php echo htmlspecialchars($video['category']); ?>
                            </small>

                        </div>

                    </a>

                <?php } ?>

            </div>

        </div>

    </div>

</div>



</body>

</html>
```

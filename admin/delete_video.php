<?php
global $conn;
include('../db_connect.php');

$id = $_GET['id'];

/* Get video info */
$get = mysqli_query($conn, "SELECT * FROM videos WHERE id='$id'");
$row = mysqli_fetch_assoc($get);

if($row){

    /* Delete video file */
    $video_path = "../uploads/videos/" . $row['video_file'];

    if(file_exists($video_path)){
        unlink($video_path);
    }

    /* Delete thumbnail */
    $thumb_path = "../uploads/thumbnails/" . $row['thumbnail'];

    if(file_exists($thumb_path)){
        unlink($thumb_path);
    }

    /* Delete database record */
    mysqli_query($conn, "DELETE FROM videos WHERE id='$id'");
}

header("Location: videos.php");
exit;

?>
<?php
global $conn;
include 'db_connect.php';
session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT bookings.*, classes.name, classes.instructor
        FROM bookings
        JOIN classes ON bookings.class_id = classes.id
        WHERE bookings.user_id = $user_id";

$result = $conn->query($sql);
?>

<h2>My Classes</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid black; margin:10px; padding:10px;">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['instructor']; ?></p>
        <p>Status: <?php echo $row['status']; ?></p>

        <?php if($row['status'] == 'Booked') { ?>
            <a href="#">Join Class</a>
        <?php } ?>
    </div>
<?php } ?>
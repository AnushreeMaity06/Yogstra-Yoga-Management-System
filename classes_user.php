<?php
global $conn;
    include('db_connect.php');
    $result = $conn->query("SELECT * FROM classes WHERE status='Active'");
?>
<h2>Available Classes</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3><?php echo $row['name']; ?></h3>
        <p>Instructor: <?php echo $row['instructor']; ?></p>
        <p>Level: <?php echo $row['level']; ?></p>

        <a href="book.php?class_id=<?php echo $row['id']; ?>">
            Book Now
        </a>
    </div>
<?php } ?>

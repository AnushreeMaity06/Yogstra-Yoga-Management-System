<?php
global $conn;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../db_connect.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM classes 
        WHERE created_by = $user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Classes</title>

    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 

    <!-- <style>
        body {
            background: #f4f6f9;
        }



        .card-hover {
            transition: 0.3s;
            border-radius: 15px;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 12px;
        }

        .booked {
            background: #28a745;
            color: white;
        }

        .pending {
            background: #ffc107;
            color: black;
        }
    </style> -->

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class=" col-md-2 left p-0">
                <?php include 'sidebar.php'; ?>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-md-10 p-4">

                <h2 class="mb-4 fw-bold">🎓 My Classes</h2>


<div class="row">

<?php if ($result && $result->num_rows > 0) { ?>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm p-3">

                <h5 class="text-primary fw-bold">
                    <?php echo $row['name']; ?>
                </h5>

                <p>
                    👨‍🏫 Instructor:
                    <b><?php echo $row['instructor']; ?></b>
                </p>

                <p>
                    📅 Date:
                    <b><?php echo $row['schedule_date']; ?></b>
                </p>

                <p>
                    ⏰ Time:
                    <b>
                        <?php echo date("h:i A", strtotime($row['start_time'])); ?>
                        -
                        <?php echo date("h:i A", strtotime($row['end_time'])); ?>
                    </b>
                </p>

                <p>
                    💰 Price:
                    ₹<?php echo $row['price']; ?>
                </p>

                <p>
                    Status:
                    <?php if ($row['status'] == 'Active') { ?>
                        <span class="badge bg-success">Active</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">Inactive</span>
                    <?php } ?>
                </p>

                <a href="edit_class.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="delete_class.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure?')">
                    Delete
                </a>

            </div>

        </div>

    <?php } ?>

<?php } else { ?>

    <div class="col-12">
        <div class="alert alert-info">
            No classes found.
        </div>
    </div>

<?php } ?>

</div>



            </div>

        </div>
    </div>

</body>

</html>
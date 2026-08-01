<?php
global $conn;
session_start();
include('../db_connect.php');

$teacher_id = $_SESSION['user_id'];

$sql = "SELECT
            booking.*,
            classes.name AS class_name,
            users.name AS student_name
        FROM booking
        INNER JOIN classes ON booking.class_id = classes.id
        INNER JOIN users ON booking.user_id = users.id
        WHERE classes.created_by = '$teacher_id'
        ORDER BY booking.id DESC";

$result = mysqli_query($conn, $sql);
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />


    <style>
    body {
      /* background:#f4f6f9; */
      font-family: Arial, sans-serif;
    }

    .left {
      min-height: 100vh;
    }

    .main-box {
      background: white;
      border-radius: 18px;
      padding: 25px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .page-title {
      font-size: 30px;
      font-weight: bold;
      color: #ba6a4a;
    }

    .add-btn {
      background: #ba6a4a;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      transition: 0.3s;
      text-decoration: none;
      font-weight: 600;
    }

    .add-btn:hover {
      background: #e56735;
      color: white;
      transform: translateY(-2px);
    }

    .table {
      margin-top: 20px;
      overflow: hidden;
      border-radius: 12px;
    }

    .table thead {
      background: #ba6a4a;
      color: white;
    }

    .table thead th {
      padding: 16px;
      border: none;
      font-size: 15px;
    }

    .table tbody td {
      padding: 16px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f1f1;
      font-size: 14px;
    }

    .table tbody tr {
      transition: 0.3s;
    }

    .table tbody tr:hover {
      background: #fff4ef;
      transform: scale(1.005);
    }

    .price {
      color: #198754;
      font-weight: bold;
      font-size: 15px;
    }

    .status-active {
      background: #198754;
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    .status-inactive {
      background: #dc3545;
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    /* Action Buttons */

    .edit-btn {
      background: #ffffff;
      color: #ba6a4a;
      border: 2px solid #ba6a4a;
      border-radius: 8px;
      padding: 8px 14px;
      text-decoration: none;
      transition: 0.3s;
      font-weight: 600;
      margin-right: 5px;
      display: inline-block;
    }

    .edit-btn:hover {
      background: #ba6a4a;
      color: white;
      transform: translateY(-2px);
    }

    .delete-btn {
      background: #ba6a4a;
      color: white;
      border-radius: 8px;
      padding: 8px 14px;
      text-decoration: none;
      transition: 0.3s;
      font-weight: 600;
      border: none;
      display: inline-block;
    }

    .delete-btn:hover {
      background: #dc3545;
      color: white;
      transform: translateY(-2px);
    }

    @media(max-width:768px) {

      .page-title {
        font-size: 22px;
      }

      .add-btn {
        width: 100%;
        margin-top: 10px;
        text-align: center;
      }

      .table {
        font-size: 13px;
      }

      .edit-btn,
      .delete-btn {
        padding: 6px 10px;
        font-size: 12px;
      }

    }

    .pagination .page-item.active .page-link {
      background: #ba6a4a;
      border-color: #ba6a4a;
      color: white;
    }

    .pagination .page-link {
      color: #ba6a4a;
      border-radius: 8px;
      margin: 0 3px;
      transition: 0.3s;
    }

    .pagination .page-link:hover {
      background: #ba6a4a;
      color: white;
    }
  </style>
</head>

<body style="background-color:#ba6a4a;">


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2  ">
                <?php include('sidebar.php'); ?>
            </div>

            <div class="col-md-10">

    <div class="main-box">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <h2 class="page-title">
                <i class="fa fa-book-open"></i> All Bookings
            </h2>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Student Name</th>
                        <th>Class Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Seats</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>

                        <td><?php echo $i++; ?></td>

                        <td>
                            <strong><?php echo $row['student_name']; ?></strong>
                        </td>

                        <td><?php echo $row['class_name']; ?></td>

                        <td><?php echo $row['date']; ?></td>

                        <td><?php echo $row['time']; ?></td>

                        <td><?php echo $row['seats']; ?></td>

                        <td class="price">
                            ₹ <?php echo $row['total_price']; ?>
                        </td>

                        <td>
                            <?php
                            if ($row['payment_status'] == "Paid") {
                                echo "<span class='status-active'>Paid</span>";
                            } else {
                                echo "<span class='status-inactive'>Pending</span>";
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            if ($row['status'] == "Booked") {
                                echo "<span class='status-active'>Booked</span>";
                            } else {
                                echo "<span class='status-inactive'>Cancelled</span>";
                            }
                            ?>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
        </div>
    </div>
</body>

</html>
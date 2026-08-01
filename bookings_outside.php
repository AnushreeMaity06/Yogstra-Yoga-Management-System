<?php
include 'db_connect.php';
include('booking_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookings</title>

  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
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

    /* BUTTON */
    .reminder-btn {
      background: #ba6a4a;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      transition: 0.3s;
      text-decoration: none;
      font-weight: 600;
    }

    .reminder-btn:hover {
      background: #9f5b40;
      transform: translateY(-2px);
    }

    /* TABLE */
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
    }

    .table tbody tr {
      transition: 0.3s;
    }

    .table tbody tr:hover {
      background: #fff4ef;
      transform: scale(1.005);
    }

    /* STATUS */
    .status-pending {
      background: #ffc107;
      color: black;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    .status-confirmed {
      background: #ba6a4a;
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    /* PAYMENT */
    .payment-paid {
      background: #ba6a4a;
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    .payment-pending {
      background: #dc3545;
      color: white;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }

    /* VIEW */
    .view-btn {
      background: #fff;
      color: #ba6a4a;
      border: 2px solid #ba6a4a;
      border-radius: 8px;
      padding: 8px 14px;
      text-decoration: none;
      transition: 0.3s;
      font-weight: 600;
    }

    .view-btn:hover {
      background: #ba6a4a;
      color: white;
    }

    /* EDIT */
    .edit-btn {
      background: #fff;
      color: #ba6a4a;
      border: 2px solid #ba6a4a;
      border-radius: 8px;
      padding: 8px 14px;
      text-decoration: none;
      transition: 0.3s;
      font-weight: 600;
    }

    .edit-btn:hover {
      background: #ba6a4a;
      color: white;
    }

    /* DELETE */
    .delete-btn {
      background: #ba6a4a;
      color: white;
      border-radius: 8px;
      padding: 8px 14px;
      border: none;
      transition: 0.3s;
      font-weight: 600;
    }

    .delete-btn:hover {
      background: #9f5b40;
      color: white;
    }

    @media(max-width:768px) {

      .page-title {
        font-size: 22px;
      }

      .reminder-btn {
        width: 100%;
        margin-top: 10px;
      }

      .table {
        font-size: 13px;
      }

      .view-btn,
      .edit-btn,
      .delete-btn {
        padding: 6px 10px;
        font-size: 12px;
      }
    }
  </style>

</head>

<body style="background-color:#ba6a4a;">

 

      <!-- Sidebar -->
    
      <div class="col-md-10">

        <div class="main-box">

          <div class="d-flex justify-content-between align-items-center flex-wrap">

            <h2 class="page-title">
              <i class="fa fa-calendar-check"></i> Booking Management
            </h2>

            <button class="reminder-btn">
              <i class="fa fa-envelope"></i> Send Reminder
            </button>

          </div>

          <?php $data = all_details('booking'); ?>

          <div class="table-responsive">

            <table class="table table-hover align-middle">

              <thead>
                <tr>
                  <th>Student</th>
                  <th>Email</th>
                  <th>Class</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Seats</th>
                  <th>Status</th>
                  <th>Payment</th>
                  <th width="220">Action</th>
                </tr>
              </thead>

              <tbody>

                <?php if (!empty($data)) {
                  foreach ($data as $row) { ?>

                    <tr>

                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['class_name']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td><?php echo $row['time']; ?></td>
                      <td><?php echo $row['seats']; ?></td>

                      <td>
                        <?php
                        if ($row['status'] == 'Confirmed') {
                          echo "<span class='status-confirmed'>Confirmed</span>";
                        } else {
                          echo "<span class='status-pending'>Pending</span>";
                        }
                        ?>
                      </td>

                      <td>
                        <?php
                        if ($row['payment_status'] == 'Paid') {
                          echo "<span class='payment-paid'>Paid</span>";
                        } else {
                          echo "<span class='payment-pending'>Pending</span>";
                        }
                        ?>
                      </td>

                      <td>
                        <div class="d-flex gap-2 flex-wrap">

                          <button class="edit-btn">
                            <i class="fa fa-pen"></i> Edit
                          </button>

                          <button class="delete-btn">
                            <i class="fa fa-trash"></i>
                          </button>

                        </div>
                      </td>

                    </tr>

                <?php }
                } ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>
  </div>

</body>

</html>
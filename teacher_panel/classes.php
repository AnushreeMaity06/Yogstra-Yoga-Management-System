<?php
session_start();
include '../db_connect.php';
global $conn;


if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}
$user_id = $_SESSION['user_id'];

// Pagination
$limit = 5; // per page data

$page = isset($_GET['page']) ? $_GET['page'] : 1;

if ($page < 1) {
  $page = 1;
}

$start = ($page - 1) * $limit;

// Total data count
$total_result = $conn->query("
SELECT COUNT(id) AS total
FROM classes
WHERE created_by='$user_id'
");

$total_row = $total_result->fetch_assoc();

$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

// Main query with LIMIT


$result = $conn->query("
SELECT *
FROM classes
WHERE created_by='$user_id'order by id DESC 
LIMIT $start,$limit
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>All Classes</title>

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

<body style="background-color: #ba6a4a;">

  <div class="container-fluid">

    <div class="row">

      <!-- Sidebar -->
      <div class="col-md-2  ">
        <?php include('sidebar.php'); ?>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 ">

        <div class="main-box">

          <div class="d-flex justify-content-between align-items-center flex-wrap">

            <h2 class="page-title">
              <i class="fa fa-book-open"></i> All Classes
            </h2>

            <a href="add_class.php" class="add-btn">
              <i class="fa fa-plus"></i> Add Own Class
            </a>

          </div>

          <!-- Table -->
          <div class="table-responsive">

            <table class="table table-hover align-middle">

              <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Class Name</th>
                  <th>Instructor</th>
                  <th>Level</th>
                  <th>Duration</th>

                  <th> Date</th>
                  <th>Time</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th width="180">Action</th>
                </tr>
              </thead>

              <tbody>

                <?php
                $i = $start + 1;

                while ($row = $result->fetch_assoc()) {
                ?>

                  <tr>

                    <td><?php echo $i++; ?></td>

                    <td>
                      <strong>
                        <?php echo $row['name']; ?>
                      </strong>
                    </td>

                    <td>
                      <?php echo $row['instructor']; ?>
                    </td>

                    <td>
                      <span class="badge " style="background-color:#ba6a4a;">
                        <?php echo $row['level']; ?>
                      </span>
                    </td>

                    <td>
                      <?php echo $row['duration']; ?> min
                    </td>

                    <td>
                      <?php echo $row['schedule_date'] ?>
                    </td>
                    <td>
                      <?php
                      if (!empty($row['start_time']) && !empty($row['end_time'])) {
                        echo date("h:i A", strtotime($row['start_time'])) .
                          " - " .
                          date("h:i A", strtotime($row['end_time']));
                      } else {
                        echo "N/A";
                      }
                      ?>
                    </td>

                    <td class="price">
                      ₹ <?php echo $row['price']; ?>
                    </td>

                    <td>

                      <?php
                      if ($row['status'] == 'Active') {
                        echo "<span class='status-active'>Active</span>";
                      } else {
                        echo "<span class='status-inactive'>Inactive</span>";
                      }
                      ?>

                    </td>

                    <td>

                      <!-- Edit Button -->
                      <a href="edit_class.php?id=<?php echo $row['id']; ?>"
                        class="edit-btn">

                        <i class="fa fa-pen"></i> Edit

                      </a>

                      <!-- Delete Button -->
                      <a href="classdelete_action.php?delete_btn=class&id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are you sure to delete this class?');"
                        class="delete-btn">

                        <i class="fa fa-trash"></i>

                      </a>

                    </td>

                  </tr>

                <?php } ?>

              </tbody>

            </table>

            <!-- Pagination -->

            <div class="d-flex justify-content-center mt-4">

              <nav>

                <ul class="pagination">

                  <!-- Previous Button -->
                  <?php if ($page > 1) { ?>

                    <li class="page-item">
                      <a class="page-link text-dark"
                        href="?page=<?php echo $page - 1; ?>">
                        Previous
                      </a>
                    </li>

                  <?php } ?>



                  <!-- Page Numbers -->
                  <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <li class="page-item <?php if ($page == $i) {
                                            echo 'active';
                                          } ?>">

                      <a class="page-link"
                        href="?page=<?php echo $i; ?>">

                        <?php echo $i; ?>

                      </a>

                    </li>

                  <?php } ?>



                  <!-- Next Button -->
                  <?php if ($page < $total_pages) { ?>

                    <li class="page-item">

                      <a class="page-link text-dark"
                        href="?page=<?php echo $page + 1; ?>">

                        Next

                      </a>

                    </li>

                  <?php } ?>

                </ul>

              </nav>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</body>

</html>
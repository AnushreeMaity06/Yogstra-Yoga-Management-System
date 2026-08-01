<?php
global $conn;
session_start();

include('function.php');
include('../db_connect.php');

$active = "user_list";

/* Pagination */
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

/* Total Records */
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$total_row = mysqli_fetch_assoc($total_query);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

/* Fetch Data */
$query = mysqli_query($conn, "SELECT * FROM users WHERE role='student' LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User List</title>

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

<style>

.main-box{
    background:#fff;
    border-radius:20px;
    padding:18px;
    box-shadow:0 5px 25px rgba(0,0,0,0.08);
    margin-top:15px;
    overflow:hidden;
}

/* Table */
.table{
    margin-top:15px;
    border-radius:15px;
    overflow:hidden;
    background:#fff;
}

.table thead{
    background:linear-gradient(90deg,#ba6a4a,#9f5b40);
    color:#fff;
}

.table thead th{
    padding:14px 12px;
    border:none;
    font-size:15px;
    white-space:nowrap;
    font-weight:600;
}

.table tbody td{
    padding:14px 12px;
    vertical-align:middle;
    border-bottom:1px solid #f1f1f1;
    font-size:15px;
}

.table tbody tr{
    transition:0.3s;
}

.table tbody tr:hover{
    background:#f7eee9;
}

/* Image */
.user-img{
    width:60px;
    height:60px;
    border-radius:50%;
    object-fit:cover;
    border:1px solid #ba6a4a;
}

/* Text */
.name-text{
    font-weight:700;
    color:#333;
    font-size:15px;
}

.email-text{
    color:#666;
    font-size:14px;
}

/* Badge */
.gender-badge{
    background:linear-gradient(90deg,#ba6a4a,#9f5b40);
    color:#fff;
    padding:6px 12px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}

/* Buttons */
.edit-btn{
    background:#fff;
    color:#ba6a4a;
    border:2px solid #ba6a4a;
    border-radius:10px;
    padding:7px 12px;
    text-decoration:none;
    transition:0.3s;
    font-weight:600;
}

.edit-btn:hover{
    background:#ba6a4a;
    color:#fff;
}

.delete-btn{
    background:#ba6a4a;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:7px 12px;
    text-decoration:none;
    transition:0.3s;
    font-weight:600;
}

.delete-btn:hover{
    background:#dc3545;
    color:#fff;
}

.action-box{
    display:flex;
    gap:8px;
}

/* Pagination */
.pagination .page-link{
    border:none;
    margin:0 4px;
    border-radius:10px;
    color:#ba6a4a;
    font-weight:600;
    padding:8px 14px;
}

.pagination .page-link:hover{
    background:#ba6a4a;
    color:#fff;
}

.pagination .active .page-link{
    background:#ba6a4a;
    color:#fff;
}

.pagination .disabled .page-link{
    opacity:0.5;
}

/* Responsive */
@media(max-width:768px){

    .table thead th,
    .table tbody td{
        padding:10px;
        font-size:13px;
    }

    .user-img{
        width:50px;
        height:50px;
    }

    .edit-btn,
    .delete-btn{
        padding:6px 10px;
        font-size:12px;
    }
}

</style>
</head>

<body style="background-color:#ba6a4a;">

<div class="container-fluid">
<div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 " >
        <?php include('sidebar.php'); ?>
    </div>

    <!-- Main -->
    <div class="col-md-10">

        <div class="main-box">

            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="page-title" style="color:#ba6a4a;">
                    <i class="fa fa-users"></i> Student List
                </h2>
            </div>

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(mysqli_num_rows($query) > 0){
                        $sl = $start + 1;

                        while($row = mysqli_fetch_assoc($query)){
                    ?>

                        <tr>

                            <td><strong><?php echo $sl++; ?></strong></td>

                            <td>
                                <span class="name-text"><?php echo $row['name']; ?></span>
                            </td>

                            <td>
                                <span class="email-text"><?php echo $row['email']; ?></span>
                            </td>

                            <td>
                                <span class="gender-badge">
                                    <?php echo $row['gender'] ?? 'NA'; ?>
                                </span>
                            </td>

                            <td><?php echo $row['ph_no']; ?></td>

                            <td><?php echo $row['address']; ?></td>

                            <td>
                                <img class="user-img"
                                     src="<?php echo !empty($row['image']) ? '../images/'.$row['image'] : '../assets/image/istockphoto-1495088043-612x612.jpg'; ?>">
                            </td>

                            <td>
                                <div class="action-box">

                                    <a href="student_delete_action.php?id=<?php echo $row['id']; ?>&delete_btn=user"
                                       class="delete-btn"
                                       onclick="return confirm('Are you sure?');">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>

                    <?php } } else { ?>

                        <tr>
                            <td colspan="8" class="text-center text-danger">
                                No Record Found
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-start mt-4">

                <ul class="pagination">

                    <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                    </li>

                    <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php } ?>

                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
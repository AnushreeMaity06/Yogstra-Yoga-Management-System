<?php
global $conn;
include '../db_connect.php';


/* Pagination */

$limit = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;

/* Total Records */

$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM membership_plans");

$total_row = mysqli_fetch_assoc($total_query);

$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

/* Fetch Data */

$query = mysqli_query($conn, "SELECT * FROM membership_plans LIMIT $start, $limit");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->

    <link rel="stylesheet"
        href="../assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />


    <!-- <style>
        /* Main Card */

        .main-box {
            background: #fff;
            border-radius: 20px;
            padding: 18px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            margin-top: 15px;
            overflow: hidden;
            position: relative;
        }

        /* Table */

        .table {
            margin-top: 15px;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
        }

        .table thead {
            background: linear-gradient(90deg, #f57847, #ff9966);
            color: #fff;
        }

        .table thead th {
            padding: 14px 12px;
            border: none;
            font-size: 15px;
            white-space: nowrap;
            font-weight: 600;
        }

        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
            font-size: 15px;
        }

        .table tbody tr {
            transition: 0.3s;
        }

        .table tbody tr:hover {
            background: #fff4ef;
        }

        /* Image */

        .user-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #f57847;
        }

        /* Text */

        .name-text {
            font-weight: 700;
            color: #333;
            font-size: 15px;
        }

        .email-text {
            color: #666;
            font-size: 14px;
        }

        /* Badge */

        .gender-badge {
            background: linear-gradient(90deg, #f57847, #ff9966);
            color: #fff;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Buttons */

        .edit-btn {
            background: #ffffff;
            color: #f57847;
            border: 2px solid #f57847;
            border-radius: 8px;
            padding: 8px 14px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 600;
            margin-right: 5px;
            display: inline-block;
        }

        .edit-btn:hover {
            background: #f57847;
            color: white;
            transform: translateY(-2px);
        }

        .delete-btn {
            background: #f57847;
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


        .action-box {
            display: flex;
            gap: 8px;
        }

        /* Pagination */

        .pagination .page-link {
            border: none;
            margin: 0 4px;
            border-radius: 10px;
            color: #f57847;
            font-weight: 600;
            padding: 8px 14px;
        }

        .pagination .page-link:hover {
            background: #f57847;
            color: #fff;
        }

        .pagination .active .page-link {
            background: #f57847;
            color: #fff;
        }

        .pagination .disabled .page-link {
            opacity: 0.5;
        }

        /* Responsive */

        @media(max-width:768px) {

            .page-title {
                font-size: 24px;
            }

            .table thead th,
            .table tbody td {
                padding: 10px;
                font-size: 13px;
            }

            .user-img {
                width: 50px;
                height: 50px;
            }

            .edit-btn,
            .delete-btn {
                padding: 6px 10px;
                font-size: 12px;
            }

            .action-box {
                flex-direction: row;
            }
        }
    </style> -->
<style>

    body{
    background:#f4f6f9;
    font-family:Arial,sans-serif;
}

.main-box{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 5px 25px rgba(0,0,0,0.1);
    margin-top:20px;
}

.page-title{
    font-size:30px;
    font-weight:bold;
    color:#ba6a4a;
}

.table{
    margin-top:20px;
    overflow:hidden;
    border-radius:12px;
}

.table thead{
    background:#ba6a4a;
    color:#fff;
}

.table thead th{
    padding:16px;
    border:none;
    font-size:15px;
}

.table tbody td{
    padding:16px;
    vertical-align:middle;
    border-bottom:1px solid #f1f1f1;
}

.table tbody tr{
    transition:.3s;
}

.table tbody tr:hover{
    background:#fff4ef;
    transform:scale(1.005);
}

.price{
    color:#198754;
    font-size:16px;
    font-weight:700;
}

/* .feature-badge{
    background:#f57847;
    color:#fff;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
} */

    .feature-list{
    margin:0;
    padding-left:18px;
    font-size:14px;
    list-style: none;
}

/* .feature-list li{
    margin-bottom:4px;
    
} */

.edit-btn{
    background:#fff;
    color:#ba6a4a;
    border:2px solid #ba6a4a;
    border-radius:8px;
    padding:8px 14px;
    text-decoration:none;
    transition:.3s;
    font-weight:600;
    margin-right:5px;
    display:inline-block;
}

.edit-btn:hover{
    background:#ba6a4a;
    color:#fff;
}

.delete-btn{
    background:#ba6a4a;
    color:#fff;
    border-radius:8px;
    padding:8px 14px;
    text-decoration:none;
    transition:.3s;
    font-weight:600;
    display:inline-block;
}

.delete-btn:hover{
    background:#dc3545;
    color:#fff;
}

.pagination .page-item.active .page-link{
    background:#ba6a4a;
    border-color:#ba6a4a;
    color:#fff;
}

.pagination .page-link{
    color:#ba6a4a;
    border-radius:8px;
    margin:0 3px;
}

.pagination .page-link:hover{
    background:#ba6a4a;
    color:#fff;
}

/* Responsive */

@media(max-width:768px){

    .page-title{
        font-size:22px;
    }

    .main-box{
        padding:15px;
    }

    .table{
        font-size:13px;
    }

    .table thead th,
    .table tbody td{
        padding:10px;
    }

    .edit-btn,
    .delete-btn{
        padding:6px 10px;
        font-size:12px;
    }

    .feature-badge{
        display:inline-block;
        margin-bottom:5px;
        font-size:11px;
    }
}
</style>
</head>

<body style="background-color: #ba6a4a;">



    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->

            <div class="col-md-2 "
                >

                <?php include('sidebar.php'); ?>

            </div>

            <!-- Main Content -->

            <div class="col-md-10 ">

                <div class="main-box">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <h2 class="page-title" style="color:#ba6a4a;">

                            <i class="fa fa-crown"></i>

                            Membership List

                        </h2>

                        <a href="add_membership.php" class="btn " style="background-color:#ba6a4a;color:#fff;position:relative;z-index:9999;">
                            <i class="fa fa-plus"></i> Add Membership
                        </a>

                    </div>

                    <!-- Table -->

                    <div class="table-responsive">

    <table class="table table-hover align-middle">

        <thead>
            <tr>
                <th>SL No.</th>
                <th>Plan Name</th>
                <th>Price</th>
                <th>Features</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $sl = $start + 1;

        while($row = mysqli_fetch_assoc($query)){
        ?>

        <tr>

            <td><?= $sl++; ?></td>

            <td>
                <strong>
                    <?= $row['title']; ?>
                </strong>

                <br>

                <small class="text-muted">
                    <?= $row['description']; ?>
                </small>
            </td>

            <td class="price">
                ₹ <?= $row['price']; ?>
            </td>

            <td>
    <ul class="feature-list" >
        <li><i class="fa-regular fa-circle-check" style="color:#ba6a4a;"></i><?= $row['feature1']; ?></li>
        <li><i class="fa-regular fa-circle-check" style="color:#ba6a4a;"></i><?= $row['feature2']; ?></li>
        <li><i class="fa-regular fa-circle-check" style="color:#ba6a4a;"></i><?= $row['feature3']; ?></li>
    </ul>
</td>

            <td>

                <a href="edit_membership.php?id=<?= $row['id']; ?>"
                   class="edit-btn">

                    <i class="fa fa-pen"></i> Edit

                </a>

                <a href="delete_membership.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Are you sure to delete this membership?');"
                   class="delete-btn">

                    <i class="fa fa-trash"></i>

                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

                    <!-- Pagination -->

                    <div class="d-flex justify-content-start mt-4">

                        <nav>

                            <ul class="pagination">

                                <!-- Previous -->

                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">

                                    <a class="page-link"
                                        href="?page=<?= $page - 1; ?>">

                                        Previous

                                    </a>

                                </li>

                                <!-- Page Numbers -->

                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">

                                        <a class="page-link"
                                            href="?page=<?= $i; ?>">

                                            <?= $i; ?>

                                        </a>

                                    </li>

                                <?php } ?>

                                <!-- Next -->

                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">

                                    <a class="page-link"
                                        href="?page=<?= $page + 1; ?>">

                                        Next

                                    </a>

                                </li>

                            </ul>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- <table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Plan</th>
            <th>Price</th>
            <th>Features</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    <?php
    $query = mysqli_query(
        $conn,
        "SELECT * FROM membership_plans"
    );

    while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <tr>

            <td><?= $row['id']; ?></td>

            <td>
                <b><?= $row['title']; ?></b><br>
                <?= $row['description']; ?>
            </td>

            <td>₹<?= $row['price']; ?></td>

            <td>
                <?= $row['feature1']; ?><br>
                <?= $row['feature2']; ?><br>
                <?= $row['feature3']; ?>
            </td>

            <td>
                <a href="edit_membership.php?id=<?= $row['id']; ?>"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="delete_membership.php?id=<?= $row['id']; ?>"
                    class="btn btn-danger btn-sm">
                    Delete
                </a>
            </td>

        </tr>
    <?php } ?>

    </tbody>

</table> -->
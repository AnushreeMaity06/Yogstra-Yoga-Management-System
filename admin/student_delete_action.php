 <?php
    include_once('function.php');


    if ($_SERVER['REQUEST_METHOD'] === "GET" && $_GET['delete_btn'] == 'user') {
        $id = $_GET['id'];
        $call = delete_data('users', $id);
        if ($call) {
            echo "<script>
            alert('user deleted successful..');
            window.location.href='user_list.php';
            </script>";
        } else {
            echo "<script>
        alert('user delete unsuccesfull..');
        window.location.href='user_list.php';
        </script>";
        }
    } else {
        header("Location: user_list.php");
        exit();
    }
    ?>



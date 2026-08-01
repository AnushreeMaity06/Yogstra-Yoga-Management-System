<?php
 include('booking_function.php');


 if($_SERVER['REQUEST_METHOD']==="GET" &&$_GET['delete_btn']=='user'){
    $id=$_GET['id'];
    $call=delete_data('booking',$id);
    if($call){
        echo "<script>
            alert('user deleted successful..');
            windows.location.href='bookings.php';
            </script>";
        }
    else{
        echo "<script>
        alert('user delete unsuccesfull..');
        windows.location.href='bookings.php';
        </script>";
    }
 }
?>
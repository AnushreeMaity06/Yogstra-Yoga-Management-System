<?php

include_once('../db_connect.php');

global $conn;


function all_details($table){

    global $conn;

    // BOOKING TABLE JOIN

    if($table == 'booking'){

        $sql = "SELECT booking.*, users.name, users.email, classes.name AS class_name FROM booking 
        JOIN users ON booking.user_id = users.id 
        JOIN classes ON booking.class_id = classes.id 
        ORDER BY booking.id DESC";

                // echo $sql;
                // exit();

    }else{

        $sql = "SELECT * FROM {$table} ORDER BY id DESC";
    }

    $run = mysqli_query($conn,$sql);

    if($run){


    // die(mysqli_error($conn));

        if(mysqli_num_rows($run) > 0){

            return mysqli_fetch_all($run,MYSQLI_ASSOC);

        }else{

            return false;
        }

    }else{

        return false;
    }
}

?>
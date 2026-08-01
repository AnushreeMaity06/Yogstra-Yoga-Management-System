<?php
include_once('db_connect.php');
global $conn;


function all_details($table)
{
    global $conn;
    $sql = "SELECT * FROM {$table} ORDER BY ID DESC";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        if (mysqli_num_rows($run)) {
            return mysqli_fetch_all($run, MYSQLI_ASSOC);
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// =============================delete===============


function delete_data($table, $id)
{
    global $conn;
    $sql = "DELETE FROM {$table} WHERE id={$id}";
    $run = mysqli_query($conn, $sql);
    if ($run) {

        return true;
    } else {
        return false;
    }
}


//==========================================edit============================


function edit_data($table, $id, $name, $email, $gender, $ph_no, $address, $file_name)
{
    global $conn;

    // FIX: undefined variable + comma error + missing fields
    $sql = "UPDATE {$table} SET name='{$name}', email='{$email}', gender='{$gender}',ph_no='{$ph_no}',address='{$address}',image='$file_name' WHERE id='{$id}'";

    $run = mysqli_query($conn, $sql);

    if ($run) {
        return true;
    } else {
        return false;
    }
}



// function get_details(){
//     global $conn;

//     $sql="SELECT * FROM `users` WHERE id='$id'";
//     $run=my_sqliquery($conn,$sql);
//     $data = mysqli_fetch_assoc($run);

//     if($run){
//         return true;
//     }
//     else{
//         return false;
//     }
// }
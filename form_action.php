<?php

include('db_connect.php');
session_start();
global $conn;

// SignUp Page
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // exit(0);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $ph_no = $_POST['ph_no'];
    $address = $_POST['address'];

    $check_email = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $check_email);

if (mysqli_num_rows($result) > 0) {

    echo "<script>
            alert('Email already exists');
            window.location.href='signup.php';
          </script>";
    exit();
}
    $otp=rand(100000,999999);

    // $qualification=$_POST['quali[]'];
    // $qualification = implode(",", $_POST['quali']);

    // $image=$_POST['image'];
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'uploads/image/' . $file_name;
    move_uploaded_file($tempname, $folder);
    // $query = mysqli_query($conn,"INSERT INTO users (image) VALUES ('$file_name')");


    $insert = "INSERT INTO `users`(`name`, `email`, `password`, `gender`,`role`, `ph_no`,`address`, `image`,`otp`,`is_verified`) 
            VALUES ('$name','$email','$password','$gender','$role','$ph_no','$address','$file_name','$otp',0)";

    $run = mysqli_query($conn, $insert);
    if ($run) {

        require'send_mail_function_main.php';
        send_Mail($email,$otp);

        header("location:verify.php?email=".$email);
        exit();
        // echo "<script>
        //         alert('Registration Successfull');
        //         window.location.href='login.php';
        //         </script>";
        // header("Location:login.php");
    } else {
        echo  "Error:" . mysqli_error($conn);
    }
}


// Login Page
// session_start();
// if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['loginBtn'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $role=$_POST['role'];

//     $check = "SELECT * FROM users where email='$email' AND role='$role'";
//     $run = mysqli_query($conn, $check);

//     if (mysqli_num_rows($run) > 0) {
//         $data = mysqli_fetch_assoc($run);
//         if (password_verify($password, $data['password'])) {
//             $_SESSION['user_id'] = $data['id'];
//             $_SESSION['user_name'] = $data['name'];
//             $_SESSION['user_email'] = $data['email'];
//             $_SESSION['user_gen'] = $data['gender'];
//             $_SESSION['user_ph_no'] = $data['ph_no'];
//             $_SESSION['user_address'] = $data['address'];
//              $_SESSION['role'] = $data['role'];


//               if ($data['role'] == "student") {
//                 header("Location: user_panel/miniprofile.php");
//             } else {
//                 header("Location: teacher_panel/dashboard.php");
//             }



//             // if(isset($_POST['quali'])){
//             //     foreach($_POST['quali'] as $value){
//             //     echo $value . "<br>";
//             // }

//             exit();

//         }

//         // header("Location:user_panel/miniprofile.php");
//         // exit();
//     } else {
//         echo "<script>
//             alert('Password did not match');
//             window.location.href='login.php';
//             </script>";
//     }
// } else {
//     echo "<script>
//             alert('Email not exists');
//          window.location.href='login.php';
//             </script>";
// }



// include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['loginBtn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // USER LOGIN (student / teacher)
    $sql = "SELECT * FROM users WHERE email='$email' AND role='$role'";
    $run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($run) > 0) {

        $user = mysqli_fetch_assoc($run);

        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // exit;
if ($user['is_verified'] == 0) {

    echo "<script>
            alert('Please verify your email first');
            window.location.href='login.php';
          </script>";
    exit();
}
        if (password_verify($password, $user['password'])) {

            // ✅ SINGLE SESSION SYSTEM
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_image'] = $user['image'];
            $_SESSION['role'] = $user['role'];

            // 🔥 ROLE BASED REDIRECT
            if ($user['role'] == "student") {
                header("Location: index.php");
            } elseif ($user['role'] == "teacher") {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<script>
                alert('Wrong password');
                window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('User not found or wrong role');
            window.location.href='login.php';
        </script>";
    }
}



// Update Details======


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['updateDetails'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $user_id = $_POST['user_id'];
    $sql = "UPDATE users SET name='{$name}', gender='" . $gender . "' WHERE id='{$user_id}'";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        $_SESSION['user_name'] = $name;
        echo "<script>
                alert('Update Successfully');
                window.location.href='my_profile.php';
                </script>";
    } else {
        echo "<script>
                alert('Update not successful');
                history.back();
                </script>";
    }
}

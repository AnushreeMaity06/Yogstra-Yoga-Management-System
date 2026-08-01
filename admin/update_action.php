<!--  -->
  <?php
include('function.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // FIX: safe check
    $ph_no = isset($_POST['ph_no']) ? $_POST['ph_no'] : '';

    $address = isset($_POST['address']) ? $_POST['address'] : '';

    $file_name = $_POST['old_image'];

    // $folder = "image/";

    // if (!is_dir($folder)) {
    //     mkdir($folder, 0777, true);
    // }

    // if (!empty($_FILES['image']['name'])) {

    //     $new_file = time() . "_" . $_FILES['image']['name'];
    //     $tempname = $_FILES['image']['tmp_name'];

    //     $file_path = $folder . $new_file;

    //     move_uploaded_file($tempname, $file_path);

    //     $file_name = $file_path;
    // }
$folder = "../image/";   // 🔴 FIX: admin theke 1 level up

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

if (!empty($_FILES['image']['name'])) {

    $new_file = time() . "_" . $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];

    $file_path = $folder . $new_file;

    if (move_uploaded_file($tempname, $file_path)) {
        $file_name = "image/" . $new_file;  // 🔴 DB te always relative store
    }
}
    $calls = edit_data(
        'users',
        $id,
        $name,
        $email,
        $gender,
        $ph_no,
        $address,
        $file_name
    );

    if ($calls) {
        echo "<script>
            alert('User updated successfully');
            window.location.href = 'user_list.php';
        </script>";
    } else {
        echo "<script>
            alert('Update failed');
            window.location.href = 'user_list.php';
        </script>";
    }
}
?>
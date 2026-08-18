
<?php

session_start();

global $conn;

include_once '../db_connect.php';


// =========================
// Check Request Method
// =========================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request.");
}


// =========================
// Check Update Button
// =========================

if (!isset($_POST['update'])) {
    die("Invalid update request.");
}


// =========================
// Get Class ID
// =========================

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("Class ID is missing.");
}

$id = intval($_POST['id']);


// =========================
// Get Form Data
// =========================

$name = trim($_POST['name'] ?? '');
$level = trim($_POST['level'] ?? '');
$schedule_date = $_POST['schedule_date'] ?? '';
$start_time = $_POST['start_time'] ?? '';
$end_time = $_POST['end_time'] ?? '';
$duration = intval($_POST['duration'] ?? 0);
$price = floatval($_POST['price'] ?? 0);
$description = trim($_POST['description'] ?? '');
$benefits = trim($_POST['benefits'] ?? '');
$status = trim($_POST['status'] ?? '');


// =========================
// Validation
// =========================

if (
    empty($name) ||
    empty($level) ||
    empty($schedule_date) ||
    empty($start_time) ||
    empty($end_time) ||
    $duration <= 0 ||
    $price < 0 ||
    empty($description) ||
    empty($benefits) ||
    empty($status)
) {
    die("Please fill all required fields correctly.");
}


// =========================
// Validate Level
// =========================

$allowed_levels = [
    'Beginner',
    'Intermediate',
    'Advanced'
];

if (!in_array($level, $allowed_levels, true)) {
    die("Invalid level selected.");
}


// =========================
// Validate Status
// =========================

$allowed_status = [
    'Active',
    'Inactive'
];

if (!in_array($status, $allowed_status, true)) {
    die("Invalid status selected.");
}


// =========================
// Validate Date
// =========================

$date_object = DateTime::createFromFormat(
    'Y-m-d',
    $schedule_date
);

if (!$date_object || $date_object->format('Y-m-d') !== $schedule_date) {
    die("Invalid class date.");
}


// =========================
// Validate Time
// =========================

$start_object = DateTime::createFromFormat(
    'H:i',
    $start_time
);

$end_object = DateTime::createFromFormat(
    'H:i',
    $end_time
);

if (!$start_object || !$end_object) {
    die("Invalid time format.");
}


// =========================
// Calculate Duration
// =========================

$start_minutes =
    ((int) $start_object->format('H') * 60)
    + (int) $start_object->format('i');

$end_minutes =
    ((int) $end_object->format('H') * 60)
    + (int) $end_object->format('i');


// =========================
// Check End Time
// =========================

if ($end_minutes <= $start_minutes) {
    die("End time must be greater than start time.");
}


// =========================
// Calculate Actual Duration
// =========================

$actual_duration = $end_minutes - $start_minutes;


// =========================
// Check Duration
// =========================

if ($duration != $actual_duration) {

    $duration = $actual_duration;
}


// =========================
// Check Class Exists
// =========================

$check_sql = "
    SELECT id
    FROM classes
    WHERE id = ?
    LIMIT 1
";

$check_stmt = $conn->prepare($check_sql);

if (!$check_stmt) {
    die("Database error: " . $conn->error);
}

$check_stmt->bind_param(
    "i",
    $id
);

$check_stmt->execute();

$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {

    $check_stmt->close();

    die("Class not found.");
}

$check_stmt->close();


// =========================
// Update Class
// =========================

$update_sql = "
    UPDATE classes
    SET
        name = ?,
        level = ?,
        schedule_date = ?,
        start_time = ?,
        end_time = ?,
        duration = ?,
        price = ?,
        description = ?,
        benefits = ?,
        status = ?
    WHERE id = ?
";

$stmt = $conn->prepare($update_sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}


// =========================
// Bind Parameters
// =========================

$stmt->bind_param(
    "sssssiddssi",
    $name,
    $level,
    $schedule_date,
    $start_time,
    $end_time,
    $duration,
    $price,
    $description,
    $benefits,
    $status,
    $id
);


// =========================
// Execute Update
// =========================

if ($stmt->execute()) {

    $stmt->close();

    // Redirect after successful update
    header("Location: classes.php?success=updated");
    exit;

} else {

    $error = $stmt->error;

    $stmt->close();

    die("Failed to update class: " . $error);
}
?>


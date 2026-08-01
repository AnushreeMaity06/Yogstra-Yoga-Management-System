






<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modern Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('assets/image/yoga1.jpg');
    background-size: cover;
    background-position: center;
    padding: 20px;
}

/* Card */
.login-card {
    width: 100%;
    max-width: 420px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(14px);
    border-radius: 25px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

/* Title */
.login-card h2 {
    text-align: center;
    color: #fff;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Toggle Buttons */
.role-switch {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    gap: 10px;
}

.role-btn {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

.role-btn.active {
    background: linear-gradient(45deg, #ff914d, #ba6a4a);
    color: #fff;
}

.role-btn:not(.active) {
    background: rgba(255,255,255,0.8);
    color: #333;
}

/* Inputs */
.input-group-custom {
    position: relative;
    margin-bottom: 18px;
}

.input-group-custom i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #ff914d;
}

.input-group-custom input {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: none;
    outline: none;
    border-radius: 14px;
}

/* Button */
.login-btn {
    width: 100%;
    border: none;
    padding: 14px;
    border-radius: 15px;
    background: linear-gradient(45deg, #ff914d, #ba6a4a);
    color: white;
    font-size: 18px;
    font-weight: 600;
}

/* Extra */
.extra {
    text-align: center;
    margin-top: 15px;
    color: white;
    font-size: 14px;
}

.extra a {
    color: #ff914d;
    text-decoration: none;
    font-weight: 600;
}
</style>
</head>

<body>

<div class="login-card">

    <h2>
        <i class="fa-solid fa-right-to-bracket"></i>
        Login
    </h2>

    <!-- ROLE SWITCH -->
    <div class="role-switch">
        <button type="button" class="role-btn active" onclick="setRole('student', this)">Student</button>
        <button type="button" class="role-btn" onclick="setRole('teacher', this)">Teacher</button>
    </div>

    <form action="Form_action.php" method="POST">

        <!-- hidden role -->
        <input type="hidden" name="role" id="role" value="student">

        <div class="input-group-custom">
            <i class="fa-solid fa-envelope"></i>
            <input type="text" name="email" placeholder="Enter your email">
        </div>

        <div class="input-group-custom">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Enter password">
        </div>

        <button type="submit" name="loginBtn" class="login-btn">
            Login
        </button>

    </form>

    <div class="extra">
        Don’t have an account? <a href="signup.php">Sign Up</a>
    </div>

</div>

<script>
function setRole(role, btn) {
    document.getElementById("role").value = role;

    let buttons = document.querySelectorAll(".role-btn");
    buttons.forEach(b => b.classList.remove("active"));

    btn.classList.add("active");
}
</script>

</body>
</html>

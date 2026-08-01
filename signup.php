
    

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modern Signup</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* 🔥 FIX: CENTER PROPER + NO SCROLL */
body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('assets/image/yoga1.jpg');
    background-size: cover;
    background-position: center;
    padding: 10px;
    overflow: hidden;
}

/* 🔥 SMALL + RESPONSIVE CARD */
.signup-card {
    width: 100%;
    max-width: 380px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    animation: fadeIn 0.6s ease;

    /* 🔥 FIX: NO OVERFLOW ISSUE */
    max-height: 95vh;
    overflow: hidden;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(15px);}
    to {opacity: 1; transform: translateY(0);}
}

.signup-card h2 {
    text-align: center;
    color: #fff;
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 18px;
}
.signup-card h2 i {
            color: #ff914d;
            margin-right: 8px;
        }

/* 🔥 INPUT COMPACT */
.input-group-custom {
    position: relative;
    margin-bottom: 14px;
}

.input-group-custom i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #ff914d;
    font-size: 14px;
}

.input-group-custom input {
    width: 100%;
    padding: 10px 10px 10px 38px;
    border: none;
    outline: none;
    border-radius: 10px;
    font-size: 14px;
}

/* 🔥 GENDER SMALL */
.gender-area {
    color: white;
    margin-bottom: 12px;
    font-size: 13px;
}

/* 🔥 FILE */
.file-box {
    color: white;
    margin-bottom: 12px;
    font-size: 13px;
}

.file-box input {
    width: 100%;
    margin-top: 6px;
    background: white;
    padding: 6px;
    border-radius: 8px;
    font-size: 13px;
}

/* 🔥 PREVIEW SMALL */
#imgpreview {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    object-fit: cover;
    margin-top: 10px;
    display: none;
    border: 2px solid white;
}

/* 🔥 BUTTON */
.signup-btn {
    width: 100%;
    border: none;
    padding: 10px;
    border-radius: 12px;
    background: linear-gradient(45deg, #ff914d, #ff5e62);
    color: white;
    font-size: 15px;
    font-weight: 600;
}

/* 🔥 MOBILE FIX */
@media(max-width: 576px) {
    .signup-card {
        padding: 14px;
        max-width: 340px;
    }
}
</style>
</head>

<body>

<div class="signup-card">

    <h2 >
        <i class="fa-solid fa-user-plus"></i>
        Create Account
    </h2>

    <form onsubmit="return signup()" action="form_action.php" method="POST" enctype="multipart/form-data">

        <div class="input-group-custom">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="name" id="name" placeholder="Name">
        </div>

        <div class="input-group-custom">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>

        <div class="input-group-custom">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>

        <div class="gender-area">
            Gender:
            <label><input type="radio" name="gender" class="gen" value="male"> Male</label>
            <label><input type="radio" name="gender" class="gen" value="female"> Female</label>
        </div>

        <!-- 🔥 ROLE ADD HERE -->
<div class="gender-area">
    Role:
    <label><input type="radio" name="role" value="student" required> Student</label>
    <label><input type="radio" name="role" value="teacher" required> Teacher</label>
</div>

        <div class="input-group-custom">
            <i class="fa-solid fa-phone"></i>
            <input type="text" name="ph_no" id="ph_no" placeholder="Phone">
        </div>

        <div class="input-group-custom">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" name="address" id="address" placeholder="Address">
        </div>

        <div class="file-box">
            Upload Image
            <input type="file" id="image" name="image" accept="image/*">
            <img id="imgpreview">
        </div>

        <button class="signup-btn" name="submit">Sign Up</button>

    </form>

</div>

<script>
function signup() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const gender = document.querySelectorAll('.gen:checked');

    if (name === "" || email === "" || password === "") {
        alert("Fill all fields");
        return false;
    }

    if (gender.length === 0) {
        alert("Select gender");
        return false;
    }

    return true;
}

document.getElementById('image').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('imgpreview');
            img.src = reader.result;
            img.style.display = "block";
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
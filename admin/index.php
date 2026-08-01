<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Yoga Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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

            background:
                linear-gradient(rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.55)),
                url('../assets/image/yoga1.jpg');

            background-size: cover;
            background-position: center;

            overflow: hidden;

            padding: 15px;
        }

        /* Login Card */
        .login-card {

            width: 100%;
            max-width: 400px;

            background: rgba(255, 255, 255, 0.12);

            border: 1px solid rgba(255, 255, 255, 0.18);

            backdrop-filter: blur(14px);

            border-radius: 22px;

            padding: 30px 24px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);

            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        /* Heading */
        .login-card h2 {

            text-align: center;

            color: white;

            font-weight: 700;

            margin-bottom: 25px;

            font-size: 30px;
        }

        .login-card h2 i {

            color: #ba6a4a;

            margin-right: 8px;
        }

        /* Input Box */
        .input-group-custom {

            position: relative;

            margin-bottom: 18px;
        }

        .input-group-custom i {

            position: absolute;

            top: 50%;
            left: 14px;

            transform: translateY(-50%);

            color: #ba6a4a;

            font-size: 15px;
        }

        .input-group-custom input {

            width: 100%;

            padding: 12px 14px 12px 42px;

            border: none;

            outline: none;

            border-radius: 12px;

            font-size: 14px;

            background: rgba(255, 255, 255, 0.95);
        }

        .input-group-custom input:focus {

            box-shadow: 0 0 0 3px rgba(255, 145, 77, 0.35);
        }

        /* Button */
        .login-btn {

            width: 100%;

            border: none;

            padding: 12px;

            border-radius: 12px;

                background: linear-gradient(45deg, #ff914d, #ba6a4a);


            color: white;

            font-size: 16px;

            font-weight: 600;

            transition: 0.3s;
        }

        .login-btn:hover {

            transform: translateY(-2px);

            opacity: 0.95;
        }

        /* Extra */
        .bottom-text {

            text-align: center;

            margin-top: 18px;

            color: white;

            font-size: 14px;
        }

        .bottom-text a {

            color: #ffb27a;

            text-decoration: none;

            font-weight: 600;
        }

        .bottom-text a:hover {

            color: white;
        }

        /* Mobile */
        @media(max-width:576px) {

            .login-card {

                padding: 24px 18px;
            }

            .login-card h2 {

                font-size: 25px;
            }

        }
    </style>

</head>

<body>

    <!-- Login Card -->
    <div class="login-card">

        <h2>
            <i class="fa-solid fa-leaf"></i>
            Admin Login
        </h2>

        <form action="common_action.php"
            method="POST">

            <!-- Email -->
            <div class="input-group-custom">

                <i class="fa-solid fa-envelope"></i>

                <input type="email"
                    name="email"
                    id="email"
                    placeholder="Enter Email">

            </div>

            <!-- Password -->
            <div class="input-group-custom">

                <i class="fa-solid fa-lock"></i>

                <input type="password"
                    name="password"
                    id="password"
                    placeholder="Enter Password">

            </div>

            <!-- Button -->
            <button type="submit"
                name="loginBtn"
                value="login"
                class="login-btn">

                <i class="fa-solid fa-right-to-bracket"></i>

                Login

            </button>

        </form>

        <!-- Bottom -->
        <div class="bottom-text">

            Welcome to Yoga Admin Panel

        </div>

    </div>

</body>

</html>
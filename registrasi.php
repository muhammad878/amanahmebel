<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getMongoDBConnection();
    $users = $db->user;

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $existingUser = $users->findOne(['username' => $username]);

    if ($existingUser) {
        $error_message = "Username sudah digunakan. Silakan pilih yang lain.";
    } else {
        $users->insertOne(['username' => $username, 'password' => $password]);
        $success_message = "Registrasi berhasil. <a href='index.php'>Login di sini</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>StayHub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
        }
        .left {
            position: relative;
            width: 60%;
        }
        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .left .content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
        }
        .left .content h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .right {
            padding: 40px;
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h2 {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 20px;
        }
        .right .form-group {
            margin-bottom: 20px;
        }
        .right .form-control {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }
        .right .btn {
            padding: 10px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .right .btn:hover {
            background-color: #3e5bbf;
        }
        .right .help {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <img alt="A woman speaking into a microphone" src="https://storage.googleapis.com/a1aa/image/9GNs88g6uOa3PdelFnqm3ejdQEOneVotQSOKKkef4aoGqsTfE.jpg"/>
            <div class="content">
                <h1>Join Us!</h1>
                <p>Create your account to get started.</p>
            </div>
        </div>
        <div class="right">
            <h2>Create a User Account!</h2>
            <?php 
            if (isset($error_message)) {
                echo '<div class="alert alert-danger">' . $error_message . '</div>';
            }
            if (isset($success_message)) {
                echo '<div class="alert alert-success">' . $success_message . '</div>';
            }
            ?>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Register Account</button>
            </form>
            <div class="help">
                <a href="login.php">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</body>

</html>
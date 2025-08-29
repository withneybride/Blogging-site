<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | eXor</title>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Calibri', sans-serif;
            padding: 0;
            margin: 0;
            color: white;
        }
        html, body {
            width: 100%;
            height: 100%;
            display: flex;
            background-image: url("assets/winD.jpg");
            background-size: cover;
            background-position: 50%;
            background-repeat: no-repeat;
            font-size: 105%;
        }
        form {
            backdrop-filter: blur(3px);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid gray;
            border-radius: 5px;
            height: 45%;
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }
        #upper {
            display: flex;
            flex-direction: column;
            height: 50%;
            width: 85%;
            padding-left: 5%;
            justify-content: space-evenly;
        }
        #lower {
            display: flex;
            width: 100%;
            height: 20%;
            justify-content: center;
            align-items: center;
        }
        button[type="submit"] {
            background: transparent;
            width: 30%;
            height: 50%;
            font-size: 110%;
            border: 1px solid black;
            border-radius: 5px;
            animation: glowLoop 2s ease-in-out infinite;
        }
        input {
            background: transparent;
            border: none;
            border-bottom: 1px solid black;
            width: 92%;
            height: 20%;
            padding-left: 5%;
            font-size: 110%;
            color: white;
            border-radius: 5px;
            outline: none;
        }
        #upper span {
            width: 35%;
            padding-left: 5%;
        }
        input:focus {
            border-bottom: 1px solid black;
        }
        @keyframes glowLoop {
            0%   { box-shadow: 0 0 5px #00f; }
            50%  { box-shadow: 0 0 20px #0ff; }
            100% { box-shadow: 0 0 5px #00f; }
        }
        .msg {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
            backdrop-filter: blur(2px);
            font-weight: bold;
        }
        .error { background: rgba(255, 0, 0, 0.3); }
        .success { background: rgba(0, 128, 0, 0.3); }
    </style>
</head>
<body>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div class='msg error'>Username already exists. Try another one.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo "<div class='msg success'>Signup successful. <a href='login.php'>Login</a></div>";
        } else {
            echo "<div class='msg error'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>
<form method="POST">
    <div id="upper">
        <span>Username:</span>
        <input name="username" required class="ipt">
        <span>Password:</span>
        <input type="password" name="password" required class="ipt">
    </div>
    <div id="lower">
        <button type="submit">Go in</button>
    </div>
</form>
</body>
</html>

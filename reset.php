<?php
session_start();
require_once 'db.php'; // your DB connection file

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $passcode = trim($_POST['passcode']);

    // Validate credentials
    if ($username === 'xor' && $passcode === '1415') {
        $tables = ['posts', 'users'];
        $success = true;

        foreach ($tables as $table) {
            $truncate = $conn->query("DELETE FROM `$table`");
            $reset = $conn->query("ALTER TABLE `$table` AUTO_INCREMENT = 1");

            if (!$truncate || !$reset) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo "<h2 style='text-align:center;'> Database reset successful.</h2>";
        } else {
            echo "<h2 style='color:red; text-align:center;'>Error during reset. Check database permissions.</h2>";
        }
    } else {
        echo "<h2 style='color:red; text-align:center;'>Access denied. Invalid credentials.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Reset | eXor</title>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
  <style>
    *
    {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }
    body {
      background: url("assets/winD.jpg") no-repeat center center fixed;
      background-size: cover;
      font-family: 'Aptos', sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      backdrop-filter: blur(5px);
      padding: 30px;
      border-radius: 10px;
      border: 1px solid gray;
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 300px;
      backdrop-filter: blur(3px);
    }
    input {
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: none;
      border-bottom: 1px solid black;
      outline: none;
      background: transparent;
      color: white;
    }
    button {
      padding: 10px;
      font-size: 16px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: darkred;
    }
    h2
    {
      font-weight: unset;
      color: white;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2 style="text-align:center;">Admin Reset</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="passcode" placeholder="Passcode" required>
    <button type="submit">Reset Database</button>
  </form>
</body>
</html>

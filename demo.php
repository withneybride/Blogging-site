<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .greeting {
            font-size: 18px;
            color: #333;
        }
        form
        {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
</head>
<body>
    <div class="container">
        <h2>Enter Your Name</h2>
        <form method="GET" action="">
            <input type="text" name="name" placeholder="Your name here" required>
            <input type="submit" value="Greet Me">
        </form>

        <?php
        if (isset($_GET['name'])) {
            $person = $_GET['name'];
            $person = preg_replace("/[^A-Za-z0-9 .,';:?]/", "", $person);
            echo "<p class='greeting'>Hello <strong>" . htmlspecialchars($person) . "</strong>, how are you today?</p>";
        }
        ?>
    </div>
</body>
</html>

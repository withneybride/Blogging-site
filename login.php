<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | eXor</title>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
</head>
<body>
    <?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        }
    }
    echo "<span id=\"invalid\">User does not exist!</span>
    <span id=\"sign\">
    <p>Don't have an account?</p>
    <p><a href=\"signup.php\">Sign up</a> instead!
    </p>
    </span>
    ";
}
?>
<form method="POST">
    <div id="upper">
         <span>
            Username: 
         </span><input name="username" required class="ipt" >
         <span>Password:</span>
     <input type="password" name="password" required class="ipt">
    </div>
    <div id="lower">
        <button type="submit">Login</button>
    </div>
</form>
<style>
     *
    {
        box-sizing: border-box;
        font-family: 'Calibri', sans-serif;
        padding: 0;
        margin: 0;
        color: white;
    }
    html,
    body
    {
        width: 100%;
        height: 100%;
        display: flex;
        background-image: url("assets/winD.jpg");
        background-size: cover;
        background-position: 50%;
        background-repeat: no-repeat;
        color: white;
        font-size: 105%;
    }
    form
    {
        backdrop-filter: blur(3px);
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 1px solid gray;
        border-radius: 5px;
        height: 45%;;
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
    }
    #upper
    {
        display: flex;
        flex-direction: column;
        height: 50%;
        width: 85%;
        padding-left: 5%;
        justify-content: space-evenly;
    }
    #lower
    {
        display: flex;
        width: 100%;
        height: 20%;
        justify-content: center;
        align-items: center;
    }
    button[type="submit"]
    {
        background: transparent;
        width: 30%;
        height: 50%;
        font-size: 110%;
        border: 1px solid black;
        border-radius: 5px;
    }
    input
    {
        background: transparent;
        border: none;
        border-bottom: 1px solid black;
        width: 92%;
        display: flex;
        height: 20%;
        padding-left: 5%;
        font-size: 110%;
        color: white;
        border-radius: 5px;
        outline: none;
    }
    #upper span
    {
        width: 35%;
        padding-left: 5%;
    }
    input:focus
    {
        border: none;
        border-bottom: 1px solid black;
    }
         @keyframes glowLoop {
  0%   { box-shadow: 0 0 5px #00f; }
  50%  { box-shadow: 0 0 20px #0ff; }
  100% { box-shadow: 0 0 5px #00f; }
}

button, #sign a {
  animation: glowLoop 2s ease-in-out infinite;
}
#invalid
{
    background: rgba(150, 18, 15, 0.5);
    display: flex;
    flex-direction: row;
    height: 5%;
    position: absolute;
    top: 5%;
    left: 50%;
    transform: translateX(-50%);
    width: 300px;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
}
#sign
{
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    width: 300px;
    background: rgba(0,0,0,0.7);
    height: 10%
}
#sign a
{
    text-decoration: none;
    border: none;
    padding: 0 5px;
    border-radius: 5px;
}
</style>

</body>
</html>
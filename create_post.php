<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create |eXor</title>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
</head>
<body>
    <?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    die("Login required to post.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
    header("Location: index.php");
}
?>
<form method="POST">
    <div class="Title">
        <span>Title: </span><input name="title" required id="ipt" oninput="set();" onmouseleave="set();" placeholder="What is your title for today's post?">
    </div>
    <div class="content">
        <span>Content:</span>
        <textarea name="content" id="" placeholder="Tell the universe something...😎" required></textarea>
    </div>
    <span id="sub">
        <button type="submit">Post</button>
    </span>
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
        align-items: center;
        justify-content: center;
    }
    form
    {
        height: 80%;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: absolute;
        left: 50%;
        top: 50%;
        width: 100%;
        transform: translate(-50%, -50%);
        border: 1px solid grey;
        padding: 10px;
        backdrop-filter: blur(3px);
    }
    .Title
    {
        display: flex;
        flex-direction: row;
        height: 20%;
        align-items: center;
    }
    .Title span
    {
        padding-left: 3%;
        font-weight: bold;
        font-size: 130%;
    }
    .Title input
    {
        background: transparent;
        height: 33%;
        margin-left: 15px;
        width: 88%;
        border: none;
        border-bottom: 2px solid grey;
        font-size: 130%;
        color: white;
        outline: none;
    }
    .content
    {
        display: flex;
        flex-direction: column;
        height: 55%;
        border: 1px solid grey;
        align-items: center;
        border-radius: 5px;
    }
    .content span
    {
        padding-left: 3%;
        font-size: 130%;
        align-self: start;
    }
    .content>input
    {
        height: 70%;
        background: transparent;
        border: none;
        border-bottom: 2px solid grey;
        border-top: 2px solid grey;
        font-size: 130%;
        color: white;
        width: 98%;
        outline: none;
        padding: 4px;
        margin-top: 10px;
    }
    .content textarea 
    {
        height: 70%;
        width: 98%;
        background: transparent;
        border: none;
        border-bottom: 2px solid grey;
        border-top: 2px solid grey;
        font-size: 130%;
        color: black;
        outline: none;
        padding: 4px;
        margin-top: 10px;
        color: white;
        resize: none; /* 🔒 disables resizing */`
    }
    input:focus
    {
        border: none;
        border-bottom: 2px solid grey;
        color: white;
    }
    #sub
    {
        height: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    button[type="submit"]
    {
        background: transparent;
        backdrop-filter: blur(15px);
        width: 100px;
        height: 50%;
        color: white;
        font-size: 130%;
        border: 1px solid black;
        border-radius: 5px;
        transition: ease-in-out all 3s;
    }
     @keyframes glowLoop {
  0%   { box-shadow: 0 0 5px #00f; }
  50%  { box-shadow: 0 0 20px #0ff; }
  100% { box-shadow: 0 0 5px #00f; }
}

button {
  animation: glowLoop 2s ease-in-out infinite;
}

</style>
</body>
</html>
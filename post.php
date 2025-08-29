<?php
session_start();
include 'db.php';

// Check if a post ID was passed via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$post_id = intval($_GET['id']); // Sanitize input

// Fetch the post and its author's name
$stmt = $conn->prepare("
    SELECT p.title, p.content, p.created_at, p.rating, u.username 
    FROM posts p 
    JOIN users u ON p.user_id = u.id 
    WHERE p.id = ?
");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($post['title']) ?></title>
    <!--link rel="stylesheet" href="assets/style.css"-->
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
</head>
<body>
<div class="container">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
     <p id="out"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <small>
    <p id="likes"><span><?= $post['rating'] ?> </span>
        <button class="rating-btn" onclick="ratePost(<?= $post_id ?>)">👍</button>
    </p>
    <div class="author">
       <?= htmlspecialchars($post['username']) ?> | <?= $post['created_at'] ?></small>
    
    </div>
    <span class="last">
        <a href="index.php">Back to Latest Post</a>
    </span>
</div>
<script src="assets/script.js"></script>
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
    .container
    {
        width: 100%;
        height: 95%;
        backdrop-filter: blur(3px);
        background: transparent;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.0.05);
        display: flex;
        flex-direction: column;
        justify-content: center;
        font-size: 120%;
        overflow-y: scroll;
    }
    .author
    {
        display: flex;
        margin-top: 3%;
        flex-direction: column;
        height: 5%;
        font-size: 120%;
        padding-left: 10px;
        background: rgba(0, 0, 0, 0.7);
        justify-content: center;
    }
    #likes
    {
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: end;
    }
    #out
    {
        display: block;
        max-height: 65%;
        overflow: scroll;
        padding: 4px 10px;
        background: rgba(0,0,0,0.7);
    }
    #likes button
    {
        background: transparent;
        border: none;
    }
    .last
    {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 10%;
        border: 4px green;
    }
    .last a
    {
        text-decoration: none;
        border-radius: 5px;
        padding: 4px;
    }
           @keyframes glowLoop {
  0%   { box-shadow: 0 0 5px #00f; }
  50%  { box-shadow: 0 0 20px #0ff; }
  100% { box-shadow: 0 0 5px #00f; }
}

.last a{
  animation: glowLoop 2s ease-in-out infinite;
}

</style>
</body>
</html>

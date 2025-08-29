<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eXor blog</title>
    <link rel="shortcut icon" href="assets/xor.png" type="image/png">
</head>
<body>
   <!--button id="themeToggle">🌙</button-->
<div id="bod">
      <?php
session_start();
include 'db.php';

// Latest post
$latest = $conn->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id=u.id ORDER BY p.created_at DESC LIMIT 1")->fetch_assoc();

// Second latest post
$second = $conn->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id=u.id ORDER BY p.created_at DESC LIMIT 1 OFFSET 1")->fetch_assoc();
?>
<h1 id="btf">Previously on eXor blog</h1>
<?php if ($latest): ?>
    <div class="message">
        <h2 id="head_message"><?= htmlspecialchars($latest['title']) ?></h2>
    <p id="message"><?= nl2br(htmlspecialchars($latest['content'])) ?></p>
   <small><?= htmlspecialchars($latest['username']) ?> - <?= $latest['created_at'] ?></small>
    </div>
     
<?php endif; ?>

<?php if ($second): ?>
    <form method="GET" action="post.php" id="under">
        <input type="hidden" name="id" value="<?= $second['id'] ?>">
            <button type="submit" id="prev">Prev</button>
        <p>
            <span>
            <?= $latest['rating'] ?>
        </span><button onclick="ratePost(<?= $latest['id'] ?>)" id="like">👍</button></p>
    </form>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <div class="farm">
        <a href="create_post.php">Write a Post</a> | <a href="logout.php">Logout</a>
    </div>
<?php else: ?>
    <div class="farm">
        <a href="login.php">Login</a><span id="sep">|</span><a href="signup.php">Sign Up</a>
    </div>
<?php endif; ?>

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
    a:hover
    {
        text-decoration: underline;
    }
    #prev
    {
        background-color: black;
    }
    h1
    {
        font-weight: unset;
        background-color: rgba(0,0,0,0.7);
    }
    #bod
    {
        display:flex;
        backdrop-filter: blur(13px);
        width: 95%;
        height: 95%;
        flex-direction: column;
        border: 2px solid gray;
        border-radius: 5px;
        padding: 4px;
    }
    #head_message
    {
        color: white;
        text-align: right;
        font-size: 150%;
        height: 20%;
        align-items: center;
        justify-content: start;
        display: flex;
        padding-left: 10px;
    }
    .message
    {
        display: flex;
        flex-direction: column;
        height: 70%;
        width: 90%;
        align-self: center;
        border-radius: 10px;
        padding: 4px;
        border-bottom: 4px solid white;
        overflow-y: hidden;
    }
    #message
    {
        display: flex;
        font-size: 120%;
        height: 70%;
        max-height: 70%;
        padding-left: 10px;
        background: rgba(0,0,0,0.7);
        overflow-y:auto;
        line-height: 30px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.7);
    }
    #message::-webkit-scrollbar
    {
        width: 3px;
    }
    #message::-webkit-scrollbar-track
    {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 5px;
    }
    small
    {
        font-size: 120%;
        display: flex;
        flex-direction: column;
        height: 3%%;
        align-items: end;
        justify-content: center;
        background: rgba(0,0,0,0.7);
        margin-top: 5%;
    }
    #under
    {
        display: flex;
        flex-direction: row;
        height: 10%;
        margin-top: 5%;
        width: 90%;
        padding: 4px;
        align-items: center;
        font-size: 120%;
        justify-content: end;
    }
    #under *
    {
        display: flex;
    }
    #under > button
    {
        height: 70%;
        text-align: center;
        align-items: center;
        justify-content: center;
        width: 10%;
        background: unset;
        border-radius: 5px;
        font-weight: bold;
    }
    #like
    {
        background: transparent;
        border: none;
        height: 70%;
        width: 10%;
        background: unset;
        border-radius: 5px;
        font-weight: bold;
    }
    #under > p
    {
        display: flex;
        flex-direction: row;
        width: 25px;
        align-items: center;
        justify-content: space-evenly;
    }
    .farm
    {
        display: flex;
        flex-direction: row;
        color: black;
        width: 40%;
        height: 5%;
        border: 1px solid black;
        align-self: center;
        justify-content: space-evenly;
        border-radius: 5px;
        align-items: center;
        margin-top: 1%;
    }
    .farm a
    {
        text-decoration: none;
        color: white;
        transition: ease-in-out all 0.7s;
    }
         @keyframes glowLoop {
  0%   { box-shadow: 0 0 5px #00f; }
  50%  { box-shadow: 0 0 20px #0ff; }
  100% { box-shadow: 0 0 5px #00f; }
}

#sep, .farm, .farm:hover a {
  animation: glowLoop 2s ease-in-out infinite;
}
#themeToggle {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 999;
  padding: 10px 14px;
  border: none;
  border-radius: 50%;
  font-size: 18px;
  cursor: pointer;
  background-color: white; /* default (light mode) */
  color: black;
  box-shadow: 0 0 8px rgba(0,0,0,0.2);
  transition: all 0.3s ease;
}
body.dark-mode #themeToggle {
  background-color: #0078d4; /* blue for dark mode */
  color: white;
}


</style>
<script>
/*const toggleBtn = document.getElementById("themeToggle");
const body = document.body;

// Load saved theme from localStorage
if (localStorage.getItem("theme") === "dark") {
  body.classList.add("dark-mode");
  body.style.backgroundImage = 'url("assets/winD.jpg")';
  toggleBtn.textContent = "☀️";
}

// Toggle theme on click
toggleBtn.addEventListener("click", () => {
  body.classList.toggle("dark-mode");

  if (body.classList.contains("dark-mode")) {
    body.style.backgroundImage = 'url("assets/winD.jpg")';
    toggleBtn.style.backgroundColor = "#0078d4";
    toggleBtn.style.color = "white";
    toggleBtn.textContent = "☀️";
    localStorage.setItem("theme", "dark");
  } else {
    body.style.backgroundImage = 'url("assets/winL.jpg")';
    toggleBtn.style.backgroundColor = "white";
    toggleBtn.style.color = "black";
    toggleBtn.textContent = "🌙";
    localStorage.setItem("theme", "light");
  }
});*/
document.addEventListener("DOMContentLoaded", () => {
  const hasPost = document.querySelector(".message") || document.getElementById("under");
  const farm = document.querySelector(".farm");
  if (!hasPost && farm) {
    farm.style.position = "absolute";
    farm.style.top = "50%";
    farm.style.left = "50%";
    farm.style.transform = "translate(-50%, -50%)";
    farm.style.flexDirection = "column";
    farm.style.height = "auto";
    farm.style.padding = "10px";
    farm.style.gap = "10px";
    farm.style.background = "rgba(0,0,0,0.7)";
    const btf = document.getElementById("btf");
    btf.textContent = "Be the first to say something!";
    btf.style.textAlign = "center";
    btf.style.background = "transparent";
  }
});
</script>
</body>
</html>
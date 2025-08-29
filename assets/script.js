function ratePost(id) {
    fetch('rate_post.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + id
    }).then(() => location.reload());
}
const toggleBtn = document.getElementById("themeToggle");
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
});


module.exports = {
  root: "C:/xampp/htdocs/x/xor", // ✅ Serves files from your project directory

  watch: {
    files: ["**/*.php", "**/*.html", "**/*.css", "**/*.js"], // 🔁 Live reload on changes
    autoReload: true
  },

 /* proxy: {
    target: "http://localhost", // 🌐 Forwards requests to Apache (XAMPP)
    rewrite: (path) => path
  },*/

  php: "C:/xampp/php/php.exe", // 🧠 Direct PHP rendering without Apache

  open: true, // 🌍 Automatically opens browser on server start

  notify: true, // 🔔 Desktop notifications on reload or errors

  injectCss: true, // 🧪 CSS updates without full page reload

  cleanUrls: true // 🧼 Removes .html from URLs (e.g., /about instead of /about.html)
};

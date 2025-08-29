# Blogging Site — eXor Blog

A self-crafted blogging platform built entirely with **HTML**, **CSS**, **JavaScript**, **PHP**, and **MySQL**.  
All files in this repository are handwritten — no frameworks, no generators — just raw code and logic.

Project completed at the **TIC Foundation**, Yaoundé branch.

---

## Setup Instructions

To run this project locally, you’ll need:

- A server stack with **Apache**, **MySQL**, and **PHP 7+**
- We recommend [XAMPP](https://www.apachefriends.org/fr/index.html) for easy setup

### Installation Steps

1. Download and install XAMPP
2. Open the XAMPP Control Panel
3. Start **Apache** and **MySQL**
4. Open your browser and go to:  
   `localhost/phpmyadmin/index.php`
5. Create the database:
   ```sql
   CREATE DATABASE xor_blog;
   USE xor_blog;
6. Import the schema:
   Go to the SQL tab
   Paste and run the contents of createdb.sql from this repo
7. Copy all repository files into: C:\xampp\htdocs\your_choice (Replace your_choice with your desired folder name)
8. Visit: localhost/your_choice If setup correctly, you’ll see the homepage with the message: "Be the first to say something" along with Login and Signup buttons.
9. How the Site Works
   The site is designed for blogging with simplicity and clarity
   Built for desktops and laptops, but responsive across devices
   The homepage (index.php) displays the latest post from the database
   If no posts exist, it shows a fallback message
   Users can:
   Sign up
   Log in
   Create posts (title + content — text only)
   Posts are stored securely and displayed dynamically
10. Resetting the Database
  To reset the blog system:
  Visit: localhost/your_choice/reset
  Enter the admin credentials:
  Username: xor
  Password: 123456
  This will:
  Delete all posts and users
  Reset auto-increment counters
  Restore the database to a clean state

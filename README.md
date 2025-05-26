# Pet Adoption System
Pet Adoption System
A PHP & MySQL-based pet adoption platform where users can browse available pets, submit adoption requests, and admins manage those requests.

Project Structure
📄 index.php → Displays available pets 📄 adopt.php → Handles adoption requests 📄 db.txt → Contains SQL script for database setup

Installation & Setup
1️⃣ Clone or Download the Repository
Download the files and place them inside your local server directory (e.g., htdocs for XAMPP).

2️⃣ Set Up the Database
Open phpMyAdmin or your preferred MySQL interface.

Run the SQL commands from db.txt to:

Create the padpt database.

Set up tables: pets, adoptions, admin, requests.

Insert default admin credentials.

3️⃣ Start the Server
Ensure Apache and MySQL servers are running.

Open your browser and visit:

http://localhost/index.php
Admin Credentials
Default login (change after first use for security):

Username: admin

Password: admin123

Usage
Homepage (index.php)
Lists pets available for adoption.

Users can click "Adopt" to start the request process.

Adoption Form (adopt.php)
Users enter:

Name

Contact Information

Custom Message

The request is saved in the adoptions or requests table.

Features
✔ List of available pets ✔ Simple adoption request system ✔ Admin authentication ✔ Database-ready admin dashboard

Planned Improvements
🔹 Admin panel for pet & request management 🔹 Pet image uploads 🔹 Email notifications for adoption requests 🔹 Enhanced security (password hashing, input sanitization)

License
This project is open-source and free to modify.

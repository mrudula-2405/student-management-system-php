Student Management System
Project Overview

The Student Management System is a web-based application developed using PHP and MySQL. The system enables efficient management of student records through core database operations. It demonstrates backend development, database connectivity, and structured application design.

This project was developed to strengthen understanding of CRUD operations, server-side scripting, and relational database integration.

Features

Add new student records
View existing student details
Update student information
Delete student records
MySQL database connectivity
Structured and user-friendly interface

Technologies Used

Frontend: HTML, CSS
Backend: PHP
Database: MySQL
Server Environment: XAMPP
Version Control: Git and GitHub

Installation and Setup

Step 1: Install XAMPP
Download and install XAMPP. Start Apache and MySQL services from the XAMPP Control Panel.

Step 2: Clone the Repository

git clone https://github.com/mrudula-2405/student-management-system-php.git

Step 3: Move the Project Folder

Place the project folder inside:

C:\xampp\htdocs\

Step 4: Create Database

Open the browser and navigate to:

http://localhost/phpmyadmin

Create a new database named:

stud_info

Create the required tables according to the project structure.

Step 5: Configure Database Connection

Ensure the database connection in the PHP file is configured as:

$conn = new mysqli("localhost", "root", "", "stud_info", 3306);

Step 6: Run the Project

Open the browser and navigate to:

http://localhost/student_management_system/student_management_system.php

Learning Outcomes

Implementation of CRUD operations using PHP
Integration of PHP with MySQL database
Understanding of form handling and server-side validation
Experience with local server configuration using XAMPP
Version control management using Git and GitHub

Future Enhancements

Authentication and login system
Search and filter functionality
Dashboard with analytics
Deployment to a live hosting environment

Author

Mrudula Mane
GitHub Profile: https://github.com/mrudula-2405

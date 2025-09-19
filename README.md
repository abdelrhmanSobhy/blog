# 📝 PHP & MySQL Blog System

A **dynamic blog system** built with **PHP** and **MySQL**, demonstrating core backend and frontend development skills.  
This project includes **secure user authentication**, full **CRUD** (Create, Read, Update, Delete) for blog posts, and a clean, user-friendly interface.

---

## ✨ Features

- 🔑 **User Authentication** – Register and log in securely  
- 📝 **Post Management (CRUD)** – Create, edit, delete, and view posts  
- 🌍 **Public Viewing** – Anyone can browse posts without logging in  
- 🗣 **Multi-Language Ready** – `/languages` folder supports localization  
- 🔐 **Secure Config** – Database credentials stored in a `.env` file  
- 🎨 **Clean UI** – Built with HTML, CSS, and Bootstrap  

---

## 🛠 Technology Stack

- **Backend:** PHP  
- **Database:** MySQL  
- **Frontend:** HTML5, CSS3, Bootstrap  
- **Environment:** XAMPP / WAMP / MAMP  

---

## 🚀 Getting Started

Follow these steps to run the project locally:

### 1️⃣ Prerequisites

- Install **XAMPP**, **WAMP**, or **MAMP**
- Make sure **PHP ≥ 7.4** and **MySQL** are enabled
- Install **Git** (optional but recommended)

---

### 2️⃣ Clone the Repository

```bash
git clone https://github.com/abdelrhmanSobhy/blog.git
cd blog
3️⃣ Set Up the Database

Open phpMyAdmin

Create a new database (e.g. blog)

Import database.sql (found in the project root)

Verify that tables were created successfully

4️⃣ Configure the Environment

Inside /db, create a .env file (or copy .env.example if you have one):

DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=blog


Note: Never commit .env to GitHub. It contains sensitive data.

5️⃣ Run the Application

Move the project folder to your web server root (htdocs in XAMPP) and open:

http://localhost/blog/


You should now see the blog homepage. 🎉

📂 Project Structure
blog/
├── assets/           # CSS, JS, images
├── db/               # Database connection + .env config
│   └── connection.php
├── handlers/         # Logic for login, register, post actions
├── inc/              # Reusable includes (header, footer)
├── languages/        # Language files
├── database.sql      # Database schema
├── index.php         # Homepage (post listing)
├── addPost.php       # Add new post
├── editPost.php      # Edit existing post
├── viewPost.php      # View a single post
├── login.php         # User login
├── register.php      # User registration
├── contact.php       # Contact page
└── about.php         # About page

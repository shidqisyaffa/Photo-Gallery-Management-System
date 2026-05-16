# 📸 Photo Gallery Management System

Welcome to the Photo Gallery Management System! 👋

This is a beginner-friendly web application built with **CodeIgniter 3** and **MySQL**. It is designed as an academic project to help you understand how to build a CRUD (Create, Read, Update, Delete) system with image upload features.

Don't worry if you're new to PHP or web development—this guide will walk you through the setup process step-by-step, just like a tutor! Let's get your gallery up and running. 🚀

---

## 📦 1. Requirements

Before we start, make sure you have the following installed on your computer:
* **XAMPP**: This will give us a local server (Apache) and a database (MySQL).
* **A Web Browser**: Google Chrome, Mozilla Firefox, or Microsoft Edge.

---

## ⚙️ 2. Installation Steps

We are going to merge the files you have here with the core CodeIgniter 3 files.

1. **Download CodeIgniter 3:** Go to the [CodeIgniter 3 Download Page](https://codeigniter.com/download) and download the `.zip` file for Version 3.
2. **Extract to `htdocs`:** Extract the contents of the zip file into your XAMPP `htdocs` folder. Rename the extracted folder to exactly `prak_sismul_tugas`.
   * *Path should look like this:* `C:\xampp\htdocs\prak_sismul_tugas\`
3. **Merge Our Project Files:** Copy all the files from this project (the models, controllers, views, and `gallery_db.sql`) and paste them inside your new `prak_sismul_tugas` folder.
   * If Windows asks if you want to "Replace or Skip Files", choose **Replace** (or merge). This safely adds our custom code into the CodeIgniter system without breaking it!

---

## 🗄️ 3. Database Setup

Next, let's give our app a database to store category and photo information.

1. **Start XAMPP:** Open your XAMPP Control Panel and click **Start** next to **Apache** and **MySQL**.
2. **Open phpMyAdmin:** Open your web browser and go to `http://localhost/phpmyadmin`.
3. **Create the Database:** 
   * Click on **New** in the left sidebar.
   * Enter `gallery_db` as the database name and click **Create**.
4. **Import the Tables:**
   * Click on your newly created `gallery_db` database on the left.
   * Go to the **Import** tab at the top.
   * Click **Choose File** and select the `gallery_db.sql` file from your project folder (`C:\xampp\htdocs\prak_sismul_tugas\gallery_db.sql`).
   * Scroll down and click **Go**.
5. **What to Expect:** You should see a green success message, and two tables (`categories` and `photos`) will appear inside your database.

---

## 🔌 4. Configuration

We need to tell our app how to talk to the database and where it lives on your computer.

1. **Connect to the Database:**
   * Open the file: `application/config/database.php`
   * Scroll down to around line 78 and make sure it looks exactly like this:
     ```php
     'hostname' => 'localhost',
     'username' => 'root',
     'password' => '',
     'database' => 'gallery_db',
     ```
   * *(Note: `root` is the default username for XAMPP, and the password is usually left empty!)*

2. **Set the Base URL:**
   * Open the file: `application/config/config.php`
   * Scroll to around line 26 and find `$config['base_url']`. Change it to:
     ```php
     $config['base_url'] = 'http://localhost/prak_sismul_tugas/';
     ```

---

## ▶️ 5. Running the Project

You are all set! Let's see your hard work in action.

1. Open your web browser.
2. Visit this URL: `http://localhost/prak_sismul_tugas/`
3. **Expected Result:** You should see the beautiful **Photo Gallery Management** page load up successfully!

---

## 🧪 6. Testing Features

Try these out to make sure everything is working perfectly:

* **Add a Category:** Click "Categories" in the top menu, then click "Add New Category". Try creating a category named "Vacation".
* **Upload a Photo:** Go back to "Photos" and click "Upload New Photo". Fill in the title, select your new "Vacation" category, and pick an image from your computer. You'll see a cool preview before you even upload! Click "Upload Photo".
* **Delete a Photo:** Try clicking the red "Delete" button under a photo to see it magically disappear from both the page and the database.

---

## ❗ 7. Common Errors & Fixes

Running into a hiccup? Don't panic! Here are the most common issues and how to fix them:

* **Error:** "Database connection error"
  * *Fix:* Double-check your `application/config/database.php` file. Ensure the username is `root`, the password is empty `''`, and the database name is `gallery_db`. Also, make sure MySQL is running in your XAMPP Control Panel.
* **Error:** "404 Page Not Found"
  * *Fix:* Make sure your folder in `htdocs` is named exactly `prak_sismul_tugas`. Also, check that your `$config['base_url']` in `application/config/config.php` matches this folder name.
* **Error:** "Upload failed" or "File type not allowed"
  * *Fix:* Ensure you are uploading a valid image file (JPG, PNG, GIF) and that it is under 2MB in size. 
* **Error:** A completely blank page
  * *Fix:* This usually means there's a typo in your PHP code. Check the files you edited in the configuration step to make sure you didn't accidentally delete a quote (`'`) or a semicolon (`;`).

---

## 💡 8. Notes

* This project is fully self-contained and **runs locally** on your computer. You do not need web hosting or an internet connection to use it once downloaded.
* It is specifically designed as an **academic demo**, keeping the code simple, clean, and easy to understand for beginners learning MVC (Model-View-Controller) architecture.

**Happy Coding! 🎉**

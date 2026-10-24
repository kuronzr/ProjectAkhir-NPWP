# Yaudah LostnFound

A PHP-based Lost & Found platform designed for reporting lost items and found items in a campus or community environment. This project allows users to submit reports, browse recent cases, contact the reporter, and manage complaint/testimonial features in a simple web application.

## Project Overview

This application is built to help people quickly find missing belongings and reconnect them with the rightful owners. Users can:

- report lost items
- report found items
- view recent reports by category
- contact the reporter directly
- submit complaints and testimonials
- access admin features to review and remove reports

The app uses a classic PHP + MySQL approach with separate models, controllers, and views to keep the project structured and easy to understand.

## Features

- User registration and login
- Lost item reporting form
- Found item reporting form
- Category-based search and filtering
- Image upload support for reports
- Admin dashboard for complaint review and report deletion
- Customer service / complaint form
- Testimonial page
- Responsive user interface with custom CSS and JavaScript

## Tech Stack

- PHP 7+
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- Native PHP session-based authentication

## Project Structure

```text
ProjectAkhir-NPWP/
├── config/
│   ├── auth.php
│   └── Database.php
├── control/
│   ├── proses_hpuslapor.php
│   ├── proses_keluhan.php
│   ├── proses_khilangan.php
│   ├── proses_nemu.php
│   ├── proses_profil.php
│   ├── proses_slesaiLapor.php
│   ├── proses_testi.php
│   └── proses_veriv.php
├── model/
│   ├── gambarModel.php
│   ├── keluhanModel.php
│   ├── laporModel.php
│   ├── testiModel.php
│   └── userModel.php
├── public/
│   ├── css/
│   ├── gambar/
│   ├── js/
│   └── uploads/
├── view/
│   ├── about.php
│   ├── adminkeluh.php
│   ├── form_keluhan.php
│   ├── form_khilangan.php
│   ├── form_nemu.php
│   ├── form_testi.php
│   ├── home.php
│   ├── login.php
│   ├── profile.php
│   ├── regis.php
│   └── testimoni.php
├── README.md
├── sintaks database.txt
└── ...
```

## Database Setup

1. Create a MySQL database named `LnfUAS_DB`.
2. Use the SQL schema provided in `sintaks database.txt`.
3. Configure your database connection in `config/Database.php` if needed.

Default configuration:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db = "LnfUAS_DB";
```

## Running the Project

### Option 1: Using XAMPP / Laragon

1. Put the project folder in your local web server directory, such as `htdocs`.
2. Start Apache and MySQL.
3. Import the database schema from `sintaks database.txt`.
4. Open the app in your browser:

```text
http://localhost/ProjectAkhir-NPWP/view/home.php
```

### Option 2: Built-in PHP server

If you want to run it directly from the terminal:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000/view/home.php
```

## Default Usage

- Guests can browse the home page and see public reports.
- Registered users can submit lost/found reports and testimonials.
- Admin users can manage complaints and remove postings.

## Notes

- The project stores uploaded images in `public/uploads`.
- Some forms and actions are routed through files in the `control/` folder.
- The project is best suited for local development and academic use.

## License

This project is intended for educational and learning purposes. Please check with the project owner before using it for commercial deployment.

## Contributor

This repository is a PHP web application project for a Lost & Found system, developed as part of an academic assignment or course project.


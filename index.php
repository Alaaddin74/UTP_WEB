<!DOCTYPE html>
<html>
<head>
    <title>Car Wash Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #86B6F6;
            color: black;
            text-align: center;
            padding: 1em 0;
        }
        .navbar {
            overflow: hidden;
            background-color: #B4D4FF;
            display: flex;
            justify-content: center;
        }
        .navbar a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #86B6F6;
            color: white;
        }
        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .content img {
            max-width: 40%;
            height: auto;
            margin-right: 20px;
        }
        .content .text {
            max-width: 50%;
        }
        .content h1 {
            font-size: 50px;
            color: #86B6F6;
        }
        .content p {
            font-size: 15px;
            color:black;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Car Wash Management System</h1>
    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="customers.php">Manage Customers</a>
        <a href="cars.php">Manage Cars</a>
        <a href="services.php">Manage Services</a>
        <a href="bookings.php">Manage Bookings</a>
    </div>

    <div class="content">
        <img src="mobil.jpg" alt="mobil">
        <div class="text">
            <h1>Welcome to Car Wash Management System</h1>
            <p>The Car Wash Company is a business that aims to provide cleaning and maintenance services for motorized vehicles, 
                especially cars and motorbikes. This business is very important because cars and motorbikes are vehicles that are widely used by modern society, 
                so cleanliness and maintenance are very necessary.</p>
        </div>
    </div>

    <div class="footer">
    <p>&copy; 2024 Car Wash Management System. All rights reserved.</p>
    <div class="social-icons">
        <a href="https://wa.me/083181296513" target="_blank"><img src="whatsapp.png" alt="WhatsApp"></a>
        <a href="https://www.instagram.com/fad_dillahh?igsh=MXFjaTl2MXd2YzUyMQ%3D%3D&utm_source=qr " target="_blank"><img src="instagram.png" alt="Instagram"></a>
        <a href="mailto:fadillahd544@gmail.com"><img src="email_icon.png" alt="Email"></a>
        <a href="https://github.com/fadillah2217051138/Car-Wash" target="_blank"><img src="github_icon.png" alt="GitHub"></a>
    </div>
    </div>
</body>
</html>

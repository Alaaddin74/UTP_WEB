<?php
include 'db.php';

// Create, Read, Update, Delete operations

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Car Wash Management System</h1>
    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="customer.php">Manage Customers</a>
        <a href="cars.php">Manage Cars</a>
        <a href="services.php">Manage Services</a>
        <a href="bookings.php">Manage Bookings</a>
    </div>

    <div class="content">
        <h2>Manage Customers</h2>
        
        <form method="post" action="customer.php">
            <input type="hidden" name="id" value="<?php echo isset($customer['id']) ? $customer['id'] : ''; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($customer['name']) ? $customer['name'] : ''; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo isset($customer['email']) ? $customer['email'] : ''; ?>" required>
            <input type="text" name="phone" placeholder="Phone" value="<?php echo isset($customer['phone']) ? $customer['phone'] : ''; ?>" required>
            <button type="submit" name="<?php echo isset($customer['id']) ? 'update' : 'create'; ?>">
                <?php echo isset($customer['id']) ? 'Update' : 'Create'; ?>
            </button>
        </form>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <a href="customer.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    <a href="customer.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2024 Car Wash Management System. All rights reserved.</p>
    </div>

</body>
</html>

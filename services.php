<?php
include './db.php';

// Create
if (isset($_POST['create'])) {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO Services (service_name, description, price) VALUES ('$service_name', '$description', '$price')";
    $conn->query($sql);
}

// Read
$sql = "SELECT * FROM Services";
$result = $conn->query($sql);

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE Services SET service_name='$service_name', description='$description', price='$price' WHERE id=$id";
    $conn->query($sql);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM Services WHERE id=$id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Services</title>
</head>
<body>
    <h1>Manage Services</h1>

    <form method="post" action="services.php">
        <input type="hidden" name="id" value="<?php echo isset($service['id']) ? $service['id'] : ''; ?>">
        <input type="text" name="service_name" placeholder="Service Name" value="<?php echo isset($service['service_name']) ? $service['service_name'] : ''; ?>" required>
        <textarea name="description" placeholder="Description" required><?php echo isset($service['description']) ? $service['description'] : ''; ?></textarea>
        <input type="text" name="price" placeholder="Price" value="<?php echo isset($service['price']) ? $service['price'] : ''; ?>" required>
        <button type="submit" name="<?php echo isset($service['id']) ? 'update' : 'create'; ?>">
            <?php echo isset($service['id']) ? 'Update' : 'Create'; ?>
        </button>
    </form>

    <table border="1">
        <tr>
            <th>Service Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['service_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <a href="services.php?edit=<?php echo $row['id']; ?>">Edit</a>
                <a href="services.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

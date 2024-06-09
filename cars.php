<?php
include 'db.php';

// Create
if (isset($_POST['create'])) {
    $customer_id = $_POST['customer_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];

    $sql = "INSERT INTO Cars (customer_id, make, model, year) VALUES ('$customer_id', '$make', '$model', '$year')";
    $conn->query($sql);
}

// Read
$sql = "SELECT Cars.*, Customer.name as customer_name FROM Cars JOIN Customer ON Cars.customer_id = Customer.id";
$result = $conn->query($sql);

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];

    $sql = "UPDATE Cars SET customer_id='$customer_id', make='$make', model='$model', year='$year' WHERE id=$id";
    $conn->query($sql);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM Cars WHERE id=$id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Cars</title>
</head>
<body>
    <h1>Manage Cars</h1>

    <form method="post" action="cars.php">
        <input type="hidden" name="id" value="<?php echo isset($car['id']) ? $car['id'] : ''; ?>">
        <select name="customer_id" required>
            <option value="">Select Customer</option>
            <?php
            $customers = $conn->query("SELECT * FROM Customer");
            while ($customer = $customers->fetch_assoc()) {
                echo "<option value='" . $customer['id'] . "'>" . $customer['name'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="make" placeholder="Make" value="<?php echo isset($car['make']) ? $car['make'] : ''; ?>" required>
        <input type="text" name="model" placeholder="Model" value="<?php echo isset($car['model']) ? $car['model'] : ''; ?>" required>
        <input type="text" name="year" placeholder="Year" value="<?php echo isset($car['year']) ? $car['year'] : ''; ?>" required>
        <button type="submit" name="<?php echo isset($car['id']) ? 'update' : 'create'; ?>">
            <?php echo isset($car['id']) ? 'Update' : 'Create'; ?>
        </button>
    </form>

    <table border="1">
        <tr>
            <th>Customer</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['make']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td>
                <a href="cars.php?edit=<?php echo $row['id']; ?>">Edit</a>
                <a href="cars.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

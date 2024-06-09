<?php
include './db.php';

// Create or Update
if (isset($_POST['create']) || isset($_POST['update'])) {
    $customer_id = $_POST['customer_id'];
    $car_id = $_POST['car_id'];
    $service_id = $_POST['service_id'];
    $booking_date = $_POST['booking_date'];

    if (isset($_POST['create'])) {
        $stmt = $conn->prepare("INSERT INTO bookings (customer_id, car_id, service_id, booking_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $customer_id, $car_id, $service_id, $booking_date);
    } else if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE bookings SET customer_id=?, car_id=?, service_id=?, booking_date=? WHERE id=?");
        $stmt->bind_param("iiisi", $customer_id, $car_id, $service_id, $booking_date, $id);
    }

    if ($stmt->execute()) {
        echo "Operation successful";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Deletion successful";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Read
$sql = "SELECT bookings.*, Customers.name as customer_name, Cars.make as car_make, Cars.model as car_model, Services.service_name FROM bookings 
        JOIN Customers ON bookings.customer_id = Customers.id 
        JOIN Cars ON bookings.car_id = Cars.id 
        JOIN Services ON bookings.service_id = Services.id";
$result = $conn->query($sql);

// Fetch for edit
$booking = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultEdit = $stmt->get_result();
    $booking = $resultEdit->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage bookings</title>
    <link rel="stylesheet" href="./style.css">
    <link href="./output.css" rel="stylesheet">
    </head>
<body>
    <div class="space-y-3">
        <div class="header">
            <h1>Manage Booking</h1>
        </div>
    
        <form class="max-w-lg mx-auto space-y-2" method="post" action="bookings.php">
            <label for="large" class="block mb-2 text-base font-medium text-gray-900">Select Option</label>
            <input type="hidden" name="id" value="<?php echo isset($booking['id']) ? $booking['id'] : ''; ?>">
            <select class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="customer_id" required>
                <option value="" selected>Select Customer</option>
                <?php
                $customers = $conn->query("SELECT * FROM Customers");
                while ($customer = $customers->fetch_assoc()) {
                    $selected = isset($booking['customer_id']) && $booking['customer_id'] == $customer['id'] ? 'selected' : '';
                    echo "<option value='" . $customer['id'] . "' $selected>" . $customer['name'] . "</option>";
                }
                ?>
            </select>

            <label for="large" class="block mb-2 text-base font-medium text-gray-900">Select Option</label>
            <select class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="car_id" required>
                <option value="" selected>Select Car</option>
                <?php
                $cars = $conn->query("SELECT * FROM Cars");
                while ($car = $cars->fetch_assoc()) {
                    $selected = isset($booking['car_id']) && $booking['car_id'] == $car['id'] ? 'selected' : '';
                    echo "<option value='" . $car['id'] . "' $selected>" . $car['make'] . " " . $car['model'] . "</option>";
                }
                ?>
            </select>

            <label for="large" class="block mb-2 text-base font-medium text-gray-900">Select Option</label>
            <select name="service_id" class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="" selected>Select Service</option>
                <?php
                $services = $conn->query("SELECT * FROM Services");
                while ($service = $services->fetch_assoc()) {
                    $selected = isset($booking['service_id']) && $booking['service_id'] == $service['id'] ? 'selected' : '';
                    echo "<option value='" . $service['id'] . "' $selected>" . $service['service_name'] . "</option>";
                }
                ?>
            </select>

            <div class="flex justify-between py-4">
                <input type="date" name="booking_date" value="<?php echo isset($booking['booking_date']) ? $booking['booking_date'] : ''; ?>" required class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <button type="submit" name="<?php echo isset($booking['id']) ? 'update' : 'create'; ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    <?php echo isset($booking['id']) ? 'Update' : 'Create'; ?>
                </button>
            </div>
        </form>

        <div class="rounded-md relative overflow-x-auto space-y-4 max-w-screen-xl mx-auto">
            <table class="space-y-4 w-full text-sm text-left rtl:text-right text-gray-500" border="1">
                <thead class=" text-xs text-gray-700 uppercase bg-cyan-400">
                    <tr>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Car</th>
                        <th class="px-6 py-3">Service</th>
                        <th class="px-6 py-3">Booking Date</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4"><?php echo $row['customer_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $row['car_make'] . " " . $row['car_model']; ?></td>
                        <td class="px-6 py-4"><?php echo $row['service_name']; ?></td>
                        <td class="px-6 py-4"><?php echo $row['booking_date']; ?></td>
                        <td class="flex items-center px-6 py-4">
                            <a class="font-medium text-blue-600 hover:underline" href="bookings.php?edit=<?php echo $row['id']; ?>">Edit</a>
                            <a class="font-medium text-red-600 hover:underline ms-3" href="bookings.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>

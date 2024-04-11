<?php
include 'include/db_connect.php';

$name = $_POST['name'];
$manufacturer = $_POST['manufacturer'];
$description = $_POST['description'];
$rent_price_per_day = $_POST['rent_price_per_day'];
$quantity_in_store = $_POST['quantity_in_store'];

$sql = "INSERT INTO equipment (name, manufacturer, description, rent_price_per_day, quantity_in_store) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdi", $name, $manufacturer, $description, $rent_price_per_day, $quantity_in_store);

if ($stmt->execute()) {
    echo "New equipment added successfully";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>

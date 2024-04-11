<?php
include 'include/db_connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$manufacturer = $_POST['manufacturer'];
$description = $_POST['description'];
$rent_price_per_day = $_POST['rent_price_per_day'];
$quantity_in_store = $_POST['quantity_in_store'];

$sql = "UPDATE equipment SET name = ?, manufacturer = ?, description = ?, rent_price_per_day = ?, quantity_in_store = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdi", $name, $manufacturer, $description, $rent_price_per_day, $quantity_in_store, $id);

if ($stmt->execute()) {
    echo "Equipment updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>

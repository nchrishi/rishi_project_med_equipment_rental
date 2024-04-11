<?php
include 'include/db_connect.php';

// Get the equipment ID from the URL
$id = $_GET['id'];

// Prepare SQL query to delete the equipment
$sql = "DELETE FROM equipment WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
    echo "Equipment deleted successfully";
    // Redirect back to the equipment list or a confirmation page
    header("Location: update_equipment.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the connection
$conn->close();
?>

<?php
include 'db_connect.php';

if (isset($_GET['rental_id'])) {
    $rental_id = $_GET['rental_id'];

    $sql = "SELECT r.client_id, r.equipment_id, r.start_date, r.end_date, e.rent_price_per_day, DATEDIFF(r.end_date, r.start_date) AS rental_days
            FROM rentals r
            JOIN equipment e ON r.equipment_id = e.id
            WHERE r.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rental_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rental = $result->fetch_assoc();

    if ($rental) {
        $total_cost = $rental['rental_days'] * $rental['rent_price_per_day'];
        echo "<h2>Rental Receipt</h2>";
        echo "Client ID: " . $rental['client_id'] . "<br>";
        echo "Equipment ID: " . $rental['equipment_id'] . "<br>";
        echo "Rental Period: " . $rental['start_date'] . " to " . $rental['end_date'] . "<br>";
        echo "Total Cost: $" . $total_cost . "<br>";
    } else {
        echo "Rental not found.";
    }
} else {
    echo "No rental ID provided.";
}
$conn->close();
?>

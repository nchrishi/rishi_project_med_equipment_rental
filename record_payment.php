<?php
include 'db_connect.php';

// Get data from form
$rental_id = $_POST['rental_id'];
$client_id = $_POST['client_id'];
$amount = $_POST['amount'];
$payment_date = date('Y-m-d'); // Assuming payment is made on the current date

// Start transaction
$conn->begin_transaction();

try {
    // Insert payment record
    $insert_sql = "INSERT INTO payments (rental_id, client_id, amount, payment_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("iiis", $rental_id, $client_id, $amount, $payment_date);
    $stmt->execute();

    // Update the rental record to mark as paid
    $update_sql = "UPDATE rentals SET is_paid = TRUE WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $rental_id);
    $update_stmt->execute();

    // Commit the transaction
    $conn->commit();

    // Fetch additional details for the receipt
    $details_sql = "SELECT c.name AS client_name, e.name AS equipment_name, r.start_date, r.end_date
                    FROM clients c
                    JOIN rentals r ON c.id = r.client_id
                    JOIN equipment e ON r.equipment_id = e.id
                    WHERE r.id = ?";
    $details_stmt = $conn->prepare($details_sql);
    $details_stmt->bind_param("i", $rental_id);
    $details_stmt->execute();
    $details_result = $details_stmt->get_result();
    $details_row = $details_result->fetch_assoc();

} catch (Exception $e) {
    // If an error occurs, roll back the transaction
    $conn->rollback();
    echo "Error: " . $e->getMessage();
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .business-header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .receipt-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-bottom: 20px;
        }
        .print-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

        <div class="business-header">
        Rishi Medical Equipment Rental System<br>
        Cape Girardeau, MO
    </div>

    <div class="receipt-container">
        <div class="receipt-header">
            <h2>Payment Receipt</h2>
            <p>Date: <?php echo $payment_date; ?></p>
        </div>
        <div class="receipt-details">
            <p><strong>Client Name:</strong> <?php echo $details_row['client_name']; ?></p>
            <p><strong>Equipment Rented:</strong> <?php echo $details_row['equipment_name']; ?></p>
            <p><strong>Rental Period:</strong> <?php echo $details_row['start_date'] . " to " . $details_row['end_date']; ?></p>
            <p><strong>Amount Paid:</strong> $<?php echo number_format($amount, 2); ?></p>
        </div>
        <button onclick="window.print();" class="print-button">Print Receipt</button>
    </div>
</body>
</html>
 
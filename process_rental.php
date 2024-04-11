<?php
include 'db_connect.php';

// Retrieve input data from the form
$client_id = $_POST['client_id'] ?? '';
$equipment_id = $_POST['equipment_id'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';
$total_price = $_POST['total_price'] ?? '';

$message = '';
$receipt = '';

// Check equipment availability
if ($client_id && $equipment_id && $start_date && $end_date && $total_price) {
    $sql = "SELECT * FROM rentals WHERE equipment_id = ? AND NOT (end_date < ? OR start_date > ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $equipment_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Equipment is not available
        $message = "Equipment is not available for the selected dates. Please choose different dates.";
    } else {
        // Equipment is available, proceed with rental
        // Insert rental record into database
        $insert_sql = "INSERT INTO rentals (client_id, equipment_id, start_date, end_date, total_price) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iissd", $client_id, $equipment_id, $start_date, $end_date, $total_price);
        $insert_stmt->execute();

        // Prepare receipt content
        $receipt = "Receipt: Client ID: $client_id, Equipment ID: $equipment_id, Start Date: $start_date, End Date: $end_date, Total Price: $" . number_format($total_price, 2);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            color: #d9534f;
            margin-bottom: 20px;
        }
        .receipt {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .receipt h2 {
            color: #5cb85c;
            border-bottom: 2px solid #5cb85c;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .receipt-details {
            line-height: 1.6;
            color: #555;
        }
        .receipt-details strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if ($receipt): ?>
            <h2>Rental Receipt</h2>
            <div class="receipt-details">
                <?php echo nl2br($receipt); // nl2br allows new lines in the receipt string to be converted to <br> ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

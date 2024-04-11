<?php
include 'db_connect.php';

$sql = "SELECT p.payment_id, p.rental_id, c.name as client_name, p.amount, p.payment_date 
        FROM payments p
        JOIN clients c ON p.client_id = c.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payments Report</title>
    <style>

         .print-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #17a2b8; /* Teal color to match your theme */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #e9ecef;
        color: #495057;
        margin: 0;
        padding: 20px;
    }
    .report-container {
        max-width: 800px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #dee2e6;
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #17a2b8; /* Teal color */
        color: white;
        font-weight: 600;
    }
    tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    tr:hover {
        background-color: #dfe2e6;
        transform: scale(1.02);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    /* Responsive Table */
    @media (max-width: 600px) {
        table, th, td {
            display: block;
        }
        th, td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        td:before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-weight: bold;
            text-align: left;
        }
    }
</style>

</head>
<body>
    <div class="report-container">
        <h2>Payments Report</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Rental ID</th>
                    <th>Client Name</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["payment_id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["rental_id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["client_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["amount"]); ?></td>
                        <td><?php echo htmlspecialchars($row["payment_date"]); ?></td>
                    </tr>
                <?php } ?>
            </table>

            <button onclick="window.print();" class="print-button">Print Report</button>

        <?php } else {
            echo "<p>No payments found.</p>";
        } ?>
    </div>
</body>
</html>

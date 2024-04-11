<?php
include 'db_connect.php';

$sql = "SELECT c.id, c.name, c.address, c.telephone, e.name AS equipment_name, r.start_date, r.end_date
        FROM clients c
        JOIN rentals r ON c.id = r.client_id
        JOIN equipment e ON r.equipment_id = e.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Report</title>
    
    <style>
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
        animation: fadeIn 1s ease-out;
    }
    h2 {
        color: #17a2b8; /* Teal color for heading */
        margin-bottom: 20px;
        font-weight: 600;
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
        background-color: #17a2b8; /* Teal color for table headers */
        color: white;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }
    th::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background: #fff;
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }
    th:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
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

    /* Keyframes for fadeIn animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
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

        .print-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #17a2b8; /* Teal color to match your theme */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <h2>Customer Report</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Equipment</th>
                    <th>Rental Period</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["address"]; ?></td>
                        <td><?php echo $row["telephone"]; ?></td>
                        <td><?php echo $row["equipment_name"]; ?></td>
                        <td><?php echo $row["start_date"] . " to " . $row["end_date"]; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <button onclick="window.print();" class="print-button">Print Report</button>
        <?php } else {
            echo "<p>No results found.</p>";
        } ?>
    </div>
</body>
</html>

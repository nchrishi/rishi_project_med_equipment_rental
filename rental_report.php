<?php
include 'db_connect.php';

$sql = "SELECT c.id as client_id, c.name as client_name, e.id as equipment_id, e.name as equipment_name, r.start_date, r.end_date 
        FROM rentals r 
        JOIN clients c ON r.client_id = c.id 
        JOIN equipment e ON r.equipment_id = e.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rental Report</title>
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
        <h2>Rental Report</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>Client ID</th>
                    <th>Client Name</th>
                    <th>Equipment ID</th>
                    <th>Equipment Name</th>
                    <th>Rental Period</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["client_id"]; ?></td>
                        <td><?php echo $row["client_name"]; ?></td>
                        <td><?php echo $row["equipment_id"]; ?></td>
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

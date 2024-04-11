<!DOCTYPE html>
<html>
<head>
    <title>Profit Report</title>
    <style>

        .print-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
           @media print {
            .print-button {
                display: none; /* Hide the print button when printing */
            }
            /* Add any other print styles here */
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
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2, h3 {
            color: #007bff;
            margin-bottom: 20px;
            font-weight: 600;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f8f9fa;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .summary {
            text-align: left;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <?php
        include 'db_connect.php';

        $selected_month = '2023-11'; // Change this to the desired month and year

        // Profit data query
        $sql_profit = "SELECT 
                            SUM(DATEDIFF(r.end_date, r.start_date) * e.rent_price_per_day) AS total_income, 
                            COUNT(r.id) AS total_rentals,
                            AVG(DATEDIFF(r.end_date, r.start_date)) AS average_rental_duration,
                            COUNT(DISTINCT r.client_id) AS total_unique_clients
                        FROM rentals r 
                        JOIN equipment e ON r.equipment_id = e.id 
                        WHERE r.start_date LIKE ?";

        // Income breakdown by equipment type
        $sql_breakdown = "SELECT 
                              e.name AS equipment_name, 
                              SUM(DATEDIFF(r.end_date, r.start_date) * e.rent_price_per_day) AS income
                          FROM rentals r
                          JOIN equipment e ON r.equipment_id = e.id
                          WHERE r.start_date LIKE ?
                          GROUP BY e.name";

        $month_param = $selected_month . '%';

        // Executing profit data query
        $stmt_profit = $conn->prepare($sql_profit);
        $stmt_profit->bind_param("s", $month_param);
        $stmt_profit->execute();
        $result_profit = $stmt_profit->get_result();
        $row_profit = $result_profit->fetch_assoc();

        // Executing breakdown data query
        $stmt_breakdown = $conn->prepare($sql_breakdown);
        $stmt_breakdown->bind_param("s", $month_param);
        $stmt_breakdown->execute();
        $result_breakdown = $stmt_breakdown->get_result();

        // Displaying the results
        echo "<h2>Profit Report for " . $selected_month . "</h2>";
        if ($row_profit) {
            echo "<div class='summary'>";
            echo "<p>Total Income: $" . number_format($row_profit['total_income'], 2) . "</p>";
            echo "<p>Total Number of Rentals: " . $row_profit['total_rentals'] . "</p>";
            echo "<p>Average Rental Duration: " . number_format($row_profit['average_rental_duration'], 2) . " days</p>";
            echo "<p>Total Number of Unique Clients: " . $row_profit['total_unique_clients'] . "</p>";
            echo "</div>";
        } else {
            echo "<p>No general profit data available for " . $selected_month . ".</p>";
        }

        echo "<h3>Income Breakdown by Equipment Type</h3>";
        if ($result_breakdown->num_rows > 0) {
            echo "<ul>";
            while ($row_breakdown = $result_breakdown->fetch_assoc()) {
                echo "<li>" . $row_breakdown['equipment_name'] . ": $" . number_format($row_breakdown['income'], 2) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No breakdown data available.</p>";
        }



        $conn->close();
        ?>
         <button onclick="window.print();" class="print-button">Print Report</button>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Take Order</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #43cea2, #185a9d);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }
        form {
            display: grid;
            gap: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
            text-align: left;
        }
        input[type="number"], input[type="date"] {
            padding: 12px;
            border-radius: 6px;
            border: 2px solid #e3e3e3;
            background-color: #f8f8f8;
            transition: border-color 0.3s ease-in-out;
            font-size: 14px;
        }
        input[type="number"]:focus, input[type="date"]:focus {
            outline: none;
            border-color: #43cea2;
            background-color: #fff;
        }
        input[type="submit"] {
            padding: 12px 20px;
            background-color: #43cea2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #36b29a;
        }
    </style>
</head>
<body>
    <?php
    include 'db_connect.php'; // Ensure this points to your actual database connection script
    $message = '';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $client_id = $_POST['client_id'];
        $equipment_id = $_POST['equipment_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        // Assuming you have a function to calculate the total price
        // You will need to create this function based on your pricing logic
        $total_price = calculateTotalPrice($equipment_id, $start_date, $end_date);

        // Prepare an SQL statement to insert the order
        $sql = "INSERT INTO rentals (client_id, equipment_id, start_date, end_date, total_price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("iissd", $client_id, $equipment_id, $start_date, $end_date, $total_price);
            if ($stmt->execute()) {
                $message = "Order taken successfully!";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
        $conn->close();
    }

    // Function to calculate total price (placeholder, implement your logic here)
    function calculateTotalPrice($equipment_id, $start_date, $end_date) {
        // Your logic to calculate the total price based on equipment and rental period
        // For now, it returns a fixed amount
        return 100.00;
    }
    ?>

    <div class="form-container">
        <h2>Take Client Order</h2>
        <form method="post" action="take_order.php">
            <!-- Form fields -->
            <label for="client_id">Client ID:</label>
            <input type="number" id="client_id" name="client_id" required>

            <label for="equipment_id">Equipment ID:</label>
            <input type="number" id="equipment_id" name="equipment_id" required>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <input type="submit" value="Submit Order">
        </form>
        <?php if ($message): ?>
        <script type="text/javascript">
            alert('<?php echo $message; ?>');
        </script>
        <?php endif; ?>
    </div>
</body>
</html>

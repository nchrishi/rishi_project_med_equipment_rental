<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
    <style>

                a {
            display: inline-block;
            background-color: #0070d2;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 10px;
        }
        a:hover, a:focus {
            background-color: #005fb8;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-image: url("medical2.jpg");
          background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 40px;
        }
        ul li {
            margin: 10px;
        }
        a {
            background-color: #ffffff;
            color: #0070d2;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        a:hover {
            background-color: #0070d2;
            color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .form-section {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            padding: 25px;
            width: 100%;
            max-width: 400px;
        }
        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        input[type=number] {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            width: calc(100% - 22px);
            margin-bottom: 15px;
        }
        input[type=submit] {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
        }
        input[type=submit]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Manager Dashboard</h1>
    <ul>
        <li><a href="update_inventory.php">Update Inventory</a></li>
        <li><a href="add_equipment.php">Add Equipment</a></li>
        <li><a href="take_order.php">Take Order</a></li>
        <li><a href="customer_report.php">Customer Report</a></li>
        <li><a href="rental_report.php">Rental Report</a></li>
        <li><a href="unpaid_report.php">Unpaid Amounts Report</a></li>
        <li><a href="payment_history.php">Payments Report</a></li>
        <li><a href="profit_report.php">Profit Report</a></li>
    </ul>

    <div class="form-section">
        <h2>Record a Payment</h2>
        <form action="record_payment.php" method="post">
            <label for="rental_id">Rental ID:</label>
            <input type="number" id="rental_id" name="rental_id" required>
            <label for="client_id">Client ID:</label>
            <input type="number" id="client_id" name="client_id" required>
            <label for="amount">Amount:</label>
            <input type="number" step="0.01" id="amount" name="amount" required>
            <input type="submit" value="Record Payment">
        </form>
    </div>
</body>
</html>

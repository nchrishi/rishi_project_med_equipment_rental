<!DOCTYPE html>
<html>
<head>
    <title>Add Equipment</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            color: #333;
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
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #ffffff;
            margin-bottom: 30px;
            font-weight: 600;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: 600;
            color: #333;
            text-align: left;
        }
        input[type="text"], input[type="number"] {
            padding: 12px;
            border-radius: 6px;
            border: 2px solid #e3e3e3;
            background-color: #f8f8f8;
            transition: border-color 0.3s ease-in-out;
            font-size: 14px;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            outline: none;
            border-color: #8e2de2;
            background-color: #fff;
        }
        input[type="submit"] {
            padding: 12px 20px;
            background-color: #8e2de2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #7a00d4;
        }
    </style>

    <?php
include 'db_connect.php'; // Make sure this path is correct

$message = ''; // Variable to hold messages for the user

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $manufacturer = $_POST['manufacturer']; // This input field is missing in your form
    $description = $_POST['description'];
    $rent_price_per_day = $_POST['rent_price_per_day'];
    $quantity_in_store = $_POST['quantity_in_store'];

    // Prepare an SQL statement to insert the new equipment
    $sql = "INSERT INTO equipment (name, manufacturer, description, rent_price_per_day, quantity_in_store) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sssdi", $name, $manufacturer, $description, $rent_price_per_day, $quantity_in_store);
        if ($stmt->execute()) {
            $message = "New equipment added successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Equipment</title>
    <!-- Your existing style here -->
</head>
<body>
    <div class="form-container">
        <h2>Add New Equipment</h2>
        <form method="post" action="add_equipment.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <!-- The manufacturer field is missing in your form, so you'll need to add it -->
            <label for="manufacturer">Manufacturer:</label>
            <input type="text" id="manufacturer" name="manufacturer" required>
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            
            <label for="rent_price_per_day">Rent Price per Day:</label>
            <input type="number" id="rent_price_per_day" name="rent_price_per_day" step="0.01" required>
            
            <label for="quantity_in_store">Quantity in Store:</label>
            <input type="number" id="quantity_in_store" name="quantity_in_store" required>
            
            <input type="submit" value="Add Equipment">
        </form>
        <?php if ($message): ?>
            <script type="text/javascript">
                alert('<?php echo $message; ?>');
            </script>
        <?php endif; ?>
    </div>
</body>
</html>
    


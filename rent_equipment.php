<!DOCTYPE html>
<html>
<head>
    <title>Rent Equipment</title>
    <style>

        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4dabf7, #4d9af7);
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
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }
        form {
            display: grid;
            gap: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 16px;
            font-weight: 600;
        }
        input[type="number"], input[type="date"] {
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #e3e3e3;
            background-color: #f8f8f8;
            font-size: 15px;
            transition: all 0.3s;
        }
        input[type="number"]:focus, input[type="date"]:focus {
            outline: none;
            border-color: #4dabf7;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.4);
        }
        input[type="submit"] {
            padding: 15px 30px;
            background-color: #4dabf7;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: background-color 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #4095f7;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Rent Equipment</h2>
        <form action="process_rental.php" method="post">
            <label for="client_id">Client ID:</label>
            <input type="number" id="client_id" name="client_id" required>

            <label for="equipment_id">Equipment ID:</label>
            <input type="number" id="equipment_id" name="equipment_id" required>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="total_price">Total Price:</label>
            <input type="number" id="total_price" name="total_price" step="0.01" required>

            <input type="submit" value="Rent Equipment">
        </form>
    </div>
</body>
</html>

<?php
include 'db_connect.php';

$sql = "SELECT id, name, description, rent_price_per_day, quantity_in_store FROM equipment";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Equipment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            margin-bottom: 20px;
        }
        .card h3 {
            color: #0070d2;
            margin-bottom: 10px;
        }
        .card p {
            text-align: left;
            margin: 5px 0;
        }
        h1 {
            color: #ffffff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Equipment List</h1>
    <div class="cards-container">
        <?php if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row["description"]); ?></p>
                    <p><strong>Rent Price/Day:</strong> $<?php echo htmlspecialchars($row["rent_price_per_day"]); ?></p>
                    <p><strong>Quantity in Store:</strong> <?php echo htmlspecialchars($row["quantity_in_store"]); ?></p>
                </div>
            <?php }
        } else {
            echo "<p>No equipment found.</p>";
        } ?>
    </div>
    <?php
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>
</html>

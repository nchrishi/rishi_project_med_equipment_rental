<!DOCTYPE html>
<html>
<head>
    <title>Edit Equipment</title>
</head>
<body>
    <h1>Edit Equipment</h1>
    <?php
    include 'include/db_connect.php';

    $id = $_GET['id']; // Get the equipment ID from the URL

    $sql = "SELECT name, manufacturer, description, rent_price_per_day, quantity_in_store FROM equipment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "<form action='process_edit_equipment.php' method='post'>";
        echo "<input type='hidden' name='id' value='".$id."'>";
        echo "<label for='name'>Name:</label>";
        echo "<input type='text' id='name' name='name' value='".$row['name']."' required><br>";
        echo "<label for='manufacturer'>Manufacturer:</label>";
        echo "<input type='text' id='manufacturer' name='manufacturer' value='".$row['manufacturer']."' required><br>";
        echo "<label for='description'>Description:</label>";
        echo "<textarea id='description' name='description' required>".$row['description']."</textarea><br>";
        echo "<label for='rent_price_per_day'>Rent Price Per Day:</label>";
        echo "<input type='number' id='rent_price_per_day' name='rent_price_per_day' value='".$row['rent_price_per_day']."' step='0.01' required><br>";
        echo "<label for='quantity_in_store'>Quantity in Store:</label>";
        echo "<input type='number' id='quantity_in_store' name='quantity_in_store' value='".$row['quantity_in_store']."' required><br>";
        echo "<input type='submit' value='Update Equipment'>";
        echo "</form>";
    } else {
        echo "Equipment not found.";
    }

    $conn->close();
    ?>
</body>
</html>

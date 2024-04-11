<!DOCTYPE html>
<html>
<head>
    <title>Update/Delete Equipment</title>
</head>
<body>
    <h1>Update or Delete Equipment</h1>
    <?php
    include 'include/db_connect.php';

    $sql = "SELECT id, name, manufacturer, description FROM equipment";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Manufacturer</th><th>Description</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["manufacturer"]."</td><td>".$row["description"]."</td>";
            echo "<td><a href='edit_equipment.php?id=".$row["id"]."'>Edit</a> | <a href='delete_equipment.php?id=".$row["id"]."'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No equipment found.";
    }
    $conn->close();
    ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Rental History</title>
</head>
<body>
    <h1>Your Rental History</h1>
    <?php
    session_start();
    include 'include/db_connect.php';

    $client_id = $_SESSION['user_id']; // Assuming client's ID is stored in session

    $sql = "SELECT r.id, e.name, r.start_date, r.end_date FROM rentals r JOIN equipment e ON r.equipment_id = e.id WHERE r.client_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Equipment</th><th>Start Date</th><th>End Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["start_date"]."</td><td>".$row["end_date"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No rental history found.";
    }
    $conn->close();
    ?>
</body>
</html>

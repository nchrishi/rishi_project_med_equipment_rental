<?php
include 'db_connect.php'; // Ensure this path is correct

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $equipment_id = $_POST['equipment_id'];
    $new_quantity = $_POST['new_quantity'];

    $sql = "UPDATE equipment SET quantity_in_store = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $new_quantity, $equipment_id);
        if ($stmt->execute()) {
            $message = "Inventory updated successfully!";
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
    <title>Update Inventory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            font-family: 'Segoe UI', sans-serif;
            padding-top: 50px;
            min-height: 100vh;
            color: #fff;
        }
        .container {
            padding-top: 50px;
        }
        h2 {
            margin-bottom: 30px;
            font-weight: 700;
        }
        .card {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border: none;
        }
        .card-body {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
        }
        label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            background-color: #f3f3f3;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: all 0.3s ease-in-out;
            color: #333;
            font-size: 14px;
        }
        .form-control:focus {
            background-color: #fff;
            border: 2px solid #6a11cb;
            box-shadow: none;
        }
        .btn-success {
            background-color: #6a11cb;
            border-color: #6a11cb;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .btn-success:hover, .btn-success:focus {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Update Equipment Inventory</h2>
        <?php if ($message): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="update_inventory.php">
                            <div class="form-group">
                                <label for="equipment_id">Equipment ID:</label>
                                <input type="number" class="form-control" id="equipment_id" name="equipment_id" required>
                            </div>
                            <div class="form-group">
                                <label for="new_quantity">New Quantity:</label>
                                <input type="number" class="form-control" id="new_quantity" name="new_quantity" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update Inventory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

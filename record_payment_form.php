<!DOCTYPE html>
<html>
<head>
    <title>Record Payment</title>
</head>
<body>
    <h2>Record a Payment</h2>
    <form action="record_payment.php" method="post">
        <label for="rental_id">Rental ID:</label>
        <input type="number" id="rental_id" name="rental_id" required><br>
        <label for="client_id">Client ID:</label>
        <input type="number" id="client_id" name="client_id" required><br>
        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" required><br>
        <input type="submit" value="Record Payment">
    </form>
</body>
</html>

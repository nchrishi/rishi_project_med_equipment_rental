<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* Stylish gradient background */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            text-align: center;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 400px; /* Responsive width */
        }
        .dashboard-header {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        h1 {
            color: #0070d2;
            margin: 0;
        }
        .dashboard-button {
            background-color: #0070d2;
            color: white;
            border: none;
            padding: 12px 25px;
            margin: 10px;
            border-radius: 25px; /* Rounded pill shape */
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-button:hover {
            background-color: #005fb8;
            transform: translateY(-3px); /* Slight lift */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome to the Clients Dashboard</h1>
        </div>
        <a href="view_equipment.php"><button class="dashboard-button">View Equipment</button></a>
        <a href="rent_equipment.php"><button class="dashboard-button">Rent Equipment</button></a>
    </div>
</body>
</html>

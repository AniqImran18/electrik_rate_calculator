<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Rate Calculator-Aniq Imran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .calculator-card {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .result-box {
            background: #e9f7ef;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="calculator-card">
        <h2 class="text-center text-primary">Electrik Rate Calculator</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Voltage (V):</label>
                <input type="number" name="voltage" class="form-control" step="0.0001" placeholder="Enter voltage in volts" required>
            </div>
            <div class="form-group">
                <label>Current (A):</label>
                <input type="number" name="current" class="form-control" step="0.0001" placeholder="Enter current in amperes" required>
            </div>
            <div class="form-group">
                <label>Hours Used:</label>
                <input type="number" name="hours" class="form-control" step="0.0001" placeholder="Enter usage time in hours" required>
            </div>
            <div class="form-group">
                <label>Current Rate (sen/kWh):</label>
                <input type="number" name="rate" class="form-control" step="0.0001" placeholder="Enter electricity rate in sen/kWh" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Calculate</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            function calculateElectricity($voltage, $current, $hours, $rate) {
                $power = $voltage * $current; // calculate power
                $energy = ($power * $hours) / 1000; // energy in kwhr
                $totalCost = $energy * ($rate / 100); // total cos
                return [$power, $energy, $totalCost];
            }

            
            $voltage = floatval(htmlspecialchars($_POST['voltage']));
            $current = floatval(htmlspecialchars($_POST['current']));
            $hours = floatval(htmlspecialchars($_POST['hours']));
            $rate = floatval(htmlspecialchars($_POST['rate']));

            // Calculate results
            list($power, $energy, $totalCost) = calculateElectricity($voltage, $current, $hours, $rate);
        ?>
        
        <div class="mt-4 result-box">
            <h5 class="text-success">Calculation Results:</h5>
            <p><strong>Power:</strong> <?php echo number_format($power, 4); ?> W</p>
            <p><strong>Energy:</strong> <?php echo number_format($energy, 4); ?> kWh</p>
            <p><strong>Total Cost:</strong> RM <?php echo number_format($totalCost, 2); ?></p>
        </div>

        <?php } ?>
    </div>
</div>

</body>
</html>

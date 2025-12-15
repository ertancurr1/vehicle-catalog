<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Vehicle Catalog</h1>
            <div class="header-actions">
                <button class="btn btn-danger">MASS DELETE</button>
                <a href="#" class="btn btn-primary">ADD</a>
            </div>
        </div>
    </header>
    
    <main class="container">
        <!-- Sample cards for preview -->
        <div class="vehicle-grid">
            <div class="vehicle-card">
                <div class="vehicle-card-checkbox">
                    <input type="checkbox">
                </div>
                <span class="vehicle-card-type car">Car</span>
                <p class="vehicle-card-sku">CAR001</p>
                <h3 class="vehicle-card-name">Toyota Camry</h3>
                <p class="vehicle-card-price">$28,000.00</p>
                <p class="vehicle-card-attribute">Fuel Consumption: 7.5 L/100km</p>
            </div>
            
            <div class="vehicle-card">
                <div class="vehicle-card-checkbox">
                    <input type="checkbox">
                </div>
                <span class="vehicle-card-type motorcycle">Motorcycle</span>
                <p class="vehicle-card-sku">MOTO001</p>
                <h3 class="vehicle-card-name">Yamaha R1</h3>
                <p class="vehicle-card-price">$17,000.00</p>
                <p class="vehicle-card-attribute">Engine Capacity: 998 CC</p>
            </div>
            
            <div class="vehicle-card">
                <div class="vehicle-card-checkbox">
                    <input type="checkbox">
                </div>
                <span class="vehicle-card-type truck">Truck</span>
                <p class="vehicle-card-sku">TRUCK001</p>
                <h3 class="vehicle-card-name">Ford F-150</h3>
                <p class="vehicle-card-price">$45,000.00</p>
                <p class="vehicle-card-attribute">Load Capacity: 1.5 tons</p>
            </div>
        </div>
    </main>
</body>
</html>
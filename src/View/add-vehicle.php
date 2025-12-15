<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle - Vehicle Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Vehicle Catalog</h1>
        </div>
    </header>
    
    <main class="container">
        <div class="form-container">
            <h2 class="form-title">Add New Vehicle</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form id="product_form" method="POST" action="/vehicle-catalog/public/add-vehicle">
                <!-- SKU -->
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input 
                        type="text" 
                        id="sku" 
                        name="sku" 
                        placeholder="Enter unique SKU"
                        value="<?= htmlspecialchars($formData['sku'] ?? '') ?>"
                        required
                    >
                    <small>Unique identifier for the vehicle</small>
                </div>
                
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Enter vehicle name"
                        value="<?= htmlspecialchars($formData['name'] ?? '') ?>"
                        required
                    >
                </div>
                
                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        placeholder="Enter price"
                        value="<?= htmlspecialchars($formData['price'] ?? '') ?>"
                        min="0.01"
                        step="0.01"
                        required
                    >
                </div>
                
                <!-- Type Switcher -->
                <div class="form-group">
                    <label for="productType">Type</label>
                    <select id="productType" name="type" required>
                        <option value="">Select vehicle type</option>
                        <option value="Car" <?= ($formData['type'] ?? '') === 'Car' ? 'selected' : '' ?>>
                            Car
                        </option>
                        <option value="Motorcycle" <?= ($formData['type'] ?? '') === 'Motorcycle' ? 'selected' : '' ?>>
                            Motorcycle
                        </option>
                        <option value="Truck" <?= ($formData['type'] ?? '') === 'Truck' ? 'selected' : '' ?>>
                            Truck
                        </option>
                    </select>
                </div>
                
                <!-- Car Attribute -->
                <div id="Car" class="type-attributes <?= ($formData['type'] ?? '') === 'Car' ? 'active' : '' ?>">
                    <div class="form-group">
                        <label for="fuel_consumption">Fuel Consumption (L/100km)</label>
                        <input 
                            type="number" 
                            id="fuel_consumption" 
                            name="fuel_consumption" 
                            placeholder="Enter fuel consumption"
                            value="<?= htmlspecialchars($formData['fuel_consumption'] ?? '') ?>"
                            min="0.1"
                            step="0.1"
                        >
                        <small>Please provide fuel consumption in liters per 100km</small>
                    </div>
                </div>
                
                <!-- Motorcycle Attribute -->
                <div id="Motorcycle" class="type-attributes <?= ($formData['type'] ?? '') === 'Motorcycle' ? 'active' : '' ?>">
                    <div class="form-group">
                        <label for="engine_capacity">Engine Capacity (CC)</label>
                        <input 
                            type="number" 
                            id="engine_capacity" 
                            name="engine_capacity" 
                            placeholder="Enter engine capacity"
                            value="<?= htmlspecialchars($formData['engine_capacity'] ?? '') ?>"
                            min="1"
                            step="1"
                        >
                        <small>Please provide engine capacity in cubic centimeters</small>
                    </div>
                </div>
                
                <!-- Truck Attribute -->
                <div id="Truck" class="type-attributes <?= ($formData['type'] ?? '') === 'Truck' ? 'active' : '' ?>">
                    <div class="form-group">
                        <label for="load_capacity">Load Capacity (tons)</label>
                        <input 
                            type="number" 
                            id="load_capacity" 
                            name="load_capacity" 
                            placeholder="Enter load capacity"
                            value="<?= htmlspecialchars($formData['load_capacity'] ?? '') ?>"
                            min="0.1"
                            step="0.1"
                        >
                        <small>Please provide load capacity in tons</small>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                    <a href="/vehicle-catalog/public/" class="btn btn-secondary" id="cancel-btn">Cancel</a>
                </div>
            </form>
        </div>
    </main>
    
    <script src="../js/script.js"></script>
</body>
</html>
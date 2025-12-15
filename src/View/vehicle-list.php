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
                <button type="submit" form="delete-form" class="btn btn-danger" id="delete-product-btn">
                    MASS DELETE
                </button>
                <a href="/vehicle-catalog/public/add-vehicle" class="btn btn-primary" id="add-product-btn">
                    ADD
                </a>
            </div>
        </div>
    </header>
    
    <main class="container">
        <?php if (empty($vehicles)): ?>
            <div class="empty-state">
                <h2>No vehicles found</h2>
                <p>Start by adding your first vehicle to the catalog.</p>
                <a href="/vehicle-catalog/public/add-vehicle" class="btn btn-primary">Add Vehicle</a>
            </div>
        <?php else: ?>
            <form id="delete-form" method="POST" action="/vehicle-catalog/public/delete">
                <div class="vehicle-grid">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <div class="vehicle-card">
                            <div class="vehicle-card-checkbox">
                                <input 
                                    type="checkbox" 
                                    name="ids[]" 
                                    value="<?= $vehicle->getId() ?>"
                                    class="delete-checkbox"
                                >
                            </div>
                            
                            <span class="vehicle-card-type <?= strtolower($vehicle->getType()) ?>">
                                <?= htmlspecialchars($vehicle->getType()) ?>
                            </span>
                            
                            <p class="vehicle-card-sku">
                                <?= htmlspecialchars($vehicle->getSku()) ?>
                            </p>
                            
                            <h3 class="vehicle-card-name">
                                <?= htmlspecialchars($vehicle->getName()) ?>
                            </h3>
                            
                            <p class="vehicle-card-price">
                                $<?= number_format($vehicle->getPrice(), 2) ?>
                            </p>
                            
                            <p class="vehicle-card-attribute">
                                <?= htmlspecialchars($vehicle->getSpecificAttribute()) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        <?php endif; ?>
    </main>
    
    <script src="../js/script.js"></script>
</body>
</html>
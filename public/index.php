<?php

/**
 * Vehicle Catalog - Main Router
 * 
 * Handles all incoming requests and routes to appropriate handlers.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Repository\VehicleRepository;
use App\Model\Car;
use App\Model\Motorcycle;
use App\Model\Truck;

// Get the request URI and remove query string
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base path to get clean route
$basePath = '/vehicle-catalog/public';
$route = str_replace($basePath, '', $requestUri);
$route = $route ?: '/';

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// ==================== ROUTING ====================

switch (true) {
    // Home page - Vehicle List
    case $route === '/' && $method === 'GET':
        $repository = new VehicleRepository();
        $vehicles = $repository->getAll();
        require dirname(__DIR__) . '/src/View/vehicle-list.php';
        break;
    
    // Add Vehicle - Show Form
    case $route === '/add-vehicle' && $method === 'GET':
        $errors = [];
        $formData = [];
        require dirname(__DIR__) . '/src/View/add-vehicle.php';
        break;
    
    // Add Vehicle - Process Form
    case $route === '/add-vehicle' && $method === 'POST':
        $repository = new VehicleRepository();
        $errors = [];
        $formData = $_POST;
        
        // Get form data
        $sku = trim($_POST['sku'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $price = $_POST['price'] ?? '';
        $type = $_POST['type'] ?? '';
        
        // ==================== VALIDATION ====================
        
        // Required fields
        if (empty($sku)) {
            $errors[] = 'SKU is required.';
        }
        
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        
        if (empty($price) || $price <= 0) {
            $errors[] = 'Price must be greater than 0.';
        }
        
        if (empty($type)) {
            $errors[] = 'Please select a vehicle type.';
        }
        
        // Check SKU uniqueness
        if (!empty($sku) && $repository->skuExists($sku)) {
            $errors[] = 'SKU already exists. Please use a unique SKU.';
        }
        
        // Validate type-specific attributes
        if ($type === 'Car') {
            $fuelConsumption = $_POST['fuel_consumption'] ?? '';
            if (empty($fuelConsumption) || $fuelConsumption <= 0) {
                $errors[] = 'Fuel consumption must be greater than 0.';
            }
        }
        
        if ($type === 'Motorcycle') {
            $engineCapacity = $_POST['engine_capacity'] ?? '';
            if (empty($engineCapacity) || $engineCapacity <= 0) {
                $errors[] = 'Engine capacity must be greater than 0.';
            }
        }
        
        if ($type === 'Truck') {
            $loadCapacity = $_POST['load_capacity'] ?? '';
            if (empty($loadCapacity) || $loadCapacity <= 0) {
                $errors[] = 'Load capacity must be greater than 0.';
            }
        }
        
        // ==================== SAVE IF VALID ====================
        
        if (empty($errors)) {
            // Create appropriate vehicle object based on type
            $vehicle = match($type) {
                'Car' => new Car($sku, $name, (float) $price, (float) $fuelConsumption),
                'Motorcycle' => new Motorcycle($sku, $name, (float) $price, (int) $engineCapacity),
                'Truck' => new Truck($sku, $name, (float) $price, (float) $loadCapacity),
                default => null
            };
            
            if ($vehicle && $vehicle->save()) {
                // Redirect to list on success
                header('Location: ' . $basePath . '/');
                exit;
            } else {
                $errors[] = 'Failed to save vehicle. Please try again.';
            }
        }
        
        // Show form with errors
        require dirname(__DIR__) . '/src/View/add-vehicle.php';
        break;
    
    // Delete vehicles
    case $route === '/delete' && $method === 'POST':
        $repository = new VehicleRepository();
        $ids = $_POST['ids'] ?? [];
        
        if (!empty($ids)) {
            $repository->deleteByIds($ids);
        }
        
        // Redirect back to list
        header('Location: ' . $basePath . '/');
        exit;
    
    // 404 - Route not found
    default:
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
        echo '<p>The page you requested does not exist.</p>';
        echo '<a href="' . $basePath . '/">Back to Vehicle List</a>';
        break;
}
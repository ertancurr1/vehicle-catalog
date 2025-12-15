<?php

/**
 * Vehicle Catalog - Main Router
 * 
 * Handles all incoming requests and routes to appropriate handlers.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Repository\VehicleRepository;

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
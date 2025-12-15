<?php

namespace App\Repository;

use App\Database\Database;
use App\Model\Vehicle;
use App\Model\Car;
use App\Model\Motorcycle;
use App\Model\Truck;
use PDO;

/**
 * Vehicle Repository
 * 
 * Handles all database operations for vehicles.
 * Uses polymorphism to create correct vehicle type objects.
 */
class VehicleRepository
{
    private PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    /**
     * Get all vehicles from database
     * Creates correct object type for each row (polymorphism)
     * 
     * @return Vehicle[] Array of Vehicle objects
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM vehicles ORDER BY id ASC";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        
        $vehicles = [];
        foreach ($rows as $row) {
            $vehicles[] = $this->createVehicleFromRow($row);
        }
        
        return $vehicles;
    }
    
    /**
     * Create correct Vehicle object based on type
     * Uses match expression (PHP 8) - NO IF-ELSE chain!
     * 
     * @param array $row Database row
     * @return Vehicle Car, Motorcycle, or Truck object
     */
    private function createVehicleFromRow(array $row): Vehicle
    {
        return match($row['type']) {
            'Car' => new Car(
                $row['sku'],
                $row['name'],
                (float) $row['price'],
                (float) $row['fuel_consumption'],
                (int) $row['id']
            ),
            'Motorcycle' => new Motorcycle(
                $row['sku'],
                $row['name'],
                (float) $row['price'],
                (int) $row['engine_capacity'],
                (int) $row['id']
            ),
            'Truck' => new Truck(
                $row['sku'],
                $row['name'],
                (float) $row['price'],
                (float) $row['load_capacity'],
                (int) $row['id']
            ),
            default => throw new \Exception("Unknown vehicle type: {$row['type']}")
        };
    }
    
    /**
     * Check if SKU already exists in database
     * 
     * @param string $sku SKU to check
     * @return bool True if exists, false otherwise
     */
    public function skuExists(string $sku): bool
    {
        $sql = "SELECT COUNT(*) FROM vehicles WHERE sku = :sku";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':sku' => $sku]);
        
        return $stmt->fetchColumn() > 0;
    }
    
    /**
     * Find a vehicle by SKU
     * 
     * @param string $sku SKU to find
     * @return Vehicle|null Vehicle object or null if not found
     */
    public function findBySku(string $sku): ?Vehicle
    {
        $sql = "SELECT * FROM vehicles WHERE sku = :sku";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':sku' => $sku]);
        
        $row = $stmt->fetch();
        
        if (!$row) {
            return null;
        }
        
        return $this->createVehicleFromRow($row);
    }
    
    /**
     * Find a vehicle by ID
     * 
     * @param int $id Vehicle ID
     * @return Vehicle|null Vehicle object or null if not found
     */
    public function findById(int $id): ?Vehicle
    {
        $sql = "SELECT * FROM vehicles WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $row = $stmt->fetch();
        
        if (!$row) {
            return null;
        }
        
        return $this->createVehicleFromRow($row);
    }
    
    /**
     * Delete multiple vehicles by IDs
     * 
     * @param array $ids Array of vehicle IDs to delete
     * @return int Number of deleted rows
     */
    public function deleteByIds(array $ids): int
    {
        if (empty($ids)) {
            return 0;
        }
        
        // Filter to integers only for security
        $ids = array_map('intval', $ids);
        
        // Create placeholders for prepared statement
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        $sql = "DELETE FROM vehicles WHERE id IN ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($ids);
        
        return $stmt->rowCount();
    }
    
    /**
     * Get count of all vehicles
     * 
     * @return int Total number of vehicles
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM vehicles";
        $stmt = $this->pdo->query($sql);
        
        return (int) $stmt->fetchColumn();
    }
}
<?php

namespace App\Model;

use App\Database\Database;
use PDO;

/**
 * Truck Class
 * 
 * Extends Vehicle with load capacity attribute.
 */
class Truck extends Vehicle
{
    private float $loadCapacity;
    
    /**
     * Constructor
     * 
     * @param string $sku Unique identifier
     * @param string $name Vehicle name
     * @param float $price Price in dollars
     * @param float $loadCapacity Load capacity in tons
     * @param int|null $id Database ID (null for new vehicles)
     */
    public function __construct(
        string $sku,
        string $name,
        float $price,
        float $loadCapacity,
        ?int $id = null
    ) {
        parent::__construct($sku, $name, $price, $id);
        $this->loadCapacity = $loadCapacity;
    }
    
    // ==================== GETTERS & SETTERS ====================
    
    public function getLoadCapacity(): float
    {
        return $this->loadCapacity;
    }
    
    public function setLoadCapacity(float $loadCapacity): void
    {
        $this->loadCapacity = $loadCapacity;
    }
    
    // ==================== ABSTRACT METHOD IMPLEMENTATIONS ====================
    
    /**
     * Returns vehicle type
     */
    public function getType(): string
    {
        return 'Truck';
    }
    
    /**
     * Returns formatted load capacity
     * POLYMORPHISM: Same method name as other vehicle types, different output
     */
    public function getSpecificAttribute(): string
    {
        return "Load Capacity: {$this->loadCapacity} tons";
    }
    
    /**
     * Save truck to database
     */
    public function save(): bool
    {
        $pdo = Database::getInstance()->getConnection();
        
        $sql = "INSERT INTO vehicles (sku, name, price, type, load_capacity) 
                VALUES (:sku, :name, :price, :type, :load_capacity)";
        
        $stmt = $pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':type' => $this->getType(),
            ':load_capacity' => $this->loadCapacity
        ]);
        
        if ($result) {
            $this->id = (int) $pdo->lastInsertId();
        }
        
        return $result;
    }
}
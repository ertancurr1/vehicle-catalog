<?php

namespace App\Model;

use App\Database\Database;
use PDO;

/**
 * Motorcycle Class
 * 
 * Extends Vehicle with engine capacity attribute.
 */
class Motorcycle extends Vehicle
{
    private int $engineCapacity;
    
    /**
     * Constructor
     * 
     * @param string $sku Unique identifier
     * @param string $name Vehicle name
     * @param float $price Price in dollars
     * @param int $engineCapacity Engine capacity in CC
     * @param int|null $id Database ID (null for new vehicles)
     */
    public function __construct(
        string $sku,
        string $name,
        float $price,
        int $engineCapacity,
        ?int $id = null
    ) {
        parent::__construct($sku, $name, $price, $id);
        $this->engineCapacity = $engineCapacity;
    }
    
    // ==================== GETTERS & SETTERS ====================
    
    public function getEngineCapacity(): int
    {
        return $this->engineCapacity;
    }
    
    public function setEngineCapacity(int $engineCapacity): void
    {
        $this->engineCapacity = $engineCapacity;
    }
    
    // ==================== ABSTRACT METHOD IMPLEMENTATIONS ====================
    
    /**
     * Returns vehicle type
     */
    public function getType(): string
    {
        return 'Motorcycle';
    }
    
    /**
     * Returns formatted engine capacity
     * POLYMORPHISM: Same method name as other vehicle types, different output
     */
    public function getSpecificAttribute(): string
    {
        return "Engine Capacity: {$this->engineCapacity} CC";
    }
    
    /**
     * Save motorcycle to database
     */
    public function save(): bool
    {
        $pdo = Database::getInstance()->getConnection();
        
        $sql = "INSERT INTO vehicles (sku, name, price, type, engine_capacity) 
                VALUES (:sku, :name, :price, :type, :engine_capacity)";
        
        $stmt = $pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':type' => $this->getType(),
            ':engine_capacity' => $this->engineCapacity
        ]);
        
        if ($result) {
            $this->id = (int) $pdo->lastInsertId();
        }
        
        return $result;
    }
}
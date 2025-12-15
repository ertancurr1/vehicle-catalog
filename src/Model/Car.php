<?php

namespace App\Model;

use App\Database\Database;
use PDO;

/**
 * Car Class
 * 
 * Extends Vehicle with fuel consumption attribute.
 */
class Car extends Vehicle
{
    private float $fuelConsumption;
    
    /**
     * Constructor
     * 
     * @param string $sku Unique identifier
     * @param string $name Vehicle name
     * @param float $price Price in dollars
     * @param float $fuelConsumption Fuel consumption in L/100km
     * @param int|null $id Database ID (null for new vehicles)
     */
    public function __construct(
        string $sku,
        string $name,
        float $price,
        float $fuelConsumption,
        ?int $id = null
    ) {
        parent::__construct($sku, $name, $price, $id);
        $this->fuelConsumption = $fuelConsumption;
    }
    
    // ==================== GETTERS & SETTERS ====================
    
    public function getFuelConsumption(): float
    {
        return $this->fuelConsumption;
    }
    
    public function setFuelConsumption(float $fuelConsumption): void
    {
        $this->fuelConsumption = $fuelConsumption;
    }
    
    // ==================== ABSTRACT METHOD IMPLEMENTATIONS ====================
    
    /**
     * Returns vehicle type
     */
    public function getType(): string
    {
        return 'Car';
    }
    
    /**
     * Returns formatted fuel consumption
     * POLYMORPHISM: Same method name as other vehicle types, different output
     */
    public function getSpecificAttribute(): string
    {
        return "Fuel Consumption: {$this->fuelConsumption} L/100km";
    }
    
    /**
     * Save car to database
     */
    public function save(): bool
    {
        $pdo = Database::getInstance()->getConnection();
        
        $sql = "INSERT INTO vehicles (sku, name, price, type, fuel_consumption) 
                VALUES (:sku, :name, :price, :type, :fuel_consumption)";
        
        $stmt = $pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':sku' => $this->sku,
            ':name' => $this->name,
            ':price' => $this->price,
            ':type' => $this->getType(),
            ':fuel_consumption' => $this->fuelConsumption
        ]);
        
        if ($result) {
            $this->id = (int) $pdo->lastInsertId();
        }
        
        return $result;
    }
}
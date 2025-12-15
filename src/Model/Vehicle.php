<?php

namespace App\Model;

/**
 * Abstract Vehicle Class
 * 
 * Base class for all vehicle types.
 * Cannot be instantiated directly - must be extended.
 * Demonstrates abstraction and inheritance.
 */
abstract class Vehicle
{
    protected ?int $id;
    protected string $sku;
    protected string $name;
    protected float $price;
    
    /**
     * Constructor
     */
    public function __construct(
        string $sku,
        string $name,
        float $price,
        ?int $id = null
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
    }
    
    // ==================== GETTERS ====================
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getSku(): string
    {
        return $this->sku;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getPrice(): float
    {
        return $this->price;
    }
    
    // ==================== SETTERS ====================
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    
    // ==================== ABSTRACT METHODS ====================
    
    /**
     * Get the vehicle type (Car, Motorcycle, Truck)
     * Each child class returns its own type
     */
    abstract public function getType(): string;
    
    /**
     * Get the specific attribute for this vehicle type
     * Car: Fuel Consumption, Motorcycle: Engine Capacity, Truck: Load Capacity
     * This is POLYMORPHISM - same method, different behavior
     */
    abstract public function getSpecificAttribute(): string;
    
    /**
     * Save the vehicle to database
     * Each child class implements its own save logic
     */
    abstract public function save(): bool;
}
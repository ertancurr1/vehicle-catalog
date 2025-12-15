-- Vehicle Catalog System Database Schema
-- Run this file to set up the database

-- Create database
CREATE DATABASE IF NOT EXISTS vehicle_catalog;
USE vehicle_catalog;

-- Drop existing table if exists (for fresh start)
DROP TABLE IF EXISTS vehicles;

-- Create vehicles table
CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    type ENUM('Car', 'Motorcycle', 'Truck') NOT NULL,
    
    -- Car attribute
    fuel_consumption DECIMAL(5, 2) DEFAULT NULL COMMENT 'Fuel consumption in L/100km for Car',
    
    -- Motorcycle attribute
    engine_capacity INT DEFAULT NULL COMMENT 'Engine capacity in CC for Motorcycle',
    
    -- Truck attribute
    load_capacity DECIMAL(5, 2) DEFAULT NULL COMMENT 'Load capacity in tons for Truck',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_type (type),
    INDEX idx_sku (sku)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data (optional)
INSERT INTO vehicles (sku, name, price, type, fuel_consumption) VALUES 
('CAR001', 'Toyota Camry', 28000.00, 'Car', 7.5),
('CAR002', 'Honda Civic', 24000.00, 'Car', 6.8);

INSERT INTO vehicles (sku, name, price, type, engine_capacity) VALUES 
('MOTO001', 'Yamaha R1', 17000.00, 'Motorcycle', 998),
('MOTO002', 'Kawasaki Ninja', 15000.00, 'Motorcycle', 650);

INSERT INTO vehicles (sku, name, price, type, load_capacity) VALUES 
('TRUCK001', 'Ford F-150', 45000.00, 'Truck', 1.5),
('TRUCK002', 'Volvo FH16', 120000.00, 'Truck', 25.0);
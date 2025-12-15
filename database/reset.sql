-- Reset database to initial state
-- Run this to clear all data and re-insert samples

USE vehicle_catalog;

-- Clear existing data
TRUNCATE TABLE vehicles;

-- Insert sample data
INSERT INTO vehicles (sku, name, price, type, fuel_consumption) VALUES 
('CAR001', 'Toyota Camry', 28000.00, 'Car', 7.5),
('CAR002', 'Honda Civic', 24000.00, 'Car', 6.8),
('CAR003', 'BMW 3 Series', 42000.00, 'Car', 8.2);

INSERT INTO vehicles (sku, name, price, type, engine_capacity) VALUES 
('MOTO001', 'Yamaha R1', 17000.00, 'Motorcycle', 998),
('MOTO002', 'Kawasaki Ninja', 15000.00, 'Motorcycle', 650),
('MOTO003', 'Harley Davidson', 25000.00, 'Motorcycle', 1200);

INSERT INTO vehicles (sku, name, price, type, load_capacity) VALUES 
('TRUCK001', 'Ford F-150', 45000.00, 'Truck', 1.5),
('TRUCK002', 'Volvo FH16', 120000.00, 'Truck', 25.0),
('TRUCK003', 'Mercedes Actros', 95000.00, 'Truck', 18.5);
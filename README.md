# Vehicle Catalog System

A PHP OOP learning project demonstrating object-oriented programming principles including abstraction, inheritance, and polymorphism.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-10.4-4479A1?logo=mysql&logoColor=white)

## Features

- **Add vehicles** with type-specific attributes
- **List all vehicles** in a responsive grid
- **Mass delete** with confirmation
- **Form validation** (server-side)
- **Type switcher** shows/hides relevant fields

## Vehicle Types

| Type       | Special Attribute | Example     |
| ---------- | ----------------- | ----------- |
| Car        | Fuel Consumption  | 7.5 L/100km |
| Motorcycle | Engine Capacity   | 998 CC      |
| Truck      | Load Capacity     | 25 tons     |

## OOP Concepts Demonstrated

### Abstraction

The `Vehicle` class is abstract and cannot be instantiated directly. It defines the blueprint that all vehicle types must follow.

### Inheritance

`Car`, `Motorcycle`, and `Truck` classes extend the abstract `Vehicle` class, inheriting common properties and methods.

### Polymorphism

The `getSpecificAttribute()` method returns different output based on the vehicle type - **no if-else statements needed**. Each class defines its own behavior.

```php
// Same method call, different output
foreach ($vehicles as $vehicle) {
    echo $vehicle->getSpecificAttribute();
    // Car: "Fuel Consumption: 7.5 L/100km"
    // Motorcycle: "Engine Capacity: 998 CC"
    // Truck: "Load Capacity: 25 tons"
}
```

### Singleton Pattern

The `Database` class ensures only one database connection exists throughout the application.

### Repository Pattern

The `VehicleRepository` handles all database operations, separating data access from business logic.

## Tech Stack

- PHP 8.2
- MySQL / MariaDB
- HTML5 / CSS3
- Vanilla JavaScript
- Composer (PSR-4 Autoloading)

## Project Structure

```
vehicle-catalog/
├── config/
│   └── database.php         # Database configuration
├── css/
│   └── style.css            # Stylesheet
├── database/
│   └── schema.sql           # Database schema + sample data
├── js/
│   └── script.js            # Type switcher, delete confirmation
├── public/
│   ├── .htaccess            # URL rewriting
│   └── index.php            # Router / Front controller
├── src/
│   ├── Database/
│   │   └── Database.php     # Singleton DB connection
│   ├── Model/
│   │   ├── Vehicle.php      # Abstract base class
│   │   ├── Car.php          # Extends Vehicle
│   │   ├── Motorcycle.php   # Extends Vehicle
│   │   └── Truck.php        # Extends Vehicle
│   ├── Repository/
│   │   └── VehicleRepository.php  # Database operations
│   └── View/
│       ├── vehicle-list.php # List page
│       └── add-vehicle.php  # Add form
├── composer.json
├── .gitignore
└── README.md
```

## Installation

### Prerequisites

- PHP 8.0 or higher
- MySQL 5.7+ or MariaDB 10.4+
- Composer
- Apache with mod_rewrite enabled

### Setup Steps

1. **Clone the repository**

```bash
   git clone https://github.com/ertancurr1/vehicle-catalog.git
   cd vehicle-catalog
```

2. **Install dependencies**

```bash
   composer install
```

3. **Create database**

   - Open phpMyAdmin or MySQL CLI
   - Run the SQL from `database/schema.sql`

4. **Configure database connection**

   - Open `config/database.php`
   - Update credentials if needed (default: root with no password)

5. **Access the application**
   - Visit: `http://localhost/vehicle-catalog/public/`

## Usage

### Adding a Vehicle

1. Click the **ADD** button
2. Enter SKU (unique identifier)
3. Enter vehicle name and price
4. Select vehicle type from dropdown
5. Fill in the type-specific attribute
6. Click **Save**

### Deleting Vehicles

1. Check the boxes on vehicles you want to delete
2. Click **MASS DELETE**
3. Confirm the deletion

## API Reference

### Vehicle Model Methods

| Method                   | Returns | Description                       |
| ------------------------ | ------- | --------------------------------- |
| `getSku()`               | string  | Unique identifier                 |
| `getName()`              | string  | Vehicle name                      |
| `getPrice()`             | float   | Price in dollars                  |
| `getType()`              | string  | "Car", "Motorcycle", or "Truck"   |
| `getSpecificAttribute()` | string  | Formatted type-specific attribute |
| `save()`                 | bool    | Saves to database                 |

### Repository Methods

| Method              | Returns       | Description                    |
| ------------------- | ------------- | ------------------------------ |
| `getAll()`          | Vehicle[]     | All vehicles                   |
| `findById($id)`     | Vehicle\|null | Find by ID                     |
| `findBySku($sku)`   | Vehicle\|null | Find by SKU                    |
| `skuExists($sku)`   | bool          | Check if SKU exists            |
| `deleteByIds($ids)` | int           | Delete multiple, returns count |
| `count()`           | int           | Total vehicle count            |

## Screenshots

### Vehicle List

- Responsive grid layout
- Color-coded type badges
- Checkbox selection for deletion

### Add Vehicle Form

- Dynamic type switcher
- Form validation
- Preserved data on error

## Author

**Ertan Curri**

- Portfolio: [ertancurri.com](https://ertancurri.com)
- GitHub: [@ertancurr1](https://github.com/ertancurr1)
- LinkedIn: [/in/ertancurri](https://linkedin.com/in/ertancurri)

## License

This project is open source and available for learning purposes.

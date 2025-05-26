-- Drop existing tables if they exist
DROP TABLE IF EXISTS adoption_requests;
DROP TABLE IF EXISTS pets;
DROP TABLE IF EXISTS pet_types;
DROP TABLE IF EXISTS admin;

-- Create pet_types table
CREATE TABLE pet_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create pets table with type reference
CREATE TABLE pets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    type_id INT NOT NULL,
    breed VARCHAR(100),
    age DECIMAL(3,1),
    gender ENUM('Male', 'Female') NOT NULL,
    size ENUM('Small', 'Medium', 'Large') NOT NULL,
    description TEXT,
    health_status TEXT,
    vaccination_status BOOLEAN DEFAULT FALSE,
    image VARCHAR(255),
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (type_id) REFERENCES pet_types(id)
);

-- Create admin table
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create adoption_requests table
CREATE TABLE adoption_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pet_id INT NOT NULL,
    adopter_name VARCHAR(100) NOT NULL,
    adopter_email VARCHAR(100) NOT NULL,
    adopter_phone VARCHAR(20) NOT NULL,
    adopter_address TEXT NOT NULL,
    reason_for_adoption TEXT NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(id)
);

-- Insert default pet types
INSERT INTO pet_types (name, description) VALUES
('Dog', 'Loyal and friendly companions that make great pets for families'),
('Cat', 'Independent and graceful pets that are perfect for any home'),
('Bird', 'Beautiful and melodious pets that bring joy with their songs'),
('Fish', 'Peaceful and low-maintenance pets that create a calming atmosphere'),
('Rabbit', 'Gentle and quiet pets that are perfect for indoor living'),
('Hamster', 'Small and active pets that are great for beginners');

-- Insert sample admin account (password: admin123)
INSERT INTO admin (username, password, email, full_name) VALUES
('admin', '$2y$10$8K1p/bFhBDKv8aE/YhJxFOGOZXd0UbmGGR.PtJQ/pPCuGcFDZpGe2', 'admin@example.com', 'System Administrator'); 
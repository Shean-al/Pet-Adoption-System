CREATE DATABASE IF NOT EXISTS padpt;
USE padpt;

-- Pets table
CREATE TABLE pets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  age VARCHAR(50),
  breed VARCHAR(100),
  description TEXT,
  image VARCHAR(255),
  status ENUM('Available', 'Adopted') DEFAULT 'Available'
);

-- Adoption requests table
CREATE TABLE adoptions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pet_id INT,
  adopter_name VARCHAR(100),
  contact_info VARCHAR(100),
  message TEXT,
  date_requested TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);

-- Admin table
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

CREATE TABLE requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pet_id INT NOT NULL,
    adopter_name VARCHAR(100) NOT NULL,
    adopter_email VARCHAR(100) NOT NULL,
   message TEXT NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(id)
);

-- Insert default admin
INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

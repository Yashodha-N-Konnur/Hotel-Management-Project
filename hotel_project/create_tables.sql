-- ========================================
-- Database: hotel
-- ========================================

CREATE DATABASE IF NOT EXISTS hotel;
USE hotel;

-- Drop child tables first to avoid FK errors
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS reservations;

-- Now drop parent tables
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS rooms;

-- ========================================
-- Table: customers
-- ========================================
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15)
);

-- ========================================
-- Table: rooms
-- ========================================
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'available'
);

-- ========================================
-- Table: bookings
-- ========================================
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- ========================================
-- Table: reservations
-- ========================================
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    guests INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


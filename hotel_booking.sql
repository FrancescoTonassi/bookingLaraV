CREATE DATABASE IF NOT EXISTS hotel_booking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hotel_booking;

CREATE TABLE users (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(150) NOT NULL UNIQUE,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) NOT NULL,
  role enum('user','admin') NOT NULL DEFAULT 'user',
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE hotels (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  name varchar(150) NOT NULL,
  description text DEFAULT NULL,
  address varchar(255) NOT NULL,
  city varchar(100) NOT NULL,
  phone varchar(50) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  image varchar(255) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bookings (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  user_id bigint unsigned NOT NULL,
  hotel_id bigint unsigned NOT NULL,
  check_in date NOT NULL,
  check_out date NOT NULL,
  guests int NOT NULL,
  notes text DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY fk_bookings_users (user_id),
  KEY fk_bookings_hotels (hotel_id),
  CONSTRAINT fk_bookings_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_bookings_hotels FOREIGN KEY (hotel_id) REFERENCES hotels (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Utente admin di esempio: email admin@example.com, password: password
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES
('Admin', 'admin@example.com',
 -- password bcrypt('password') generala con Laravel o sostituisci con il tuo hash
 '$2y$10$abcdefghijklmnopqrstuvABCDEFGHijklmnopqrstuv12',
 'admin', NOW(), NOW());

INSERT INTO hotels (name, description, address, city, phone, email, created_at, updated_at)
VALUES
('Hotel Roma Centro', 'Hotel in centro a Roma', 'Via Roma 1', 'Roma', '0123456789', 'info@roma-centro.it', NOW(), NOW()),
('Hotel Milano Business', 'Hotel per viaggi di lavoro', 'Corso Milano 10', 'Milano', '0234567890', 'info@milano-business.it', NOW(), NOW());

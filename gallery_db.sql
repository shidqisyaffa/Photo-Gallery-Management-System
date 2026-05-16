CREATE DATABASE IF NOT EXISTS gallery_db;
USE gallery_db;

-- Table structure for categories
CREATE TABLE IF NOT EXISTS categories (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for photos
CREATE TABLE IF NOT EXISTS photos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  category_id INT(11) NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  file_name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY category_id (category_id),
  CONSTRAINT fk_photo_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some dummy data for categories
INSERT INTO categories (name, description) VALUES
('Nature', 'Photos of landscapes, trees, and animals.'),
('Architecture', 'Photos of buildings and structures.');

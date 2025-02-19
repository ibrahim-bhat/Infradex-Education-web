CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    user_role ENUM('super_admin', 'admin', 'management', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 

ALTER TABLE users 
MODIFY COLUMN user_role ENUM('super_admin', 'admin', 'management', 'user') NOT NULL;

-- If you need to update existing records:
UPDATE users 
SET user_role = 'user' 
WHERE user_role = 'teacher'; 
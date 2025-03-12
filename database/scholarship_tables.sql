-- Create scholarships table
CREATE TABLE IF NOT EXISTS scholarships (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    amount DECIMAL(10,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    eligibility TEXT,
    deadline DATE NOT NULL,
    available_slots INT DEFAULT 0,
    status ENUM('active', 'inactive', 'expired') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create scholarship applications table
CREATE TABLE IF NOT EXISTS scholarship_applications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    scholarship_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (scholarship_id) REFERENCES scholarships(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample scholarship data
INSERT INTO scholarships (title, description, amount, category, eligibility, deadline, available_slots) VALUES
('Merit Scholarship 2024', 'Scholarship for outstanding academic performance in previous academic year', 25000.00, 'Merit-based', 'Minimum 85% in previous academic year', '2024-06-30', 50),
('Need-Based Financial Aid', 'Financial assistance for economically disadvantaged students', 35000.00, 'Need-based', 'Annual family income less than 3 lakhs', '2024-05-31', 100),
('Sports Excellence Scholarship', 'For students with exceptional achievements in sports', 20000.00, 'Sports', 'State or National level sports achievements', '2024-07-15', 25),
('Girl Child Education Support', 'Special scholarship to promote girl child education', 30000.00, 'Gender-based', 'Female students with good academic record', '2024-06-15', 75); 
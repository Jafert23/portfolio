-- Create contact submissions table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email_sent BOOLEAN DEFAULT FALSE,
    status VARCHAR(50) DEFAULT 'pending'
); 
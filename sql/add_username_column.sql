ALTER TABLE users 
ADD COLUMN username VARCHAR(50) AFTER id;

-- Update existing users to have a username based on their email
UPDATE users 
SET username = SUBSTRING_INDEX(email, '@', 1)
WHERE username IS NULL; 
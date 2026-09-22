-- 1. CREATE (Insert a row into the users table)
INSERT INTO users (name, email, password) 
VALUES ('Sarah Connor', 'sarah@test.com', 'hashed_pass_here');

-- 2. READ (Select specific rows)
SELECT * FROM users; -- Gets everyone
SELECT id, name FROM users WHERE email = 'sarah@test.com';

-- 3. UPDATE (Modify an existing row)
UPDATE users SET role = 'Admin' WHERE id = 1;

-- 4. DELETE (Remove a row permanently)
DELETE FROM users WHERE id = 1;
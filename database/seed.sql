-- create test student
INSERT INTO student (student_id, email, password_hash, first_name, last_name) 
    VALUES (1, 'john.doe@example.com', '$2y$10$Y5Z1I2Wui0ogBaeXV6zqkOkJkwD1JDhKMC0.Fu7.2EhojFe4Yhn9u', 'John', 'Doe');

-- create test achievement category
INSERT INTO achievement_category (category_id, name, description) 
    VALUES (1, 'Login Achievements', 'Achievements related to logging in and account activity.');

-- create test achievement
INSERT INTO achievement (achievement_id, student_id, category_id, title, description, date_received) 
    VALUES (1, 1, 1, 'First Login', 'Awarded for logging in for the first time.', '2024-01-01');
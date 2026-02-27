-- create achievement categories
INSERT INTO achievement_categories (name, description) VALUES
('Grades', 'Exam results and coursework grades'),
('Reports', 'Teacher reports and summaries'),
('Awards', 'Certificates and competition results'),
('Attendance', 'Attendance milestones'),
('Extracurricular', 'Clubs, sports and volunteering'),
('Behaviour', 'Positive behaviour and conduct records');

-- create test student
INSERT INTO students (student_id, email, password_hash, first_name, last_name) 
    VALUES (1, 'john.doe@example.com', '$2y$10$Y5Z1I2Wui0ogBaeXV6zqkOkJkwD1JDhKMC0.Fu7.2EhojFe4Yhn9u', 'John', 'Doe');

-- create test achievement
INSERT INTO achievements (achievement_id, student_id, category_id, title, description, date_received) 
    VALUES (1, 1, 3, 'First Login', 'Awarded for logging in for the first time.', '2024-01-01');
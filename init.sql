CREATE TABLE IF NOT EXISTS users (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Email VARCHAR(255),
    Contact VARCHAR(50),
    Password VARCHAR(255),
    Role VARCHAR(50),
    consultancyType VARCHAR(50),
    image VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    consultant_id INT,
    preferred_day VARCHAR(255),
    preferred_time VARCHAR(255),
    status VARCHAR(50) DEFAULT 'pending',
    final_appointment_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    is_read VARCHAR(10) DEFAULT '0',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS mood_tracking (
    user_id INT,
    mood_description TEXT
);

CREATE TABLE IF NOT EXISTS self_assessment (
    user_id INT,
    stress_level INT,
    happiness_level INT,
    anxiety_level INT,
    energy_level INT,
    sleep_quality INT
);

CREATE TABLE IF NOT EXISTS journals (
    user_id INT,
    title VARCHAR(255),
    content TEXT
);

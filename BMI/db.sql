CREATE DATABASE bmi_calculator;

USE bmi_calculator;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    weight FLOAT NOT NULL,
    height FLOAT NOT NULL,
    bmi FLOAT NOT NULL,
    date_recorded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

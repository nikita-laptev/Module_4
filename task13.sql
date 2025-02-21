-- Создание базы данных
CREATE DATABASE IF NOT EXISTS task_db;
USE task_db;

-- Создание таблицы User
CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Создание таблицы Project
CREATE TABLE Project (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
);

-- Создание таблицы Task
CREATE TABLE Task (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TINYINT(1) DEFAULT 0, -- 0 = не выполнено, 1 = выполнено
    name VARCHAR(255) NOT NULL,
    deadline DATE NOT NULL,
    project_id INT NOT NULL,
    FOREIGN KEY (project_id) REFERENCES Project(id) ON DELETE CASCADE
);
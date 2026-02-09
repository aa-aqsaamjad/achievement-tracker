<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$conn = new mysqli($_ENV['DB_HOST'],
                   $_ENV['DB_USER'],
                   $_ENV['DB_PASSWORD'],
                   $_ENV['DB_NAME']);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

echo "Database connection successful!";
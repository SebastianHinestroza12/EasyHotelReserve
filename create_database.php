<?php
$servername = "localhost";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Eliminar base de datos si ya existe
$sql = "DROP DATABASE IF EXISTS hotel_db";
if ($conn->query($sql) === true) {
  echo "Database dropped successfully<br>";
} else {
  echo "Error dropping database: " . $conn->error . "<br>";
}

// Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS hotel_db";
if ($conn->query($sql) === true) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

// Seleccionar base de datos
$conn->select_db("hotel_db");

// Crear tabla de usuarios
$sql = "CREATE TABLE IF NOT EXISTS auth_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
)";
if ($conn->query($sql) === true) {
  echo "Table auth_users created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Crear tabla de servicios
$sql = "CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
)";
if ($conn->query($sql) === true) {
  echo "Table services created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Insertar servicios por defecto
$services = [
  ['Room Service', 'Enjoy our exclusive room service available 24/7.'],
  ['Spa Treatment', 'Relax and rejuvenate with our specialized spa treatments.'],
  ['Fitness Center', 'Access our state-of-the-art fitness center.'],
  ['Swimming Pool', 'Dive into our luxurious swimming pool.'],
  ['Airport Shuttle', 'Convenient airport shuttle service.'],
  ['Concierge Service', 'Personalized concierge services at your fingertips.'],
  ['Free Wi-Fi', 'Stay connected with our complimentary Wi-Fi.'],
  ['Restaurant', 'Dine in our exquisite in-house restaurant.'],
  ['Laundry Service', 'Take advantage of our efficient laundry services.'],
  ['Business Center', 'Fully equipped business center for your needs.'],
  ['Conference Room', 'Book our modern conference room for your meetings.'],
  ['Bar', 'Relax with a drink at our stylish bar.'],
  ['Car Rental', 'Easily rent a car directly from our hotel.'],
  ['Valet Parking', 'Enjoy the convenience of valet parking.'],
  ['Gift Shop', 'Find unique gifts and souvenirs in our gift shop.'],
  ['Childcare Service', 'Professional childcare services available.'],
  ['Tour Desk', 'Plan your trips with our tour desk services.'],
  ['Wedding Services', 'Plan your special day with our wedding services.'],
  ['Pet Friendly', 'We welcome your furry friends.'],
  ['Room Upgrades', 'Ask about our room upgrade options for added luxury.']
];

foreach ($services as $service) {
  $sql = "INSERT INTO services (service_name, description) VALUES ('{$service[0]}', '{$service[1]}')";
  if ($conn->query($sql) === true) {
    echo "Service {$service[0]} inserted successfully<br>";
  } else {
    echo "Error inserting service: " . $conn->error . "<br>";
  }
}

// Crear tabla de reservas
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    document_number VARCHAR(50) NOT NULL,
    document_type VARCHAR(50) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    service_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (user_id) REFERENCES auth_users(id)
)";
if ($conn->query($sql) === true) {
  echo "Table bookings created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Cerrar conexión
$conn->close();

<?php
$host = "localhost";  // El servidor de la base de datos
$usuario = "root";    // Usuario de MySQL
$clave = "";         // Contraseña de MySQL (por defecto está vacía en XAMPP)
$base_de_datos = "xpscore_db";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $clave, $base_de_datos);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
// echo "Conexión exitosa";
?>

<?php
// insertarUsuario.php
include 'conexion.php'; // conexión a tu BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar valores del formulario
    $nombre_completo    = $_POST['name'];
    $email              = $_POST['email'];
    $fecha_nacimiento   = $_POST['date'];
    $sexo               = $_POST['sex'];
    $pais               = $_POST['country'];
    $password_hash      = $_POST['password']; // aquí podrías usar password_hash(), pero lo dejamos simple

    // INSERT en tu tabla usuarios (sin incluir id ni fecha_registro, que se generan automáticamente)
    $sql = "INSERT INTO usuarios 
                (nombre_completo, email, fecha_nacimiento, sexo, pais, password_hash)
            VALUES
                ('$nombre_completo', '$email', '$fecha_nacimiento', '$sexo', '$pais', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        // Mostrar mensaje y redirigir con JavaScript
        echo "<script>
                alert('Usuario registrado exitosamente.');
                window.location.href = '../index.html';
              </script>";
    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }

    $conn->close();
}
?>

<?php
session_start();

include 'conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los valores del formulario
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Buscamos al usuario con ese email y contraseña
    $sql = "SELECT id, nombre_completo FROM usuarios WHERE email = '$email' AND password_hash = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        // Usuario encontrado: iniciamos sesión
        $user = $result->fetch_assoc();
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['nombre_completo'];

        // Mensaje y redirección a la página principal
        echo "<script>
                alert('Inicio de sesión exitoso. ¡Bienvenido, " . addslashes($user['nombre_completo']) . "!');
                window.location.href = '../index.php';
              </script>";
    } else {
        // Credenciales incorrectas
        echo "<script>
                alert('Email o contraseña incorrectos.');
                window.location.href = '../iniciarSesion.html';
              </script>";
    }

    $conn->close();
}
?>

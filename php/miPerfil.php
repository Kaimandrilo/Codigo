<?php
// miPerfil.php
session_start();
include 'conexion.php';

// Verificar que el usuario ha iniciado sesión
if (empty($_SESSION['user_id'])) {
    header('Location: IniciarSesion.html');
    exit();
}

// Obtener datos del usuario desde la base de datos
$userId = (int)$_SESSION['user_id'];
$sql = "SELECT nombre_completo, email, pais, sexo FROM usuarios WHERE id = $userId LIMIT 1";
$result = $conn->query($sql);

if (!$result || $result->num_rows !== 1) {
    session_destroy();
    header('Location: IniciarSesion.html');
    exit();
}

$user = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - XPScore</title>
    <link rel="stylesheet" href="../Styles/perfil_Style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="logo-link">
            <h1>XPScore</h1>
        </a>
        <nav>
            <button type="button" onclick="window.location.href='../IniciarSesion.html'">Iniciar Sesión</button>
            <button type="button" onclick="window.location.href='../PC.html'">PC</button>
            <button type="button" onclick="window.location.href='../Xbox.html'">Xbox</button>
            <button type="button" onclick="window.location.href='../PS.html'">PlayStation</button>
            <form id="searchForm" onsubmit="return redirigirBusqueda()">
                <input type="text" id="searchBar" placeholder="Buscar noticias..." required>
                <button type="submit">Buscar</button>
            </form>
        </nav>
    </header>

    <h1 style="text-align: center; margin-top: 20px;">Mi Perfil</h1>

    <section class="perfil-foto">
        <img src="../Img/fotoPerfil.jpg" alt="Foto de Perfil">
    </section>

    <main class="perfil-container">
        <section class="perfil-info">
            <div class="campo">
                <label>Nombre:</label>
                <input type="text" id="username" value="<?php echo htmlspecialchars($user['nombre_completo']); ?>" readonly>
            </div>
            <div class="campo">
                <label>E-mail:</label>
                <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="campo">
                <label>País:</label>
                <input type="text" id="pais" value="<?php echo htmlspecialchars($user['pais']); ?>" readonly>
            </div>
            <div class="campo">
                <label>Sexo:</label>
                <input type="text" id="sexo" value="<?php echo htmlspecialchars($user['sexo']); ?>" readonly>
            </div>
            <div class="campo">
                <label>Contraseña:</label>
                <input type="password" id="password" value="********" readonly>
            </div>
        </section>
        <button id="btnEditar" type="button">Editar mi Perfil</button>
        <p></p>
        <button id="btnBack" type="button" onclick="window.location.href='../index.html'">Volver al Inicio</button>
    </main>

    <footer>
        <p>XPScore</p>
        <div class="icon-container">
            <img src="../Img/gorjeo.png" alt="Icono de Twitter">
            <img src="../Img/facebook.png" alt="Icono de Facebook">
            <img src="../Img/youtube.png" alt="Icono de YouTube">
            <img src="../Img/logotipo-de-instagram.png" alt="Icono de Instagram">
        </div>
    </footer>

    <script src="../Scripts/script.js"></script>
    
</body>
</html>

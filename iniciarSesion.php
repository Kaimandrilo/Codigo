<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="/Codigo/Styles/registro_inicio_Style.css">
</head>

<body>
    <header>
        <a href="index.php" class="logo-link">
            <h1>XPScore</h1>
        </a>

        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="php/CerrarSesion.php"><button>Cerrar Sesión</button></a>
            <?php else: ?>
            <a href="iniciarSesion.html"><button>Iniciar Sesión</button></a>
            <?php endif; ?>
            <button onclick="PC()">PC</button>
            <button onclick="Xbox()">Xbox</button>
            <button onclick="PS()">PlayStation</button>
            <form id="searchForm" onsubmit="return redirigirBusqueda()">
                <input type="text" id="searchBar" placeholder="Buscar videojuegos" required>
                <button type="submit">Buscar</button>
            </form>
        </nav>
    </header>

    <main>
        <h2 style="text-align: center; margin-top: 20px;">Iniciar Sesión</h2>
        <div class="login-container">
            <form action="php/iniciarSesion.php" method="post">

                <label for="username">Correo Electrónico:</label>
                <input type="text" id="email" name="email" placeholder="Ingrese su email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recordar</label>
                </div>

                <nav>
                    <button id="btnLogin">Iniciar Sesión</button>
                    <p> </p>
                </nav>
            </form>
        </div>
    </main>

    <button id="btnRegister" onclick="registrarse()">Registrarse</button>
    <p> </p>
    <button id="btnBack" onclick="volverInicio()">Volver al Inicio</button>

    <footer>
        <p>XPScore</p>
        <div class="icon-container">
            <img src="Img/gorjeo.png" alt="Icono de Twitter">
            <img src="Img/facebook.png" alt="Icono de Facebook">
            <img src="Img/youtube.png" alt="Icono de YouTube">
            <img src="Img/logotipo-de-instagram.png" alt="Icono de Instagram">
        </div>
    </footer>

    <script src="Scripts/script.js"></script>

</body>

</html>
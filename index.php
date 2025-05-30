<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="/Codigo/Styles/style.css">
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
            <a href="iniciarSesion.php"><button>Iniciar Sesión</button></a>
            <?php endif; ?>
            <button onclick="PC()">PC</button>
            <button onclick="Xbox()">Xbox</button>
            <button onclick="PS()">PlayStation</button>
            <form id="searchForm" action="Busqueda.php" method="post">
                <input type="text" id = "searchBar" name="searchBar" placeholder="Buscar videojuegos" required>
                <button type="submit">Buscar</button>
            </form>
        </nav>
    </header>
    <main>
        <section class="noticias" id="noticias">
            <!-- Las noticias se cargarán dinámicamente con JavaScript -->
        </section>
    </main>

    <main>
    </main>
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
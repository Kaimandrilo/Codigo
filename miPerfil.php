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
            <button onclick="iniciarSesion()">Iniciar Sesión</button>
            <button onclick="PC()">PC</button>
            <button onclick="Xbox()">Xbox</button>
            <button onclick="PS()">PlayStation</button>
            <form id="searchForm" onsubmit="return redirigirBusqueda()">
                <input type="text" id="searchBar" placeholder="Buscar noticias..." required>
                <button type="submit">Buscar</button>
            </form>
        </nav>
    </header>

    <h1 style="text-align: center; margin-top: 20px;"> Mi Perfil</h1>

    <main class="perfil-container">
        <section class="perfil-info">
            <div class="campo">
                <label>Username:</label>
                <input type="text" id="username" value="Usuario123" readonly>
            </div>

            <div class="campo">
                <label>E-mail:</label>
                <input type="email" id="email" value="usuario@example.com" readonly>
            </div>

            <div class="campo">
                <label>Nombres:</label>
                <input type="text" id="nombres" value="Juan Pérez" readonly>
            </div>

            <div class="campo">
                <label>País:</label>
                <input type="text" id="pais" value="Colombia" readonly>
            </div>

            <div class="campo">
                <label>Sexo:</label>
                <input type="text" id="sexo" value="Masculino" readonly>
            </div>

            <div class="campo">
                <label>Contraseña:</label>
                <input type="password" id="password" value="********" readonly>
            </div>

            <button id="editarPerfil">Editar mi Perfil</button>
            <button type="button" onclick="volverInicio()">Volver al Inicio</button>

        </section>

        <section class="perfil-foto">
            <img src="Images/default-profile.png" alt="Foto de Perfil">
        </section>
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

</body>

</html>
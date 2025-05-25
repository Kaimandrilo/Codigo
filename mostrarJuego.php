<?php
include 'php/conexion.php'; 
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
 
    $dsn = "mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4";
    $miPDO = new PDO ($dsn,$usuario,$clave);
    $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $miConsulta = $miPDO->prepare('SELECT * FROM videojuegos WHERE id = :id');
    $miConsulta->bindParam(':id', $id, PDO::PARAM_INT);
    $miConsulta->execute();
    $videojuego = $miConsulta->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="/Codigo/Styles/style.css">
    <link rel="stylesheet" href="/Codigo/Styles/stylesJuegos.css">
</head>

<body>
    <header>
        <a href="index.html" class="logo-link">
            <h1>XPScore</h1>
        </a>

        <nav>
            <button onclick="iniciarSesion()">Iniciar Sesión</button>
            <button onclick="PC()">PC</button>
            <button onclick="Xbox()">Xbox</button>
            <button onclick="PS()">PlayStation</button>
            <form id="searchForm" action="Busqueda.php" method="post">
                <input type="text" id = "searchBar" name="searchBar" placeholder="Buscar videojuegos" required>
                <button type="submit">Buscar</button>
            </form>
        </nav>
    </header>

  <body>
    <div class="game-info-container">
        <div class="game-cover">
            <iframe width="700" height="315" src="<?php echo $videojuego['trailer_enlace'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
        <div class="game-details">
            <div class="game-image">
                <img src="<?php echo $videojuego['imagen_portada'] ?>" alt="<?php echo $videojuego['titulo'] ?>">
            </div>
            <div class="game-info-text">
                <h2><?php echo $videojuego['titulo'] ?></h2>
                <p><strong>Desarrollador:</strong><?php echo $videojuego['desarrolladora'] ?></p>
                <p><strong>Año de lanzamiento:</strong><?php echo $videojuego['año'] ?></p>
                <p><strong>Género:</strong></p>
                <p><strong>Modo de juego:</strong></p>
            </div>
        </div>
        <div class="game-extra-info">
            <h2>INFORMACIÓN VIDEOJUEGO</h2>
            <p><strong>De qué trata:</strong> <?php echo $videojuego['descripcion'] ?></p>
            <p><strong>Disponible en:</strong> PC, PS3, PS4, PS5, Xbox 360, Xbox One, Xbox Series X/S.</p>
        </div>
        <div class="container">
            <h2>Reseñas</h2>
            <p><strong>Usuario 1:</strong> "La historia es genial y el modo online es adictivo."</p>
            <p><strong>Rating:</strong> <span class="review-rating">★★★★★</span></p>
            <p><strong>Usuario 2:</strong> "Gráficos realistas y muchas cosas por hacer. Lo juego desde hace años."</p>
            <p><strong>Rating:</strong> <span class="review-rating">★★★★★</span></p>
        </div>

        <div id="formulario-reseña" style="display: none;">
        <textarea id="reseña-input" placeholder="Escribe tu reseña..."></textarea>
        <select id="rating-input">
            <option value="1">★</option>
            <option value="2">★★</option>
            <option value="3">★★★</option>
            <option value="4">★★★★</option>
            <option value="5">★★★★★</option>
        </select>
        <button onclick="enviarReseña()">Enviar</button>
    </div>
    </div>
</body>


<footer>
    <p>XPScore</p>
    <div class="icon-container">
      <img src="Img/gorjeo.png" alt="Icono de Twitter">
      <img src="Img/facebook.png" alt="Icono de Facebook">
      <img src="Img/youtube.png" alt="Icono de YouTube">
      <img src="Img/logotipo-de-instagram.png" alt="Icono de Instagram">
    </div>
  </footer>
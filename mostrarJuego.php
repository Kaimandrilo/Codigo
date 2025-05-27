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

    $resenas = $miPDO->prepare('SELECT resenas.*, usuarios.nombre_completo FROM resenas INNER JOIN usuarios ON usuarios.id = resenas.usuario_id WHERE videojuego_id = :id');
    $resenas->bindParam(':id', $id, PDO::PARAM_INT);
    $resenas->execute();

    $stmt = $miPDO->prepare('
    SELECT generos.nombre 
    FROM generos 
    INNER JOIN videojuego_genero 
        ON videojuego_genero.genero_id = generos.id 
    WHERE videojuego_genero.videojuego_id = :id
    ');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);    

    $stmt = $miPDO->prepare('
    SELECT plataformas.nombre 
    FROM plataformas 
    INNER JOIN videojuego_plataforma 
        ON videojuego_plataforma.plataforma_id = plataformas.id 
    WHERE videojuego_plataforma.videojuego_id = :id
    ');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $plataformas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <p><strong>Género: 
                   <?php 
    if ($generos) {
        $nombres = array_column($generos, 'nombre');
        echo implode(', ', $nombres) . '.';
    } else {
        echo 'Sin género disponible.';
    }
?>
                <p><strong>Modo de juego:</strong></p>
            </div>
        </div>
        <div class="game-extra-info">
            <h2>INFORMACIÓN VIDEOJUEGO</h2>
            <p><strong>De qué trata:</strong> <?php echo $videojuego['descripcion'] ?></p>
            <p><strong>Disponible en:</strong>   
                <?php 
                    if ($plataformas) {
                    $nombres = array_column($plataformas, 'nombre');
                    echo implode(', ', $nombres) . '.';
                    } else {
                    echo 'Sin plataforma disponible.';
                    }
                ?></p>
        </div>
        <div class="container">
            <h2>Reseñas</h2>
                    <?php foreach ( $resenas as $resenias):?>
                    <p><strong><?php echo $resenias['nombre_completo']?>:</strong> <?php echo $resenias['comentario']?></p>
                    <p><strong>calificación:</strong> <span class="review-rating">
                        <?php for ($i = 0; $i < $resenias['calificacion']; $i++) {
                        echo '⭐';
                        }?>
                    </span></p>
                <?php endforeach ?>
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
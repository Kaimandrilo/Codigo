<?php
session_start();
include 'php/conexion.php'; 
$dsn = "mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4";
$miPDO = new PDO ($dsn,$usuario,$clave);
$miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Procesar reseña si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'], $_POST['calificacion'], $_POST['videojuego_id'])) {
        $comentario = $_POST['comentario'];
        $calificacion = (int) $_POST['calificacion'];
        $videojuego_id = (int) $_POST['videojuego_id'];

        // ⚠️ Simulación de usuario (reemplaza con sesión real)
        $usuario_id = $_SESSION['user_id'];

        $insertarResena = $miPDO->prepare('
            INSERT INTO resenas (comentario, calificacion, videojuego_id, usuario_id)
            VALUES (:comentario, :calificacion, :videojuego_id, :usuario_id)
        ');
        $insertarResena->execute([
            ':comentario' => $comentario,
            ':calificacion' => $calificacion,
            ':videojuego_id' => $videojuego_id,
            ':usuario_id' => $usuario_id
        ]);

        // Redirigir para evitar reenvío doble
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $videojuego_id);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['videojuego_id'])) {
    $id_resenia = (int) $_POST['id'];
    $videojuego_id = (int) $_POST['videojuego_id'];

    $eliminarResenia = $miPDO->prepare('
        DELETE FROM resenas WHERE id = :id
    ');
    $eliminarResenia->execute([
        ':id' => $id_resenia,
    ]);

    // Redirigir para evitar reenvío doble
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $videojuego_id);
    exit;
}

    // Obtener videojuego
    $miConsulta = $miPDO->prepare('SELECT * FROM videojuegos WHERE id = :id');
    $miConsulta->bindParam(':id', $id, PDO::PARAM_INT);
    $miConsulta->execute();
    $videojuego = $miConsulta->fetch(PDO::FETCH_ASSOC);

    // Promedio de reseñas

    $promedio = $miPDO->prepare('SELECT ROUND(AVG(calificacion),1) AS promedio FROM resenas WHERE videojuego_id = :id;');
    $promedio->bindParam(':id', $id, PDO::PARAM_INT);
    $promedio->execute();
    $mipromedio = $promedio->fetch(PDO::FETCH_ASSOC);
    // Reseñas
    $resenas = $miPDO->prepare('SELECT resenas.*, usuarios.nombre_completo 
        FROM resenas 
        INNER JOIN usuarios ON usuarios.id = resenas.usuario_id 
        WHERE videojuego_id = :id');
    $resenas->bindParam(':id', $id, PDO::PARAM_INT);
    $resenas->execute();

    // Géneros
    $stmt = $miPDO->prepare('
        SELECT generos.nombre 
        FROM generos 
        INNER JOIN videojuego_genero ON videojuego_genero.genero_id = generos.id 
        WHERE videojuego_genero.videojuego_id = :id
    ');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Plataformas
    $stmt = $miPDO->prepare('
        SELECT plataformas.nombre, videojuego_plataforma.enlace_videojuego 
        FROM plataformas 
        INNER JOIN videojuego_plataforma ON videojuego_plataforma.plataforma_id = plataformas.id 
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
<style>
        .estrellas {
            direction: rtl;
            unicode-bidi: bidi-override;
            font-size: 2rem;
            display: inline-flex;
        }

        .estrellas input[type="radio"] {
            display: none;
        }

        .estrellas label {
            color: #ccc;
            cursor: pointer;
        }

        .estrellas input[type="radio"]:checked ~ label,
        .estrellas label:hover,
        .estrellas label:hover ~ label {
            color: gold;
        }
</style>
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
                <p><strong>Puntuación: </strong><?php echo $mipromedio['promedio'] ?> ⭐ </p>
                <p><strong>Desarrollador: </strong><?php echo $videojuego['desarrolladora'] ?></p>
                <p><strong>Año de lanzamiento: </strong><?php echo $videojuego['año'] ?></p>
                <p><strong>Género: 
                   <?php 
    if ($generos) {
        $nombres = array_column($generos, 'nombre');
        echo implode(', ', $nombres) . '.';
    } else {
        echo 'Sin género disponible.';
    }
?>
                <p><strong>Modo de juego:</strong>
                <?php echo $videojuego['modo_de_juego'] ?>
                </p>
            </div>
        </div>
        <div class="game-extra-info">
            <h2>INFORMACIÓN VIDEOJUEGO</h2>
            <p><strong>De qué trata:</strong> <?php echo $videojuego['descripcion'] ?></p>
            <p><strong>Disponible en:</strong>   
                <?php
if ($plataformas) {
    foreach ($plataformas as $plataforma) {
        echo '<a href="' . $plataforma['enlace_videojuego'] . '" target="_blank">' . $plataforma['nombre'] . '</a> ';
    }
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
                    </span>
                    </p>
                    <?php if (isset($_SESSION['user_id']) == $resenias['usuario_id']): ?>
                    <form method="post" action="">
                    <input type="hidden" name="videojuego_id" value="<?= htmlspecialchars($id) ?>">
                    <input type="hidden" name="id" value="<?= $resenias['id'] ?>">
                    <button type="submit">Eliminar Reseña</button>
                    </form>

                    <?php endif; ?>  
                <?php endforeach ?>
        </div>

        <div class="review-form">   

        <?php if (isset($_SESSION['user_id'])): ?>
        <h2>Deja tu reseña</h2>
            <form method="post" action="">
                <input type="hidden" name="videojuego_id" value="<?= htmlspecialchars($id) ?>">

                <label for="comentario">Comentario:</label><br>
                <textarea name="comentario" id="comentario" rows="4" required></textarea><br><br>

                <label>Calificación:</label><br>
                <div class="estrellas">
                    <input type="radio" name="calificacion" id="estrella5" value="5" required>
                    <label for="estrella5">★</label>

                    <input type="radio" name="calificacion" id="estrella4" value="4">
                    <label for="estrella4">★</label>

                    <input type="radio" name="calificacion" id="estrella3" value="3">
                    <label for="estrella3">★</label>

                    <input type="radio" name="calificacion" id="estrella2" value="2">
                    <label for="estrella2">★</label>

                    <input type="radio" name="calificacion" id="estrella1" value="1">
                    <label for="estrella1">★</label>
                </div><br><br>

                <button type="submit">Enviar Reseña</button>
            </form>
        <?php else: ?>
    <p>Para poder generar una reseña incia sesión</p>
    <a href="iniciarSesion.php">Iniciar sesión</a>
<?php endif; ?>
            
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
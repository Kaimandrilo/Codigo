<?php
session_start();
include 'php/conexion.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_videojuego = $_POST['searchBar'];

$dsn = "mysql:host=$host;dbname=$base_de_datos;charset=utf8mb4";
$miPDO = new PDO ($dsn,$usuario,$clave);
$miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$miConsulta = $miPDO->prepare('SELECT * FROM videojuegos WHERE titulo LIKE :busqueda');
    
    $parametro = '%' . $nombre_videojuego . '%';
    $miConsulta->bindParam(':busqueda', $parametro, PDO::PARAM_STR);
    $miConsulta->execute();

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="/Codigo/Styles/style.css">
    <link rel="stylesheet" href="/Codigo/Styles/stylesCards.css">
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

    <main>
    <?php foreach ( $miConsulta as $videojuego):?>
            <div class="game-card">
            <img src="<?php echo $videojuego['imagen_portada']?>" alt="<?php echo $videojuego['titulo']?>">
            <div>
            <h3><?php echo $videojuego['titulo']?></h3>
            <p><?php echo $videojuego['descripcion']?></p>
            <button onclick="window.location.href='mostrarJuego.php?id=<?php echo $videojuego['id']; ?>'">Ver más</button>
            </div>
            </div>
            <?php endforeach ?>
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
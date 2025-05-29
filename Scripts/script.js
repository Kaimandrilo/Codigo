    const noticias = [
        {
            titulo: "Nuevo juego para PC",
            categoria: "PC",
            resumen: "Este es el nuevo título que revolucionará el gaming en PC.",
            imagen: "Img/1.jpg"
        },
        {
            titulo: "Xbox anuncia novedades",
            categoria: "Xbox",
            resumen: "Microsoft presenta novedades para su consola Xbox.",
            imagen: "Img/2.jpg"
        },
        {
            titulo: "PlayStation 5 recibe actualización",
            categoria: "PlayStation",
            resumen: "Sony lanza una nueva actualización para PS5.",
            imagen: "Img/3.jpg"
        },
        {
            titulo: "El mejor setup gamer",
            categoria: "PC",
            resumen: "Descubre cómo mejorar tu setup de gaming en PC.",
            imagen: "Img/4.jpg"
        }
    ];

    const seccion2 = [
        {
            titulo: "Nuevo juego para PC",
            categoria: "PC",
            resumen: "Este es el nuevo título que revolucionará el gaming en PC.",
            imagen: "Img/1.jpg"
        },
        {
            titulo: "Xbox anuncia novedades",
            categoria: "Xbox",
            resumen: "Microsoft presenta novedades para su consola Xbox.",
            imagen: "Img/2.jpg"
        },
        {
            titulo: "PlayStation 5 recibe actualización",
            categoria: "PlayStation",
            resumen: "Sony lanza una nueva actualización para PS5.",
            imagen: "Img/3.jpg"
        },

    ];

    function cargarNoticias(filtro = null) {
        const contenedor = document.getElementById("noticias");
        contenedor.innerHTML = "";

        const noticiasFiltradas = filtro ? noticias.filter(n => n.categoria === filtro) : noticias;

        noticiasFiltradas.forEach(noticia => {
            const div = document.createElement("div");
            div.classList.add("noticia");
            div.innerHTML = `
                <img src="${noticia.imagen}" alt="${noticia.titulo}">
                <h2>${noticia.titulo}</h2>
                <p>${noticia.resumen}</p>
            `;
            contenedor.appendChild(div);
        });
    }

    function cargarSeccion2(filtro = null) {
        const contenedor = document.getElementById("seccion2");
        contenedor.innerHTML = "";

        const seccion2Filtradas = filtro ? seccion2.filter(n => n.categoria === filtro) : seccion2;

        seccion2Filtradas.forEach(seccion2 => {
            const div = document.createElement("div");
            div.classList.add("seccion2");
            div.innerHTML = `
                <img src="${seccion2.imagen}" alt="${seccion2.titulo}">
                <h2>${seccion2.titulo}</h2>
                <p>${seccion2.resumen}</p>
            `;
            contenedor.appendChild(div);
        });
    }

    function filtrarNoticias(categoria) {
        cargarNoticias(categoria);
    }

    function iniciarSesion() {
        window.location.href = "iniciarSesion.html";
    }
    function CerrarSesion() {
        window.location.href = "CerrarSesion.php";
    }

    function PC() {
        window.location.href = "pc.html";
    }

    function Xbox() {
        window.location.href = "xbox.html";
    }

    function PS() {
        window.location.href = "ps.html";
    }
function redirigirBusqueda() {
    let query = document.getElementById("searchBar").value.trim();
    if (query) {
        window.location.href = `busqueda.html?search=${encodeURIComponent(query)}`;
    }
    return false; // Previene el comportamiento por defecto del formulario
}
    const juegosInfo = {
        "undertale": {
            nombre: "Undertale",
            descripcion: "Un RPG donde las decisiones afectan la historia.",
            imagen: "/Codigo/Img/undertale.png",
            pagina: "juegos/undertale.html"
        },
        "minecraft": {
            nombre: "Minecraft",
            descripcion: "Un mundo abierto de construcción con bloques.",
            imagen: "/Codigo/Img/minecraft.png",
            pagina: "juegos/minecraft.html"
        },
        "gtav": {
            nombre: "Grand Theft Auto V",
            descripcion: "RPG lanzado en 2015, basado en las novelas de Andrzej Sapkowski. En este juego, encarnas a Geralt de Rivia, un cazador de monstruos. Destaca por su narrativa compleja, decisiones con consecuencias, y un vasto mundo lleno de historias inmersivas.",
            imagen: "/Codigo/Img/gtav.jpg",
            pagina: "juegos/gtav.html"
        },
        "ocarina": {
        nombre: "The Legend of Zelda: Ocarina of Time",
        descripcion: "Lanzado en 1998 para Nintendo 64, este juego revolucionó el género de aventuras con su mundo abierto y narrativa épica. Controlas a Link, un joven que debe salvar Hyrule del malvado Ganondorf usando la mística Ocarina del Tiempo.",
        imagen: "/Codigo/Img/ocarina.jpg",
        pagina: "juegos/ocarina.html"
}
    };
    function buscarJuego() {
    let params = new URLSearchParams(window.location.search);
    let query = params.get("search") || ""; // Captura el parámetro desde la URL

    let resultado = document.getElementById("resultados");
    resultado.innerHTML = `<h2>Resultados para: "${query}"</h2>`; // Esto asegura que siempre se muestre un encabezado

    let juegosRelacionados = Object.values(juegosInfo).filter(juego =>
        juego.nombre.toLowerCase().includes(query.toLowerCase())
    );

    if (juegosRelacionados.length > 0) {
        juegosRelacionados.forEach(juego => {
            let juegoHTML = `
                <div class="game-card">
                    <img src="${juego.imagen}" alt="${juego.nombre}">
                    <div>
                        <h3>${juego.nombre}</h3>
                        <p>${juego.descripcion}</p>
                        <button onclick="window.location.href='${juego.pagina}'">Ver más</button>
                    </div>
                </div>
            `;
            resultado.innerHTML += juegoHTML;
        });
    } else {
        resultado.innerHTML += "<p>No se encontraron juegos relacionados.</p>";
    }
}
document.addEventListener("DOMContentLoaded", function () {
    let params = new URLSearchParams(window.location.search);
    let query = params.get("search") || "";  // Si no existe, usa una cadena vacía

    let resultadosContainer = document.getElementById("resultados");
    resultadosContainer.innerHTML = `<h2>Resultados para: "${query}"</h2>`;

    let juegosRelacionados = Object.values(juegosInfo).filter(juego =>
        juego.nombre.toLowerCase().includes(query.toLowerCase())
    );

    if (juegosRelacionados.length > 0) {
        juegosRelacionados.forEach(juego => {
            let juegoHTML = `
                <div class="game-card">
                    <img src="${juego.imagen}" alt="${juego.nombre}">
                    <div>
                        <h3>${juego.nombre}</h3>
                        <p>${juego.descripcion}</p>
                        <button onclick="window.location.href='${juego.pagina}'">Ver más</button>
                    </div>
                </div>
            `;
            resultadosContainer.innerHTML += juegoHTML;
        });
    } else {
        resultadosContainer.innerHTML += "<p>No se encontraron resultados.</p>";
    }
});

    function volverInicio() {
        window.location.href = "index.php"; // Ajusta según la ubicación de tu archivo principal
    }

    function inicioSesion() {
        const username = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (username && password) {
            alert("Iniciando sesión...");
            // Aquí puedes agregar la lógica para validar el usuario con el backend
        } else {
            alert("Por favor, complete todos los campos.");
        }
    }

    function registrarse() {
        window.location.href = "Registro.html"; // Ajusta según la ubicación de tu formulario de registro
    }
    // Cargar todas las noticias al inicio
    document.addEventListener("DOMContentLoaded", () => cargarNoticias());

    // Simulación del usuario logueado (puedes conectar esto con tu sistema de autenticación)
const usuarioLogueado = {
    nombre: "Juan Pérez",
    logueado: true  // Cambiar a false para simular un usuario no logueado
};

// Reseñas existentes
const reseñas = [
    { usuario: "Usuario 1", texto: "La historia es genial y el modo online es adictivo.", rating: 5 },
    { usuario: "Usuario 2", texto: "Gráficos realistas y muchas cosas por hacer. Lo juego desde hace años.", rating: 5 }
];

// Función para verificar la sesión y mostrar/ocultar el formulario
function verificarSesion() {
    const formularioReseña = document.getElementById("formulario-reseña");

    if (usuarioLogueado.logueado) {
        formularioReseña.style.display = "block";
    } else {
        formularioReseña.style.display = "none";
    }

    mostrarReseñas();
}

// Función para mostrar las reseñas
function mostrarReseñas() {
    const contenedorReseñas = document.getElementById("reseñas-container");
    contenedorReseñas.innerHTML = "";  // Limpiar el contenedor

    reseñas.forEach(reseña => {
        const reseñaHTML = `
            <div class="reseña">
                <p><strong>${reseña.usuario}:</strong> "${reseña.texto}"</p>
                <p><strong>Rating:</strong> <span class="review-rating">${'★'.repeat(reseña.rating)}</span></p>
            </div>
        `;
        contenedorReseñas.innerHTML += reseñaHTML;
    });
}

// Función para enviar una nueva reseña
function enviarReseña() {
    if (!usuarioLogueado.logueado) {
        alert("Debes iniciar sesión para dejar una reseña.");
        return;
    }

    const reseñaInput = document.getElementById("reseña-input");
    const ratingInput = document.getElementById("rating-input");

    const nuevaReseña = reseñaInput.value.trim();
    const rating = parseInt(ratingInput.value);

    if (nuevaReseña && rating) {
        reseñas.push({ usuario: usuarioLogueado.nombre, texto: nuevaReseña, rating: rating });
        reseñaInput.value = "";  // Limpiar campo de entrada
        mostrarReseñas();
    }
}

// Ejecutar al cargar la página
document.addEventListener("DOMContentLoaded", verificarSesion); 
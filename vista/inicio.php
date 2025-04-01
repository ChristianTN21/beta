<?php
// Iniciar sesión
session_start();

// Requerir archivos y configuraciones
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado1.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/BD.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/modelo/funciones.php";
$menu = new Admin_Model();

date_default_timezone_set('America/Mexico_City');

// Obtener el ID del usuario desde el parámetro GET
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Manejar el caso en el que no se proporciona el ID del usuario
    // Puede ser redirigir al usuario a una página de inicio de sesión o mostrar un mensaje de error.
    exit("Error: No se proporcionó el ID del usuario.");
}

// Si se ha enviado el formulario (compra)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_producto = $_POST['id_producto'];
    $Nombre_producto = $_POST['Nombre_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Crear un array asociativo con la información del producto
    $producto = array(
        'id_producto' => $id_producto,
        'Nombre_producto' => $Nombre_producto,
        'precio' => $precio,
        'cantidad' => $cantidad
    );

    // Verificar si el carrito del usuario ya existe en la sesión
    if (!isset($_SESSION['carrito'][$user_id])) {
        $_SESSION['carrito'][$user_id] = array();
    }

    // Agregar el producto al carrito del usuario
    $_SESSION['carrito'][$user_id][] = $producto;

    // Notificar al usuario
    
}



// Consulta SQL para obtener productos
$sql = "SELECT 
p.moneda, 
p.peso_pza, 
p.id_producto, 
p.descripcion AS descripcion_producto, 
c.descripcion AS descripcion_clasificacion, 
p.Nombre_producto, 
p.descripcion AS descripcion_producto, 
CONCAT(p.precio, ' ', p.moneda) AS precio_con_moneda,
p.cantidad, 
p.imagen 
FROM 
producto p
INNER JOIN 
clasifficacion c ON p.id_clasificacion = c.id_clasificacion;
";
$conexion = Conectado::conexion();
$result = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
    <link href="../css/responsividad_tienda.css" rel="stylesheet" type="text/css">
</head>
<style>

</style>
<body>
<?php
// Obtener el ID del usuario desde el parámetro GET
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Manejar el caso en el que no se proporciona el ID del usuario
    // Puede ser redirigir al usuario a una página de inicio de sesión o mostrar un mensaje de error.
    exit("Error: No se proporcionó el ID del usuario.");
}

// Obtener la cantidad de productos en el carrito para el usuario actual
$cantidad_en_carrito = isset($_SESSION['carrito'][$user_id]) ? count($_SESSION['carrito'][$user_id]) : 0;
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo ($cantidad_en_carrito > 0) ? '../vista/ver_carrito.php?id=' . $user_id : '#'; ?>"> <span class='bi bi-basket2-fill' ></span>
      (<?php echo $cantidad_en_carrito; ?>)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
    <a class="nav-link" href="../vista/acerca_de.php?id=<?php echo $user_id ?>">
        Nosotros <span class="bi bi-person-circle"></span>
    </a></li>
        <li class="nav-item">
          <a class="nav-link" href="../controlador/controladorComentario.php?id=<?php echo $user_id ?>">Comentarios y sugerencias<span class="bi bi-telephone-outbound-fill"></span></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true"><b>Bienvenido:</b> <?php
						$menu->mostrarCliente();
					?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div id="video-container">
        <video  autoplay loop muted>
            <source src="../img_pagina/Kafetzin coffee.mp4" type="video/mp4">
            Tu navegador no admite la reproducción de video.
        </video>
    </div>

    <div class="d-flex" style="text-align: center;">
        <?php
        // Mostrar productos
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <div id="card" class="card mx-2 my-2" >
                <img src="<?php echo $mostrar['imagen'] ?>" class="card-img-top"  id="img_card" >

                <div class="card-body">
                <b><p  class="card-text" id="precio"><?php echo $mostrar['precio_con_moneda'] ?>  <?php echo $mostrar['peso_pza'] ?></p></b><br>
                    <b><p id="Nombre" class="card-title"><?php echo $mostrar['Nombre_producto'] ?></p></b>
                    
                    <p id="clas" class="card-text"><?php echo $mostrar['descripcion_clasificacion'] ?></p>
                    
                    <p id="descrip" class="card-text"><?php echo $mostrar['descripcion_producto'] ?></p>
                   

                    <!-- Formulario para agregar productos al carrito -->
                    <form method="post" action="">

                        <input type="hidden" name="id_producto" value="<?php echo $mostrar['id_producto']; ?>">
                        
                        <input type="hidden" name="Nombre_producto" value="<?php echo $mostrar['Nombre_producto']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $mostrar['precio_con_moneda']; ?>">
                        <input type="hidden" name="cantidad" value="<?php echo $mostrar['cantidad']; ?>">
                        <button name="" id="btn_card" type="submit" class="btn btn-primary">Comprar <span class='bi bi-cart4' ></span></button>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <hr>
<br><br>


    <?php

require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";
$conn = Conectado::conexion(); 

if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener todos los comentarios
$query = "SELECT * FROM comentario ORDER BY fecha DESC";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<div class="container mt-4">
    <h3 class="mb-4">Opiniones de los usuarios</h3>

    <div id="comentarios-container">
        <?php 
        $contador = 0;
        while ($comentario = $result->fetch_assoc()): 
            $contador++;
        ?>
            <div class="card mb-3 shadow-sm comentario" style="display: <?php echo ($contador > 1) ? 'none' : 'block'; ?>;">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php 
                        $correo = explode("@", $comentario['correo_usuario']);
                        $correo_oculto = substr($correo[0], 0, 2) . str_repeat('*', max(0, strlen($correo[0]) - 1)) . '@' . $correo[1];
                        echo htmlspecialchars($correo_oculto);
                        ?>
                    </h6>

                    <div class="mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="bi <?php echo ($i <= $comentario['estrellas']) ? 'bi-star-fill text-warning' : 'bi-star'; ?>"></span>
                        <?php endfor; ?>
                    </div>

                    <p class="card-text"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                    <small class="text-muted">Publicado el <?php echo date("d M Y", strtotime($comentario['fecha'])); ?></small>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <button id="verMas" class="btn btn-outline-primary"><i class="bi bi-chat-dots"></i>Ver más</button>
    <br>
    <hr>
</div>

<script>
document.getElementById("verMas").addEventListener("click", function() {
    let comentarios = document.querySelectorAll("#comentarios-container .comentario");

    comentarios.forEach(comentario => {
        comentario.style.display = "block"; // Mostrar todos los comentarios
    });

    this.style.display = "none"; // Ocultar el botón después de mostrar los comentarios
});
</script>

<?php $conn->close(); ?>




</body>

<?php
// Incluir el pie de página
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php";
?>

</html>

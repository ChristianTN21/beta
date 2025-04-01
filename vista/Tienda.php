<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap Icons -->
    <link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="/Estadia/css/responsividad_tienda.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4.6 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado1.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado2.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/BD.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/modelo/funciones.php";
$menu = new Admin_Model();

date_default_timezone_set('America/Mexico_City');

// Verificar si el usuario tiene un ID
$tieneID = isset($_SESSION['id_cliente']);

// Si se ha enviado el formulario (compra)

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    // Recuperar los datos del formulario de manera segura
    $nombre = trim($_POST['nombre']);
    $ape_p = trim($_POST['ape_p']);
    $ape_m = trim($_POST['ape_m']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Encripta la contraseña

    // Establecer la conexión
    $conexion = Conectado::conexion();
    
    // Preparar la sentencia SQL
    $sql_insert_cliente = "INSERT INTO cliente (Nombre, ape_p, ape_m, email, pass) VALUES (?, ?, ?, ?, ?)";

    // Crear la sentencia preparada
    if ($stmt = mysqli_prepare($conexion, $sql_insert_cliente)) {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $ape_p, $ape_m, $email, $pass);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Registro realizado con éxito.";
        } else {
            echo "Error al procesar el registro: " . mysqli_stmt_error($stmt);
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta.";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}

?>


<body>



<div id="video-container">
    <video autoplay loop muted>
        <source src="../Estadia/img_pagina/Kafetzin coffee.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de video.
    </video>
</div>
  

    <div class="d-flex" style="text-align: center;">
        <?php
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

        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <div id="card" class="card mx-2 my-2" >
            <img src="<?php echo '../Estadia/IMG/' . $mostrar['imagen'] ?>" class="card-img-top"  >

                <div class="card-body">
                    <h3 id="Nombre" class="card-title"><?php echo $mostrar['Nombre_producto'] ?></h3>
                    <p id="clas" class="card-text"><?php echo $mostrar['descripcion_clasificacion'] ?></p>
                    <p id="descrip" class="card-text"><?php echo $mostrar['descripcion_producto'] ?></p>
                    <b><p   class="card-text" id="precio"><?php echo $mostrar['precio_con_moneda'] ?></p></b><br>
                    
                    <!-- Decidir si mostrar formulario de compra o registro -->
                    <?php if ($tieneID) { ?>
                        <!-- Formulario de compra -->
                        <form method="post" action="">
                            <input type="hidden" name="id_producto" value="<?php echo $mostrar['id_producto']; ?>">
                            <input type="hidden" name="Nombre_producto" value="<?php echo $mostrar['Nombre_producto']; ?>">
                            <input type="hidden" name="precio" value="<?php echo $mostrar['precio_con_moneda']; ?>">
                            <input type="hidden" name="cantidad" value="<?php echo $mostrar['cantidad']; ?>">
                            <button id="btn_card" type="submit" class="btn btn-primary" onmouseover="mostrarTexto(this, '<?php echo $mostrar['precio'] ?>')">Comprar</button>
                        </form>
                    <?php } else { ?>
                        
                        <!-- Botón para abrir el modal de registro -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registroModal">
                            Registrarse
                        </button>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="formulario" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center;" id="registroModalLabel"><b>Registrate para crear un perfil</b></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div  class="modal-body">
                    <!-- Agrega aquí los campos del formulario de registro -->
                    <form method="post" action="">
                        <!-- Campos de registro -->
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" required><br>

                        <label for="ape_p">Apellido Paterno:</label>
                        <input class="form-control" type="text" name="ape_p" required><br>

                        <label for="ape_m">Apellido Materno:</label>
                        <input class="form-control" type="text" name="ape_m" required><br>

                        <label for="email">Correo electrónico:</label>
                        <input class="form-control" type="email" name="email" required><br>

                        <label for="pass">Contraseña:</label>
                        <input class="form-control" type="password" name="pass" required><br>

                        <!-- Agrega más campos según sea necesario -->

                        <button type="submit" style="margin-left: 40%;"  class="btn btn-primary">Registrarse</button>
                        
                    </form><br>
                    <p style="text-align: center;">¿Ya tienes una cuenta? <a href="/estadia/controlador/Vali_cliente_controlador.php" >Iniciar sesión</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin-right: 40%;" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarTexto(boton, precio) {
            // Cambia el texto al pasar el mouse
            boton.innerText = 'Pagar ' + precio;

            // Restaura el texto original al quitar el mouse
            boton.onmouseout = function () {
                boton.innerText = 'Comprar';
            };
        }
    </script>
</body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php";
?>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="../framerwork/bootstrap-5.2.0/css/bootstrap.min.css">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    
</head>

<style>
        h1 {
            text-align: center;
            padding-top: 3%;
            color: white;
        }

        h3 {
            text-align: center;
            padding-top: 15%;
            color: gray;
        }

        p {
            text-align: center;
            font-size: 25px;
            color: white;
        }

        body {
            background: url(../img_pagina/fondo.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            width: 100%;
        }

        button {
            width: 200px;
        }

        /* Estilos para pantallas pequeñas */
        @media screen and (max-width: 767px) {
    .table-container {
        overflow-x: auto; /* Permite desplazamiento horizontal */
    }

    .table {
        width: 100%;
    }

    .table td,
    .table th {
        padding: 0.5rem; /* Ajusta el relleno de las celdas */
        font-size: 12px; /* Ajusta el tamaño del texto */
    }
}


        
    </style>
<body>
<?php 
// Iniciar sesión
session_start();

// Requerir archivos y configuraciones necesarias
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado1.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/BD.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/modelo/funciones.php";
$menu = new Admin_Model();
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/config.php";

date_default_timezone_set('America/Mexico_City');

// Obtener el ID del usuario desde el parámetro GET
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Manejar el caso en el que no se proporciona el ID del usuario
    // Puede ser redirigir al usuario a una página de inicio de sesión o mostrar un mensaje de error.
    exit("Error: No se proporcionó el ID del usuario.");
}

// Manejar la acción de agregar al carrito
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['accion']) && $_GET['accion'] == 'agregar' && isset($_GET['id']) && isset($_GET['key'])) {
    $productKey = $_GET['key'];

    // Verificar si el producto existe en el carrito
    if (isset($_SESSION['carrito'][$user_id][$productKey])) {
        // Incrementar la cantidad si el producto ya está en el carrito
        $_SESSION['carrito'][$user_id][$productKey]['cantidad']++;
    } else {
        // Agregar el producto al carrito si no existe
        // Aquí debes obtener los detalles del producto y agregarlos al carrito
        // Usando $productKey, puedes obtener los detalles del producto desde tu fuente de datos
        // y agregarlos al array $_SESSION['carrito'][$user_id]
    }
}

// Manejar la acción de eliminar del carrito
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id']) && isset($_GET['key'])) {
    $productKey = $_GET['key'];

    // Verificar si el producto existe en el carrito
    if (isset($_SESSION['carrito'][$user_id][$productKey])) {
        // Disminuir la cantidad y eliminar si llega a cero
        if ($_SESSION['carrito'][$user_id][$productKey]['cantidad'] > 1) {
            $_SESSION['carrito'][$user_id][$productKey]['cantidad']--;
        } else {
            unset($_SESSION['carrito'][$user_id][$productKey]);
        }
    }
}

// Verificar si el carrito del usuario existe en la sesión
if (!isset($_SESSION['carrito'][$user_id]) || empty($_SESSION['carrito'][$user_id])) {
    echo "<h3>Tu carrito está vacío.</h3>";
    
    // Redirigir al usuario al inicio
    echo '<script>
        setTimeout(function() {
            window.location.href = "../vista/inicio.php?id='.$user_id.'";
        }, 000); // Redirigir después de 3 segundos (puedes ajustar este valor)
    </script>';
} else {
    // Variable para almacenar el nombre del producto con su precio
    $productosConPrecioConcatenados = "";

    // Mostrar la información de productos en el carrito
    echo "<h1>Productos en el carrito:</h1>";

    $total = 0; // Inicializar el total en 0

    echo "<table class='table table-dark table-striped' style='  width: 70%; margin-left: 15%;'>";

    echo "<tr>
        <th  align='center' height='25' width='5%' >ID</th>
        <th align='center' height='25' width='20%' >Nombre del producto</th>
        <th align='center' height='25' width='10%' >precio</th>
        <th  align='center' height='25' width='5%' >cantidad</th>
        <th  align='center' height='25' width='5%' >agregar</th>
        <th  align='center' height='25' width='5%' >Eliminar</th>
    </tr>";

    foreach ($_SESSION['carrito'][$user_id] as $key => $producto) {
        // Utilizar preg_replace para eliminar caracteres no numéricos del precio
        $precio = preg_replace("/[^0-9.]/", "", $producto['precio']);

        // Verificar si las variables son numéricas antes de realizar operaciones matemáticas
        if (is_numeric($precio)) {
            $total += floatval($precio) * $producto['cantidad']; // Convertir a número y sumar al total

            // Concatenar el nombre del producto con su precio
            $productosConPrecioConcatenados .= $producto['Nombre_producto'] . " - $" . $producto['precio'] . ", ";

            echo "<tr>
                <td style='color: white;'>{$producto['id_producto']}</td>
                <td style='color: white;'>{$producto['Nombre_producto']}</td>
                <td style='color: white;'>{$producto['precio']}</td>
                <td style='color: white;'>{$producto['cantidad']}</td>
                <td style='color: white;'><a href='?id=$user_id&accion=agregar&key=$key'>+</a></td>
                <td style='color: white;'><a href='?id=$user_id&accion=eliminar&key=$key'>Eliminar</a></td>
            </tr>";
        } else {
            // Manejar el caso en el que el precio no es numérico
            echo "<tr>
                <td colspan='6'>Error: Precio no numérico para {$producto['Nombre_producto']}</td>
            </tr>";
        }
    }

    // Agregar una fila para mostrar el total
    echo "<tr>
        <td colspan='3'></td>
        <td  align='center' height='25' ><b>Total:</b></td>
        <td  align='center' height='25'>$total</td>
        <td colspan='2'></td>
    </tr>";

    echo "</table>"; // Cerrar la etiqueta <table>

    // Mostrar la concatenación de nombre del producto con su precio
    "<p><b>Productos con Precio:</b> " . rtrim($productosConPrecioConcatenados, ", ") . "</p><br><br>";



    // Mostrar el total al final
    if ($total > 0) {
        echo "<p><b>Total a Pagar:<br></b> $total pesos</p>";
    
        // Botones para comprar y vaciar
        echo '<form method="post" action="" id="comprarForm" style="text-align: center;">
        <input type="hidden" name="comprar" value="1">
        <input type="hidden" name="accion" value="comprar">
        <input type="hidden" name="user_id" value="'.$user_id.'">
        
        <button type="submit" class="btn btn-danger" style="margin-left:45px" name="accion" value="vaciar">Vaciar Carrito</button>
        <a href="../vista/inicio.php?id='.$user_id.'" class="btn btn-secondary" style="margin-left:45px">Regresar</a>
    </form><br><br>';
    
        // Agrega un script JavaScript para redirigir después de enviar el formulario
        echo '<script>
            function realizarCompra() {
                var form = document.getElementById("comprarForm");
                form.submit(); // Envía el formulario normalmente
    
                // Redirige manualmente a la página pdf.php
                window.location.href = "../vista/pdf.php?id_cliente='.$user_id.'";
            }
        </*script>';
      
    } else {
        echo "No se pudo calcular el total debido a valores no numéricos en el carrito.";
    }}

// Manejar la acción de comprar o vaciar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'])) {
    if ($_POST['accion'] == 'comprar') {
        // Insertar productos en la tabla tiket_temporal
        $insertQuery = "INSERT INTO ticket_temporal (id_cliente, id_producto, Nombre_producto, precio, cantidad) VALUES ";
        $values = array();

        foreach ($_SESSION['carrito'][$user_id] as $producto) {
            $idProducto = $producto['id_producto'];
            $productName = $producto['Nombre_producto'];
            $productPrice = preg_replace("/[^0-9.]/", "", $producto['precio']);
            $productQuantity = $producto['cantidad'];
            $values[] = "('$user_id', '$idProducto', '$productName', '$productPrice', '$productQuantity')";
        }

        $insertQuery .= implode(",", $values);
        $conexion = Conectado::conexion();

        if (mysqli_query($conexion, $insertQuery)) {
            echo "Datos del carrito insertados en la tabla tiket_temporal.";
        } else {
            echo "Error al insertar datos en la tabla tiket_temporal: " . mysqli_error($conexion);
        }

        // Vaciar el carrito después de comprar
        unset($_SESSION['carrito'][$user_id]);
        echo "Compra realizada. El carrito ha sido vaciado.";
    } elseif ($_POST['accion'] == 'vaciar') {
        // Código para vaciar el carrito
        unset($_SESSION['carrito'][$user_id]);
        echo "El carrito ha sido vaciado.";
    }
}
$productQuantity = $producto['cantidad'];
$user_id = $_GET['id'];
$productName = $producto['Nombre_producto'];
$productPrice = preg_replace("/[^0-9.]/", "", $producto['precio']);
$productosConPrecioConcatenados .= $producto['Nombre_producto'] . " - $" . $producto['precio'] . ", ";
?>
<!------ aqui es de paypal ----->
<style>
/*  para celulares     */
@media screen and (max-width:400px){
    #paypal-button-container {
        width: 100%;
    }
}
@media screen and (min-width:400px){
    #paypal-button-container {
        width: 250px;
        display: inline-block;
    }
}
</style>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<div id="paypal-button-container"></div>
<script>


    paypal.Button.render({
    env: 'sandbox',/*  poner production o no funciona wey */
    style:{
        label:'checkout',
        size:'responsive',
        shape:'pill',
        color: 'blue'
    },
    client:{
    sandbox:'AeAu_f7LeBwCaoXBzFGATtN3Xk4jM4XbDC-NBO9oFMCY56D6xyfncLnUWany1s3LX_UrccWxfd4Q9Rc1',
    production:'ATJea2Te2byxnGMJmRKa1MwFp-pzvT5pL57gtJELTTLHLclxKykS-kdBgPGBFDCg4OQ1R8HPadG0yFry'
    },
    payment: function(data,actions){
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { total: '<?php echo $total; ?>', currency: 'MXN'},
                        description: "Compra  por la cantidad de :$<?php echo number_format( $total,2); ?>",
                        custom:"<?php echo $user_id; ?>#<?php echo openssl_encrypt($productosConPrecioConcatenados,COD,KEY); ?>"
                    }
                ]
            }
        })
    },

    onAuthorize: function(data,actions){
        return actions.payment.execute().then (function(){
            console.log(data);
            window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
        });
    }
    }, '#paypal-button-container');
</script>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
 
<?php 
// Incluir el pie de página
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php";
?>



</body>
</html>


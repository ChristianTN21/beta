<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<style>
    h2 {
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

  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  width: 100%;
  
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
} else {
    // Mostrar la información de productos en el carrito
    echo "<h2>Productos en el carrito:</h2>";

    $total = 0; // Inicializar el total en 0
}
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

    //
    
?>

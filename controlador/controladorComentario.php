<?php
// Conectar a la base de datos
require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";

// Incluir el archivo con las funciones de comentarios
require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/funciones.php";

// Verificar si el formulario se envió


// Incluir la vista para mostrar los comentarios
require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/comentarios.php";
?>

<?php 

	$conexion=mysqli_connect('localhost','root','','proyecto');

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
</head>
<style>
    body{
		background: url(../img_pagina/fondo.jpg); 
	}
</style>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/funciones.php";
 $menu = new Admin_Model();
	$id= $_GET["id"];
	//echo $id;
	date_default_timezone_set('America/Mexico_City');
?>

<body >
    <div class="borde" style="background-color: #dba070;border-radius:20px;color:white;width:65%;margin-left: 17%;">
        <div class="row" >
            <div class="col-md-4" style="padding-bottom: 1%; padding-left:5%">
                <br><span><b>Usuario:</b>
					<?php
						$menu->mostrarNombre();
					?>
		        </span><br>
                <span><b>Fecha-Hora: </b>
					<?php
						echo date('d/m/Y - h:i: A');
						//echo date('Dd/Mm/Y');
					?>
				</span>	
            </div>
            <div class="col-md-6">
                <H3 style="padding-top: 1%;">ADMINISTRACION DE VENTAS</H3>
            </div>
        </div>
    </div>
        <br>
		<br>
    <div class="container" style="padding-top: 16px;">
        <div class="row" style="margin-left: 25%;" >
            <div class="col-md-6">
				<?php $id= $_GET["id"];?>
               <a href="../controlador/controladorbuscador.php?id=<?php echo $id ?>"><button class="btn btn-primary" type="submit">Productos</button></a> 
            </div>
            <div class="col-md-6">
                <a href="../controlador/buscadorClasificacionControlador.php?id=<?php echo $id ?>"><button type="submit" class="btn btn-primary">Claseificacion</button></a>
            </div>
        </div>

        <br>
		

	<table  class="table table-dark table-striped" style="width: 80%;margin-left: 9%;">
		<tr>
			<td>id</td>
			<td>Producto</td>
			<td>Clasificacion</td>
			<td>Descripcion</td>
			<td>Precio</td>
			<td>cantidad</td>
			<td>Imagen</td>	
			<td>Agregar</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>

		<?php 
		$sql="SELECT p.id_producto, p.descripcion AS descripcion_producto, c.descripcion AS descripcion_clasificacion, p.Nombre_producto, p.descripcion AS descripcion_producto, p.precio, p.cantidad, p.imagen
        FROM producto p
        INNER JOIN clasifficacion c ON p.id_clasificacion = c.id_clasificacion;";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['id_producto'] ?></td>
			<td><?php echo $mostrar['Nombre_producto'] ?></td>
			<td><?php echo $mostrar['descripcion_clasificacion'] ?></td>
			<td><?php echo $mostrar['descripcion_producto'] ?></td>
			<td><?php echo $mostrar['precio'] ?></td>
			<td><?php echo $mostrar['cantidad'] ?></td>
			<td><img style="width: 50px;" src="<?php echo $mostrar['imagen'] ?>">  </td>
			<td><a style="color: white;" href="../controlador/buscadorClasificacionControlador.php?id=<?php echo $id ?>"> <span class='bi bi-capslock' ></a> </td>
			<td><a style="color: white;" href="../controlador/buscadorClasificacionControlador.php?id=<?php echo $id ?>"> <span class='bi bi-pencil-square' ></a> </td>
			<td><a style="color: white;" href="../controlador/buscadorClasificacionControlador.php?id=<?php echo $id ?>"> <span class='bi bi-x-lg' ></a> </td>
		</tr>
	<?php 
	}
	 ?>
	</table>
    </div>

   
</body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php";
?>
</html>
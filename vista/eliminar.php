<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<style>
	body {
  background: url(../img_pagina/fondo.jpg); 
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  width: 100%;
	}
	#container{
		background-color: black;
		border-radius: 35px;
		box-shadow:3px 3px 3px 3px gray;
		width: 50%;
		margin-top: 5%;
	
		
	}
	#h1{
		text-align: center;
		color: white;
		font-size: xx-large;
		padding-top: 5%;
	}
	button{
		width: 120;
		height: 50px;
		margin-left: 2rem;
		
		
	}
	p{
		font-size: 2rem;
	}
</style>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
?>
<body >
<div class="container" id="container">
			<form method="post"  style="background-color: withe;box-shadow: 1px 1px 1px 1px 1px;">
					<div class="row">
						<div class="col-md-12">
							<h1 id="h1"><b>SEGURO QUE QUIERE ELIMINAR?</b></h1>
						</div>
					</div><br><br>
					<div class="row">
						<div class="col-md-6" style="padding-left: 35%;">
							<button  style="border-radius: 20px;" class="btn btn-primary" name="btn_aceptar" type="submit"><p>ELIMINAR</p></button>
							
						</div>
						<div class="col-md-6"  style="padding-right: 2rem;">
						<button  style="border-radius: 20px;" class="btn btn-danger" name="btn_cancelar" type="submit"><p>REGRESAR</p></button>
						</div>
					</div>
					
					<?php
					$id= $_GET['id'];
					if(isset($_POST["btn_aceptar"])){
					//echo "Boton si";
					$id_p= $_GET["id_producto"];
					$consulta = "DELETE FROM producto WHERE id_producto = '$id_p' ";
					//echo $consulta;
					require_once $_SERVER['DOCUMENT_ROOT']."/estadia/config/connect_db.php"; 
					require_once $_SERVER['DOCUMENT_ROOT']."/estadia/config/BD.php"; 
					echo "<script>alert('¡Se ha eliminado con exito :(!');</script>";
					echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/controladorbuscador.php?id=$id\">\r\n";
					$bd = new bd;
					$bd->abc($consulta);
				}elseif(isset($_POST["btn_cancelar"])){
					
					echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/controladorbuscador.php?id=$id\">\r\n";
				}
					?>
			</form><br><br><br>
		</div>
</body><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/pie.php";
?>
</html>

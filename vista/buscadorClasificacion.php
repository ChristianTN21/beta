<html>
<head>
<title>Buscador de equipos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
	<link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
	<script src="http://localhost/periodo1/framework//vue.js"></script>
	
<?php
	$query="SELECT id_producto FROM producto";
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";	
	$bd = new bd();
	
	$id= $_GET['id'];
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/validacionModelo.php";
	//$id_u= $_GET['id_producto'];
	
?>


<style>
	body {
  background: url(../img_pagina/fondo.jpg); 
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  width: 100%;
	}
		.container {

  margin: 0 auto;
  padding: 20px;
  background-color: #000;
 
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  color: fff;
  
}
form {
  margin-top: 20px;
  
}

label {
  display: block;
  margin-bottom: 5px;
  
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}
td{
	background-color: black;
	color: white;
	text-align: center;
	
}
th{
	color: black;
	text-align: center;
}

h1 {
  font-family: Arial, sans-serif;
  font-size: 36px;
  color: #333333;
  text-transform: uppercase;
}

	

#img1{
	width: 50% !important;
	height: 50% !important;
	margin: 10%;
    
}

h1 {
  font-family: Arial, sans-serif;
  font-size: 36px;
  color: #fff;
  text-transform: uppercase;
  
}

</style>
<!----------------------------  inicia formulario   ------------------------------------>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
?>

<body >

<form method="post">
<div class="row">
			<div class="col-md-12" style="text-align: center; color:black;">
				<p style="font-size: 3rem; padding: 1rem 0 1rem 0;"><h1>BUSCAR PRODUCTOS</h1></p><br>
			</div>
		</div>

<div id="ventanaModal" class="container" style="font-family: Century Gothic; width:65%; border-radius:25px">
		<div class="row">
			<div class="col-md-2" style="text-align: center;">
			
				<button style="background: green;color:white" class="btn btn-outline-success" class="form-control" name="btn_agregar" type="submit" style="border-radius: 50%; height: 38px; width: 40px;"><span class="bi bi-person-plus-fill">Agregar</span></button>
			</div>
			
			<div class="col-md-7">
				<input class="form-control"  placeholder="Buscador de productos" style="width: 100%" name="txt_parametro" type="text">
			</div>
			<div class="col-md-3" style="text-align: center;">
				<button style="background:burlywood; color:gray" class="btn btn-outline-success" class="form-control" name="btn_buscar" type="submit" style="border-radius: 50%; height: 38px; width: 40px;"><span  class='bi bi-search'>Buscar</span></button>
			</div>
		</div><br>
	</div>
	
<!----------------------------------------------------------------->
	<div class="container-fluid" style="font-family: Century Gothic; width: 70%;margin-top:3rem" >
		
		<?php
			if(isset($_POST["btn_volver"])){
				echo "<meta http-equiv=\"refresh\" content=\"0; url=/periodo1/index.php\">\r\n";
			}
		?>
		
		
		<?php
		
			require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";				
				  
			if(isset($_POST["btn_buscar"])){
				
				$i=0;
				$parametro = $_POST["txt_parametro"];  
				$_SESSION["txt_parametro"]=$parametro;
				
				$usuario = new buscador_Modelo();
				$data["clasifficacion"]=$usuario->get_clasificacion();
				
		echo "<table  style='border: solid 2px; border-radius: 15px; 
		box-shadow: 6px 6px 10px rgba(0,0,0,0.5);' width='70%' >";
		echo"<tr>
		<th bgcolor='#C2C6EF' align='center' height='25' width='5%' style='border: solid 1px;'>ID</th>
		<th  bgcolor='#C2C6EF' align='center' height='25' width='30%' style='border: solid 1px;'>Descripcion</th>
		<th bgcolor='#C2C6EF' align='center' height='25' width='5%' style='border: solid 1px;'>Eliminar</th>

	</tr>";
	
	
				
				foreach($data["clasifficacion"] as $dato){
					$id_c = $dato["id_clasificacion"];
					$i++;
					echo "
									<tr>
										<td style='border: solid 1px; border-radius: 5px;'>$i</t>
										<td style='border: solid 1px;'>".$dato["descripcion"]."</td>
										
										
										<td  style='border: solid 1px;'><a href='../vista/eliminarClasi.php?id=$id&id_clasificacion=$id_c'>Eliminar<a/></td>

									</tr>";
								// finpara crear tabla 
							}
						}
						elseif(isset($_POST["btn_agregar"])){
					echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/frm_cntroladorProducto.php?id=$id\">\r\n";
				}
		?>
	</div>
	 
</form>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="app.js"></script>
<footer>
   
  </footer>


  <div id="eliminarModal" class="modal" style="display: none;">
    <div class="modal-contenido">
        <p>¿Estás seguro de que deseas eliminar este registro?</p>
        <button id="confirmarEliminar">Eliminar</button>
        <button id="cancelarEliminar">Cancelar</button>
    </div>
</div>




</body>

<script>
    const eliminarProductoButtons = document.querySelectorAll("[id^='mostrarModal_']");
    const modal = document.getElementById("eliminarModal");
    const confirmarEliminarButton = document.getElementById("confirmarEliminar");
    const cancelarEliminarButton = document.getElementById("cancelarEliminar");
    let productoAEliminar;

    eliminarProductoButtons.forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("id").replace("mostrarModal_", "");
            productoAEliminar = id; // Asigna el ID del producto que se va a eliminar
            modal.style.display = "block";
        });
    });

    cancelarEliminarButton.addEventListener("click", function() {
        productoAEliminar = null; // Reinicia la variable
        modal.style.display = "none";
    });

    confirmarEliminarButton.addEventListener("click", function() {
        // Realiza una solicitud AJAX para eliminar el producto
        if (productoAEliminar) {
            // Realiza la consulta SQL para eliminar el registro
            $.ajax({
                type: "POST",
                url: "eliminar_producto.php", // Reemplaza con la URL adecuada para manejar la eliminación en tu servidor
                data: { id: productoAEliminar }, // Envía el ID del producto a eliminar
                success: function(response) {
                    alert("Producto eliminado con éxito.");
                    modal.style.display = "none";
                    // También puedes actualizar la tabla para reflejar el cambio sin recargar la página
                },
                error: function() {
                    alert("Error al eliminar el producto.");
                    modal.style.display = "none";
                }
            });
        }
    });
</script>

	<?php
	
	
	if(isset($_POST["btn_aceptar"])){
		$validacion = new validacion_Modelo();
		$validacion->validar_usuario();
	}
?>
<!--------------------------------  PIE DE PAGINA  -------------------------------->

</html>
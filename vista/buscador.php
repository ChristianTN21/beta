<html>
<head>
<title>Buscador</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/buscador_css.css">
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


<!----------------------------  inicia formulario   ------------------------------------>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
?>

<body >

<form method="post">
<div class="row">
			<div class="col-12" style="text-align: center; color:black;">
				<p  ><h1>BUSCAR PRODUCTOS</h1></p><br>
			</div>
		</div>

<div  class="container" >
		<div class="row">
			<div class="col-2" style="text-align: center;">
			
				<button id="btn" class="btn btn-outline-success" class="form-control" name="btn_agregar" type="submit" ><span id="textos" class="bi bi-person-plus-fill">Agregar</span></button>
			</div>
			
			<div class="col-7">
				<input class="form-control" id="buscador"  placeholder="Buscador de productos"  name="txt_parametro" type="text">
			</div>
			<div id="btn2" class="col-3" style="text-align: center;">
				<button  class="btn btn-outline-success" class="form-control" name="btn_buscar" type="submit" ><span id="textos" class='bi bi-search'>Buscar</span></button>
			</div>
		</div><br>
	</div>
	
<!----------------------------------------------------------------->
	
		
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
		$data["producto"]=$usuario->get_productos();
?>
<div class="table-responsive">
    <table id="tabla" class="table table-striped table-hover table-bordered text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($data["producto"] as $dato){
                $id_p = $dato["id_producto"];
                $i++;
                echo "<tr>
                    <td>$i</td>
                    <td id='nom'>".$dato["Nombre_producto"]."</td>
                    <td class='text-truncate' style='max-width: 150px;'>".$dato["descripcion"]."</td>
                    <td>".$dato["precio"]."</td>
                    <td>".$dato["cantidad"]."</td>
                    <td>
                        <img id='img_t' class='img-fluid'  src='".$dato["imagen"]."'>
                    </td>
                    <td>
                        <a id='btn_1' class='btn btn-warning btn-sm' href='../controlador/controladorModificacion.php?id=$id&id_producto=$id_p'>Editar</a>
                    </td>
                    <td>
                        <a id='btn_1' class='btn btn-danger btn-sm' href='../vista/eliminar.php?id=$id&id_producto=$id_p'>Eliminar</a>
                    </td>
                </tr>";
            }
        ?>
        </tbody>
    </table>
</div>


	<?php }
						elseif(isset($_POST["btn_agregar"])){
					echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/frm_cntroladorProducto.php?id=$id\">\r\n";
				}
		?>
	
	 
</form>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="app.js"></script>
<footer>
   
  </footer>







</body>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/pie.php";
?>


	<?php
	
	
	if(isset($_POST["btn_aceptar"])){
		$validacion = new validacion_Modelo();
		$validacion->validar_usuario();
	}
?>
<!--------------------------------  PIE DE PAGINA  -------------------------------->

</html>
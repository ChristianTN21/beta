<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="../framerwork/bootstrap-5.2.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="estilos.css" type="txt/css">
    
</head>
<?php
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";	
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/funciones.php";
   $Admin = new Admin_Model();
   //$id_u = $_POST["id"];  //Recupera variables de la URL
   $bd = new bd();  //Instancia de la clase
	


?>
<!----------------------------  inicia formulario   ------------------------------------>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
?>
<style>
    #foto{
        margin-left: 10%;
        width: 80%;
    }
    #reja1{
        width: 12%;
        margin-left: 2rem;
        
    }

    #lab{
        text-align: end;
        font-size:large;
        

    }
    #reja{
        width: 88%;
        margin-left: 2rem;
        
    }
    body {
  background: url(../img_pagina/fondo.jpg); 
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  width: 100%;
	}
</style>
<!------------------------  EDICION PHP OBTENCION DE DATOS  ---------------------------------------->
<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";	
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";
	
	$id = $_GET['id'];
	$id_p = $_GET['id_producto'];
	$bd = new bd();  //Instancia de la clase
	$consulta="SELECT id_producto, nombre_producto, id_clasificacion, descripcion, precio,cantidad, imagen FROM producto WHERE id_producto='$id_p';";
	
	$nombre= $bd->devuelveCampo($consulta,"nombre_producto");
	$clasificacion = $bd->devuelveCampo($consulta,"id_clasificacion");
	$descripcion = $bd->devuelveCampo($consulta,"descripcion");
	$precio = $bd->devuelveCampo($consulta,"precio");
	$cantidad = $bd->devuelveCampo($consulta,"cantidad");
	$img = $bd->devuelveCampo($consulta,"imagen");
	
	
?>
<body>
<div class="container" style="padding-left: 20%;text-align: center;">
    <br>
    <br>
            <form  method="post" id="form" style="box-shadow: 4px 4px 4px 4px gray; width: 70%; " enctype="multipart/form-data">
            <div class="row" style="color:white;">
                <div class="col-md-6" style="background-color:black;">
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 0.5rem;">
                            <h2 >EDICION DE REGISTRO</h2>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <input class="form-control" placeholder="ID" type="txt" id="reja1" name="id" value="<?php echo $id_p; ?>"  disabled>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <input type="text" placeholder="Nombre" class="form-control" name="txt-nombre" id="reja" value="<?php echo $nombre; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                        <select id="reja" name="cmb-clasificacion" style="height:2rem ;margin-right: 6rem;">
                            <option value="">Elige la clasificacion</option>
                            <?php
					$sql = "SELECT * FROM clasifficacion";
						$bd = new bd();
						$bd->combo($sql, "id_clasificacion", "descripcion", $id_estado);
					?> 
                        </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Descripcion" name="txt-descripcion" id="reja" value="<?php echo $descripcion; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <input type="text" placeholder="Precio" class="form-control" name="txt-precio" id="reja" value="<?php echo $precio; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <input type="text" placeholder="cantidad" class="form-control" name="txt-cantidad" id="reja" value="<?php echo $cantidad; ?>" >
                        </div>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn-small amber darker-1" id="div">
                            <span>ELIGE UNA IMAGEN</span>
                            <input class="form-control" type="file" class="form_control" name="foto" onchange="vista_preliminar(event)" id="foto" value="<?php echo $img; ?>" required>
                        </div>
                        
                    </div> 
                    <br>
                    
                    <div><img width="250px" height="250px" alt="" id="img-foto"></div>
                    <div class="input-field">
                        <button style="width: 80%;" class="btn btn-primary" type="submit"  name="btn-agregar" id="btn-agregar">AGREGAR</button>
                    </div>
                    <br>
                    <br>
                    </div>
                    <div class="col-md-6" style="background-color: black;margin-right: -1;">
                        <img src="../img_pagina/IMG_6334.jpg" width="104%" height="100%" >
                    </div>
                </div>
                <?php
                if(isset($_POST["btn-agregar"])){
                    $modificar = new Admin_Model();
                    $data["modificar"]=$modificar->mantenimiento();	
                    echo "<script>alert('¡Se ha guardado tu registro!');</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/controladorbuscador.php?id=$id\">\r\n";
                }elseif(isset($_POST["btn_cancelar"])){
                    echo "<a href='../controlador/controladorbuscador.php?id=$id'>";
                }
	            ?>
            </form>
            <br>    <br>
    
</div>


<script>
let vista_preliminar = ()=>{
        let leer_img = new FileReader ();
        let id_img = document.getElementById('img-foto');
        leer_img.onload = ()=>{
            if(leer_img.readyState ==2){
                id_img.src = leer_img.result;
            }
        }
    leer_img.readAsDataURL(event.target.files[0]);
}
</script>



</body>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/pie.php";
?>
</html>
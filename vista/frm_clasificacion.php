<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="../framerwork/bootstrap-5.2.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="../css/estilito.css" rel="stylesheet" type="text/css">
</head>
<?php
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";	
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";
   require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/clasModelo.php";
   $Admin = new clasificacion_Model();
   //$id_u = $_POST["id"];  //Recupera variables de la URL
   $bd = new bd();  //Instancia de la clase
	


?>
<style>
    body {
  background: url(../img_pagina/fondo.jpg); 
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  width: 100%;
	}
   
</style>
<body>
    <div class="container">
        <br>
        <form  method="post"  id="formulario" style="box-shadow: 4px 4px 4px 4px gray; width: 50%;text-align: center; " enctype="multipart/form-data">
                <div class="row" style="padding-top: 1rem;">
                    <div class="col-md-12">
                        <b><h2>AGREGAR CLASIFICACION</h2></b>
                    </div>
                </div>
                <br>
                <hr color="black">
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" placeholder="id" style="width: 7%;margin-bottom: 1rem !important;margin-left: 15%;" type="txt" disabled name="id_clas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control" placeholder="digite la clasificacion" id="input" type="txt" name="txt_clasificacion" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" name="btn-agregar" >Agregar</button>
                    </div>
                </div>
                <br>
                <?php
                if(isset($_POST["btn-agregar"])){
                    $modificar = new clasificacion_Model();
                    $data["modificar"]=$modificar->agregar_clasificacion();	
                    echo "<script>alert('¡Se ha guardado tu registro!');</script>";
                  //  echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/controladorbuscador.php?id=$id\">\r\n";
                }elseif(isset($_POST["btn_cancelar"])){
                    //echo "<a href='../controlador/controladorbuscador.php?id=$id'>";
                }
	            ?>
        </form>
    </div>
</body>
</html>
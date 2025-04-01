<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link href="../framerwork/bootstrap-5.2.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>

<style>
body{
    background-image:url(/IMG/kafetzin2.gif);
}
</style>
<body>
    <div class="container">
        <br>
    <?php 
     require_once('php/conexion.php');
     $query="SELECT * FROM imagen";
     $execute=mysqli_query($conexion,$query) or die(mysqli_error($conexion));

     while($fila=mysqli_fetch_array($execute)){
    
    ?>
        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo substr($fila['ruta'] ,3)?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">CAFE ENTERO 1LIBRA</h5>
    <p class="card-text">Bolsa de cafe entero de una libra de peso listo para moler y disfrutar su sabor fresco.</p>
    <a href="#" class="btn btn-primary">Comprar YA</a>
  </div>
</div>
    <?php
    }
    ?>
    </div>
</body>
</html>
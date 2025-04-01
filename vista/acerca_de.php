<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
</head>

<?php
// Iniciar sesión
session_start();



// Obtener el ID del usuario desde el parámetro GET
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Manejar el caso en el que no se proporciona el ID del usuario
    // Puede ser redirigir al usuario a una página de inicio de sesión o mostrar un mensaje de error.
    exit("Error: No se proporcionó el ID del usuario.");
}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado1.php"; ?>
<style>
  body {
  margin: 0;
}
</style>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../vista/inicio.php?id=<?php echo $user_id ?>">Tienda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
    <a class="nav-link" href="../vista/acerca_de.php?id=<?php echo $user_id ?>">
        Nosotros <span class="bi bi-person-circle"></span>
    </a></li>
        <li class="nav-item">
          <a class="nav-link" href="../controlador/controladorComentario.php?id=<?php echo $user_id ?>">Comentarios y sugerencias<span class="bi bi-telephone-outbound-fill"></span></a>
        </li>
        
        
      </ul>
    </div>
  </div>
</nav>

<!-------------------------- inicio de el contenido-------------------------------------->

<div class="container">
  <div class="row">
    <div class="col-md-8" >
      <video  width="100%" controls autoplay>
        <source  src="../img_pagina/Kafetzin coffee.mp4" type="video/mp4">
        Tu navegador no soporta el elemento de video.
      </video>
    </div>
    <div class="col-md-4">
   <h2 style="text-align: center;"><b>Quienes somos</b></h2><br><p style="text-align: justify;">Kafetzin Coffee es propiedad de Naim y Maggie, marido y mujer. Naim y Maggie están casados ​​desde 2016. Se conocieron, se enamoraron y vivieron los primeros dos años de matrimonio en Puebla, México. Naim emigró de México a Estados Unidos en 2018. Poco después de emigrar a Wisconsin, donde creció Maggie, se mudaron a Madison, donde Maggie comenzó a trabajar como maestra. ¡Madison se ha convertido en su hogar y están encantados de compartir un pedacito de Puebla con sus compañeros madisonianos!</p> 

    </div>

  </div>
  <div class="row">
    <div class="col-md-4">
      <img width="100%" src="../img_pagina/iglesia.jpg">
    </div>
    <div class="col-md-4" >
   <h2 style="text-align: center;padding-top: 50%;"><b>Quiénes somos como empresa</b></h2><br><br><p style="text-align: justify;">Somos una pequeña empresa madisoniana que colabora con una cooperativa indígena mexicana para apoyarnos mutuamente económica y culturalmente. Este negocio conecta mercados a nivel internacional para crear oportunidades significativas.</p> 

    </div>
    <div class="col-md-4">
      <img width="100%" src="../img_pagina/mujeres.jpg">
    </div>

  </div>
  <div class="row">
    <div class="col-md-4">
      <h2 style="text-align: center;padding-top: 40%;"><b>Misión</b></h2><br><p style="text-align: justify;">Misión
      Promoveremos formas autóctonas de producción de café, abriendo el mercado internacional a una pequeña cooperativa cafetera mexicana.</p> 
    </div>
    <div class="col-md-8">
    <img width="100%" src="../img_pagina/puebla.png">
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <img width="102.8%" src="../img_pagina/señores.jpeg">
    </div>
    <div class="col-md-4">
    <img style="margin-right: 15%;" width="100%" src="../img_pagina/monte.jpeg"><br><br>
    <h2 style="text-align: center;"><b>Vision</b></h2><p style="text-align: justify;">Nuestra visión es ofrecer un precio justo a los productores de café,
así como un precio accesible para los consumidores. Además,
estamos comprometidos a mantener una relación ética y socialmente responsable con nuestros clientes y productores.</p> 
    </div>
  </div>
</div>
<?php
// Incluir el pie de página
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php";
?>
</body>
</html>
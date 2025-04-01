<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ENCABEZADO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/framerwork/bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">	
  
</head>
<style>
#contenedor {
    background-color: #000;
    color: #FCFCFC;
    padding: 20px;
}

/* Imagen */
.img1 {
    height: 120px;
    width: 120px;
}

/* Contenedor del texto */
#titulo {
    font-size: 28px; /* Aumenta el tamaño de la fuente */
    font-weight: bold; 
    padding-left: 20px; /* Asegura separación con la imagen */
}

/* Ajustes para móviles */
@media (max-width: 800px) {
    .img1 {
        width: 50px;
        height: 60px;
    }

    #titulo {
        font-size: 14px;
        padding-left: 10px;
    }
}


</style>



	
	
<body>
<div class="container-fluid" id="contenedor">
    <div class="row">
        <div class="col-3 col-md-2 d-flex justify-content-center align-items-center">
            <img src="/Estadia/img_pagina/Logo-02.png" class="img1">
        </div>
        <div class="col-9 col-md-8 d-flex align-items-center" id="titulo">
            <p class="m-0">KAGETZIN COFFE</p>
        </div>
    </div>
</div>

	
</body>
</html>

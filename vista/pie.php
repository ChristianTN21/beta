<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
#pie_pagina {
    position: relative;
    bottom: 0;
    padding: 10px 0;
    text-align: center;
}

#pie_pagina img {
    max-width: 100%;
    height: auto;
}

#pie_pagina p {
    margin-bottom: 5px;
    font-size: 14px;
}

#pie_pagina a {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

#pie_pagina a img {
    height: 20px;
    width: 20px;
    margin-right: 5px;
}
#img_pie{
  width:80px ;
  height: 50px;
}
#siu {
  font-size: 25px !important;
  text-align: center;
}
#redes{
  font-size: 15px !important;
  text-align: center;
}
#insta{
  width: 30px !important;
  height: 30px !important;
}
#a{
  margin-bottom: 5px;
}
#insta_text{
  font-size: 20px !important;
}
.container-fluid {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}
html, body {
    height: 100vh; /* La página ocupa toda la altura de la pantalla */
    display: flex;
    flex-direction: column;
}

#pie_pagina {
    margin-top: auto; /* Empuja el pie de página hacia abajo */
}
  @media (max-width:800px){
    #img_pie{
    height: 30px;
    width: 50px;
    margin-right: 20px;
  }
  #siu {
    text-align: center;
    font-size: 12px !important; /* Asegura que no sea demasiado grande en móviles */
  }
  #redes{
  font-size: 7px !important;
  text-align: center;

}
#insta{
  width: 15px !important;
  height: 15px !important;
}
#a{
  margin-bottom: 1px;
}
  }
  #insta_text{
  font-size: 10px !important;
}
</style>


	
	
<body>
<div id="pie_pagina" class="container-fluid" style="background-color: #000; color: #FCFCFC; padding-top: 5px; padding-bottom: 5px; padding-left: 20px;">
    <div class="row">
        <div class="col-3 ">
            <img id="img_pie" src="http://localhost/Estadia/img_pagina/logo-02.png">
        </div>
        <div class="col-6 " >
        <p id="siu">TIENDA PRINCIPAL EN LÍNEA MÉXICO<br>Derechos Reservados ©</p>

        </div>
        <div class="col-3 ">
            <p id="redes" >Nuestras Redes Sociales</p>
            <a id="a" href="https://www.instagram.com/kafetzincoffee/?igshid=OGQ5ZDc2ODk2ZA%3D%3D&utm_source=qr&fbclid=IwAR2dYCXN-tTpS-YLVR_QJ50iNFXEEnz1pNWhe2YShK9wVaX9cOrBZFnwcHE">
              <img id="insta" src="/Estadia/img_pagina/instagram.png">
                <p id="insta_text" style="margin: 0;">Instagram</p>
</a>
<a href="https://www.facebook.com/kafetzincoffee?mibextid=LQQJ4d"
   style="display: flex; align-items: center; justify-content: center;">
    <img id="insta" src="/Estadia/img_pagina/facebook.png">
    <p id="insta_text" style="margin: 0;">Facebook</p>
</a>

            <hr style="color: #FFF; margin: 5px 0;">
        </div>
    </div>
</div>
</body>
</html>
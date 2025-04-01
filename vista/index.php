<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Validación</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
   <link href="http://localhost/Estadia/fuentes/fonts/fuentes.css" rel="stylesheet" type="text/css">	
	<link href="../css/css_validacion.css" type="text/css" rel="stylesheet">
	<script src="http://localhost/Estadia/framerwork//vue.js">
	
	</script>
</head>

<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/encabezado1.php";
?>
<body ><br><br>
	<div class="container"  id="app" >
		<form id="form" @submit="checkForm" method="post" >
		<div class="row">
		</div>
		<div >
			<div class="row" >
				<div class="col-2">
					<img id="img" src="../img_pagina/Logo-03.png">
				</div>
				<div class="col-10">
					<b><h2 id="titulo"> INICIAR SESION </h2></b>
				</div>
                    
			</div>
            <hr id="hr">
        <div id="login">
                    <div class="row">
						<div class="col-12" style="text-align: center;">
							<label  id="email" for="email">Email:</label><br>
							<input class="form-control"  name="txt_email" type="email" name="txt_email"  maxlength="30"  maxlength="30" pattern="[A-Z-a-z @_-.]" v-model="email"><br>
							<label id="email" for="password" >Password:</label><br>
							<input class="form-control"  name="txt_pass" type="pass" maxlength="4"  pattern="[0-9]{4,4}"v-model="pass"><br>
							<div class="row" >
						</div>
					</div>
					<hr id="hr">
			<div class="col-12" style="text-align: center;" ><br>
			<button id="btn" class="btn btn-outline-primary"  name="btn_aceptar" >Ingresar</button>
			</div>		
						</div><br>	
                    
        </div>
            
            
        </div>		
		
			<!--Inicio del mensaje vue-->
				<div class="row">
					<div class ="col-md-12" style="text-align: center;">
						<div v-if="errors.length ">
							<div style="border: #e5003 1px solid;background-color: #E51C20">
							<ul>
								<li  style="color: #FFF" v-for="error in errors">
									{{error}}
								</li>
							</ul>
							</div>
						</div>
					</div>
				</div>
				<!--fin del mensaje vue-->
		</form>
	</div>
	
</body><br><br>
<?php 
 require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/pie.php";
?>
<script>
	new Vue({
		el: "#app",
		data:{
			 errors:[],
			 email:null,
			 pass:null
		},
		
		methods:{
			checkForm:function(e){
				if(this.email && this.pass) return true;
				
				this.errors = [];
				if(!this.email) this.errors.push("No se ha ingresado el email");
				if(!this.pass) this.errors.push("No se ha ingresado el password");
				e.preventDefault();								
			}
		}
	})
</script>
	
	
<?php
	
	if(isset($_POST["btn_aceptar"])){
		$validacion = new validacion_Modelo();
		$validacion->validar_usuario();
	}
	
?>

</html>
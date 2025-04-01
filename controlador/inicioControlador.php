<?php
	//class facturaController{
			require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";
			require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php";
			require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/buscadorModelo.php";
			$usuario = new buscador_Modelo();
	$data["usuario"]=$usuario->get_productos();
			require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/inicio.php";
	//}

?>
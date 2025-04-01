<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php"; 
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/BD.php"; 
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/modelo/funciones.php";

			//$modificar = new equipos_Model();
			//$data["modificar"]=$modificar->mantenimiento();	
	require_once  $_SERVER['DOCUMENT_ROOT']."/Estadia/vista/editar.php";
?>
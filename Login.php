<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/controlador/controladorIndex.php";
	$control = new indexController();
	$control->index();
?>
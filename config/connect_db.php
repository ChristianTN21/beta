<?php
 class Conectado{
	public static function conexion(){
   $server='localhost';
    $user='root';
    $pass='';
    $bd='proyecto';

    $conexion=mysqli_connect($server,$user,$pass,$bd);
   
		
		if(mysqli_connect_errno()){
			//Si se produce un error
			echo "Conexión fallida: ".mysqli_connect_error();
		}else{
			//echo "Bienvenido";
		}
		return $conexion;
    
}
}
?>
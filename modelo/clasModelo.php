<?php
class clasificacion_Model{
    public function __construct(){ //se ejecuta la clase y es el primero
        $this->bd=Conectado::conexion();
    }
public function agregar_clasificacion(){
    $id_clas='id_clas';
    $clasificacion=$_POST['txt_clasificacion'];

    $consulta="INSERT INTO clasifficacion (id_clasificacion, descripcion ) VALUES ('$id_clas','$clasificacion' )";
     $consulta;
			
    $bd = new bd();   //Instancia de la clase bd
    $bd->abc($consulta); //Ejecuto la funcion abc
    ini_set('display_errors',1);
}
}
?>
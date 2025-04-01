<?php

class Admin_Model{

    private $bd;
    private $clientito;

    public function __construct(){ //se ejecuta la clase y es el primero
        $this->bd=Conectado::conexion();
    }
                        //session_start();
    
    public function agregar(){
       
    
    $id='id';
    $nombre=$_POST['txt-nombre'];
    $clasificacion=$_POST['cmb-clasificacion'];
    $descripcion=$_POST['txt-descripcion'];
    $precio=$_POST['txt-precio'];
    $moneda=$_POST['txt-moneda'];
    $cantidad=$_POST['txt-cantidad'];
    $peso_pza=$_POST['txt-peso_pza'];
    


    $nombre_imagen=$_FILES['foto']['name'];
    $temporal=$_FILES['foto']['tmp_name'];
    $carpeta='../IMG';
    $ruta=$carpeta.'/'.$nombre_imagen;
    move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);


    $consulta="INSERT INTO producto (id_producto, nombre_producto, id_clasificacion, descripcion, precio,moneda,cantidad,peso_pza, imagen) VALUES ('$id','$nombre', '$clasificacion','$descripcion' ,'$precio','$moneda','$cantidad','$peso_pza','$ruta' )";
    echo $consulta;
			
			$bd = new bd();   //Instancia de la clase bd
			$bd->abc($consulta); //Ejecuto la funcion abc
            ini_set('display_errors',1);
   	//echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/frm_cntroladorProducto.php\">\r\n";

}

public function comentar(){
       
    
    $id='id';
    $nombre=$_POST['txt-nombre'];
    $clasificacion=$_POST['cmb-clasificacion'];
    $descripcion=$_POST['txt-descripcion'];
    $precio=$_POST['txt-precio'];
    $moneda=$_POST['txt-moneda'];
    $cantidad=$_POST['txt-cantidad'];
    $peso_pza=$_POST['txt-peso_pza'];
    


    $nombre_imagen=$_FILES['foto']['name'];
    $temporal=$_FILES['foto']['tmp_name'];
    $carpeta='../IMG';
    $ruta=$carpeta.'/'.$nombre_imagen;
    move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);


    $consulta="INSERT INTO producto (id_producto, nombre_producto, id_clasificacion, descripcion, precio,moneda,cantidad,peso_pza, imagen) VALUES ('$id','$nombre', '$clasificacion','$descripcion' ,'$precio','$moneda','$cantidad','$peso_pza','$ruta' )";
    echo $consulta;
			
			$bd = new bd();   //Instancia de la clase bd
			$bd->abc($consulta); //Ejecuto la funcion abc
            ini_set('display_errors',1);
   	//echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/frm_cntroladorProducto.php\">\r\n";

}

public function mantenimiento(){
    $id_p = $_GET["id_producto"];
    $nombre = $_POST["txt-nombre"];
    $clasificacion = $_POST["cmb-clasificacion"];
    $descripcion = $_POST["txt-descripcion"];
    $precio = $_POST["txt-precio"];
    $cantidad = $_POST["txt-cantidad"];
    
    
    $nombre_imagen=$_FILES['foto']['name'];
    $temporal=$_FILES['foto']['tmp_name'];
    $carpeta='../IMG';
    $ruta=$carpeta.'/'.$nombre_imagen;
    move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);

    $consulta = "UPDATE producto SET nombre_producto = '$nombre',id_clasificacion = '$clasificacion', descripcion = '$descripcion', precio = '$precio', cantidad = ' $cantidad ', imagen = ' $ruta' WHERE id_producto = '$id_p'";
    
    $bd = new bd();   //Instancia de la clase bd
    $bd->abc($consulta); //Ejecuto la funcion abc
    //echo $consulta;

}

public function mostrarNombre(){
    $bd = new bd();
    $id=$_GET["id"];
    $sql = "SELECT CONCAT(Nombre, ' ', Apellido) AS nombre_completo FROM usuarios where id_usuario=$id ";
    //echo $sql;
   
    echo $bd->mostrarCampo($sql, "nombre_completo");	
}
public function mostrarCliente(){
    $bd = new bd();
    $id=$_GET["id"];
    $sql = "SELECT CONCAT(Nombre, ' ', ape_p, ' ',ape_m) AS nombre_completo FROM cliente where id_cliente=$id ";
    //echo $sql;
   
    echo $bd->mostrarCampo($sql, "nombre_completo");	
}
public function mostrar_nombre(){
    $bd = new bd();
    $sql = "SELECT * FROM producto";
    //echo $sql;
    echo $bd->mostrarCampo($sql, "Nombre_producto");	
}
public function mostrar_descripcion(){
    $bd = new bd();
    $sql = "SELECT * FROM producto";
    //echo $sql;
    echo $bd->mostrarCampo($sql, "descripcion");	
}
public function mostrar_precio(){
    $bd = new bd();
    $sql = "SELECT * FROM producto";
    //echo $sql;
    echo $bd->mostrarCampo($sql, "precio");	
}
public function mostrar_cantidad(){
    $bd = new bd();
    $sql = "SELECT * FROM producto";
    //echo $sql;
    echo $bd->mostrarCampo($sql, "cantidad");	
}


}


?>
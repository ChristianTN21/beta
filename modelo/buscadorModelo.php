
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";

class buscador_Modelo
{
    private $bd;
    private $clientito;

    public function __construct()
    {
        $this->bd = Conectado::conexion();
        $this->clientito = array(); 
    }

    public function get_productos()
    {
        if (isset($_SESSION["txt_parametro"])) {
            $parametro = "%" . $_SESSION["txt_parametro"] . "%";

            $sql = "SELECT id_producto, Nombre_producto, descripcion, precio, cantidad, imagen FROM producto WHERE Nombre_producto LIKE ?";

            // Preparar la consulta
            if ($stmt = $this->bd->prepare($sql)) {
                // Vincular el parámetro
                $stmt->bind_param("s", $parametro);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $this->clientito[] = $row; 
                        }
                    } else {
                        echo "<script>alert('No se encontraron registros');</script>";
                    }
                } else {
                    echo "<script>alert('Error al ejecutar la consulta');</script>";
                }

                // Cerrar la sentencia preparada
                $stmt->close();
            } else {
                echo "<script>alert('Error al preparar la consulta');</script>";
            }
        }
        return $this->clientito;
    }

  /**  buscador clasificacion */

    public function get_clasificacion()
    {
        if (isset($_SESSION["txt_parametro"])) {
            $parametro = "%" . $_SESSION["txt_parametro"] . "%";

            $sql = "SELECT id_clasificacion, descripcion FROM clasifficacion WHERE descripcion LIKE ?";

            // Preparar la consulta
            if ($stmt = $this->bd->prepare($sql)) {
                // Vincular el parámetro
                $stmt->bind_param("s", $parametro);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $this->clientito[] = $row; // Agrega cada fila al array clientito
                        }
                    } else {
                        echo "<script>alert('No se encontraron registros');</script>";
                    }
                } else {
                    echo "<script>alert('Error al ejecutar la consulta');</script>";
                }

                // Cerrar la sentencia preparada
                $stmt->close();
            } else {
                echo "<script>alert('Error al preparar la consulta');</script>";
            }
        }
        return $this->clientito;
    }

    public function mantenimiento(){
        $id_u = $_GET["id_u"];
        $descripcion = $_POST["txt_descripcion"];
        $marca = $_POST["cmb_marca"];
        $precio = $_POST["txt_precio"];
        $procedencia = $_POST["cmb_procedencia"];
        

        $consulta = "UPDATE equipos SET descripcion = '$descripcion',id_marca = '$marca', precio = '$precio', id_procedencia = '$procedencia' WHERE equipos.id_equipo = '$id_u'";
        
        $bd = new bd();   //Instancia de la clase bd
        $bd->abc($consulta); //Ejecuto la funcion abc
        //echo $consulta;

    }
}
?>

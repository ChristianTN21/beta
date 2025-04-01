<?php
// Verifica si se ha recibido una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha recibo un ID válido para eliminar
    if (isset($_POST["id"]) && is_numeric($_POST["id"])) {
        $id_a_eliminar = $_POST["id"];
        
        // Incluye el archivo de conexión a la base de datos
        require_once("/xampp/htdocs/Estadia/config/connect_db.php"); // Reemplaza con la ubicación de tu archivo de conexión
        
        // Sentencia SQL para eliminar el registro (reemplaza con tu propia consulta)
        $sql = "DELETE FROM tu_tabla WHERE id = $id_a_eliminar"; // Reemplaza "tu_tabla" con el nombre de tu tabla
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado con éxito"; // Puedes devolver una respuesta al cliente
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    } else {
        echo "ID no válido"; // Maneja el caso en el que no se proporciona un ID válido
    }
}
?>

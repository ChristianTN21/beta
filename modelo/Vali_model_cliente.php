<?php
class validacion_Modelo {
    private $bd;

    public function __construct() {
        $this->bd = Conectado::conexion(); // Conexión a la BD usando PDO
    }

    public function validar_cliente() {
        try {
            $email = $_POST["txt_email"];
            $pass = $_POST["txt_pass"];

            // Consulta segura con Prepared Statements
            $sql = "SELECT id_cliente FROM cliente WHERE email = :email AND pass = :pass";
            $stmt = $this->bd->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();

            // Verificar si existe el usuario
            if ($stmt->rowCount() > 0) {
                $id = $stmt->fetch(PDO::FETCH_ASSOC)['id_cliente'];
                header("Location: ../vista/inicio.php?id=$id");
                exit();
            } else {
                echo "<script>alert('Email o contraseña incorrectos');</script>";
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>
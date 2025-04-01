<?php
class ValidacionModelo {
    private $bd;

    public function __construct() { // Se ejecuta la clase y es el primero
        $this->bd = Conectado::conexion();            
    }

    public function validar_usuario() {
        try {
            $bd = new BD();
            
            // Sanitizar entradas
            $email = filter_input(INPUT_POST, 'txt_email', FILTER_SANITIZE_EMAIL);
            $pass = $_POST["txt_pass"]; // La contraseña no se sanitiza porque se compara encriptada

            // Consulta segura con prepared statements
            $sql = "SELECT id_usuario, pass FROM usuarios WHERE email = :email";
            $stmt = $bd->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($pass, $usuario['pass'])) { 
                $id = $usuario['id_usuario'];
                echo "<meta http-equiv=\"refresh\" content=\"0; url=../controlador/controladorbuscador.php?id=$id\">\r\n";
            } else {
                echo "<script>alert('Email o contraseña incorrectos');</script>";
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}
?>
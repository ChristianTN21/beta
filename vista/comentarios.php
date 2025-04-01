<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="../css/comentarios.css" type="text/css" rel="stylesheet">
  <link href="../fuentes/icons-1.8.3/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
  <title>Comentarios y Puntuación</title>
  <style>
    .stars {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
    }
    .stars input {
      display: none;
    }
    .stars label {
      font-size: 30px;
      color: gray;
      cursor: pointer;
    }
    .stars input:checked ~ label,
    .stars label:hover,
    .stars label:hover ~ label {
      color: gold;
    }
  </style>
</head>
<body>
  <?php 
    // Iniciar sesión
    session_start();
    
    // Conectar con la base de datos
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/encabezado1.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/BD.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";

    date_default_timezone_set('America/Mexico_City');

    // Obtener el ID del usuario desde GET
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
    } else {
        exit("Error: No se proporcionó el ID del usuario.");
    }

    // PROCESAR FORMULARIO
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = isset($_POST['email']) ? trim($_POST['email']) : "";
        $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : "";
        $puntuacion = isset($_POST['rating']) && $_POST['rating'] !== "" ? (int)$_POST['rating'] : null;

        // Validaciones
        if (empty($email) || empty($comentario) || is_null($puntuacion)) {
            echo "<script>alert('Todos los campos son obligatorios, incluyendo la calificación.');</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Correo no válido.');</script>";
        } elseif ($puntuacion < 1 || $puntuacion > 5) {
            echo "<script>alert('Puntuación inválida.');</script>";
        } else {
            // Conectar a la BD
            $conn = Conectado::conexion();
if ($conn) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar con la base de datos.";
}

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Insertar datos
            $stmt = $conn->prepare("INSERT INTO comentario (correo_usuario, comentario, estrellas, fecha) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("ssi", $email, $comentario, $puntuacion);

            if ($stmt->execute()) {
                echo "<script>alert('Comentario guardado correctamente.');</script>";
                echo "<meta http-equiv='refresh' content='0; url=../controlador/controladorComentario.php?id=$user_id'>";
            } else {
                echo "<script>alert('Error al guardar el comentario.');</script>";
            }

            $stmt->close();
            $conn->close();
        }
    }
  ?>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../vista/inicio.php?id=<?php echo $user_id ?>">Tienda</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../vista/acerca_de.php?id=<?php echo $user_id ?>">Nosotros <span class="bi bi-person-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../controlador/controladorComentario.php?id=<?php echo $user_id ?>">Comentarios y sugerencias <span class="bi bi-telephone-outbound-fill"></span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <br><br>
    <form method="post" action="">
      <div class="formulario">
        <h3 class="titi" id="ti">COMENTARIOS Y SUGERENCIAS</h3>
        <hr id="linea" style="color:white;">
        <br>
        <input type="email" name="email" id="email" class="form-control" placeholder="SoyUncorreo@gmail.com" required>
        <br>
        <textarea name="comentario" id="comentario" class="form-control" placeholder="Ingrese su comentario o sugerencia" required></textarea>
        <br>
        <p style="color: white;" class="titi2" id="ti2">DEJA UNA CALIFICACIÓN</p>
        <div class="stars">
          <input type="radio" name="rating" id="star5" value="5" required><label for="star5">★</label>
          <input type="radio" name="rating" id="star4" value="4"><label for="star4">★</label>
          <input type="radio" name="rating" id="star3" value="3"><label for="star3">★</label>
          <input type="radio" name="rating" id="star2" value="2"><label for="star2">★</label>
          <input type="radio" name="rating" id="star1" value="1"><label for="star1">★</label>
        </div>
        <br>
        <button name="btn-agregar" type="submit" id="btn1" class="btn btn-outline-primary">Enviar Comentario</button>
      </div>
    </form>
    <br>
  </div>

  <hr style="padding-bottom: 10px;">
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/vista/pie.php"; ?>
</body>
</html>

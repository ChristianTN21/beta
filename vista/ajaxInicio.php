<?php
require_once $_SERVER['DOCUMENT_ROOT']."/Estadia/config/connect_db.php";

$conn = Conectado::conexion(); 

if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener el número de comentarios ya mostrados
$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;

// Obtener los siguientes 2 comentarios
$query = "SELECT correo_usuario, comentario, estrellas, fecha FROM comentario ORDER BY fecha DESC LIMIT 2 OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $offset);
$stmt->execute();
$result = $stmt->get_result();

while ($comentario = $result->fetch_assoc()): ?>
    <div class="card mb-3 shadow-sm comentario">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">
                <?php 
                $correo = explode("@", $comentario['correo_usuario']);
                $correo_oculto = substr($correo[0], 0, 2) . str_repeat('*', max(0, strlen($correo[0]) - 2)) . '@' . $correo[1];
                echo htmlspecialchars($correo_oculto);
                ?>
            </h6>

            <div class="mb-2">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="bi <?php echo ($i <= $comentario['estrellas']) ? 'bi-star-fill text-warning' : 'bi-star'; ?>"></span>
                <?php endfor; ?>
            </div>

            <p class="card-text"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
            <small class="text-muted">Publicado el <?php echo date("d M Y", strtotime($comentario['fecha'])); ?></small>
        </div>
    </div>
<?php endwhile;

$conn->close();
?>

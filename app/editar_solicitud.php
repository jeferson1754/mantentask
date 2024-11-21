<?php
// Suponiendo que ya has establecido la conexión con la base de datos
require_once '../php/bd.php';

// Obtener el ID de la solicitud a editar desde la URL
if (isset($_GET['id'])) {
  $id_solicitud = $_GET['id'];

  // Recuperar los datos de la solicitud
  $sql = "SELECT * FROM solicitud WHERE ID = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_solicitud);
  $stmt->execute();
  $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

  // Verificar si se ha encontrado la solicitud
  if (!$solicitud) {
    echo "Solicitud no encontrada.";
    exit;
  }
} else {
  echo "No se ha proporcionado un ID válido.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Solicitud</title>
</head>

<body>
  <h1>Editar Solicitud</h1>
  <form action="../php/actualizar_solicitud.php" method="POST">
    <!-- Campo oculto con el ID de la solicitud para identificarla al momento de la actualización -->
    <input type="hidden" name="id_solicitud" value="<?php echo $solicitud['ID']; ?>">

    <label for="maquina">Máquina:</label>
    <select id="maquina" name="maquina" required>
      <option value="1" <?php echo ($solicitud['ID_Maquina'] == 1) ? 'selected' : ''; ?>>esmeril</option>
      <option value="2" <?php echo ($solicitud['ID_Maquina'] == 2) ? 'selected' : ''; ?>>compresor</option>
      <option value="3" <?php echo ($solicitud['ID_Maquina'] == 3) ? 'selected' : ''; ?>>taladro</option>
    </select><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($solicitud['Descripcion']); ?></textarea><br><br>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
      <option value="1" <?php echo ($solicitud['ID_Estado'] == 1) ? 'selected' : ''; ?>>urgente</option>
      <option value="2" <?php echo ($solicitud['ID_Estado'] == 2) ? 'selected' : ''; ?>>normal</option>
      <option value="3" <?php echo ($solicitud['ID_Estado'] == 3) ? 'selected' : ''; ?>>tranquilo</option>
    </select><br><br>

    <button type="submit" id="modificar-btn">Modificar</button>
    <button type="button" id="eliminar-btn">Eliminar</button>
  </form>

  <script src="/validaciones/inputText.js"></script>
  <script src="/validaciones/textArea.js"></script>
</body>

</html>
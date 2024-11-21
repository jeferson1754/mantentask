<?php
include('../php/bd.php');

// Consulta SQL
$sql = "SELECT informe.ID, usuario.Nombre, informe.ID_Solicitud, informe.Descripcion, informe.Fecha_Informe FROM `informe` INNER JOIN usuario ON usuario.ID = informe.ID_Usuario;";
$resultado = $conn2->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Informes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <h1>Informes Creados</h1>

    <a class="btn btn-primary btn-sm" href="informe.html">Registrar</a>

  <br><br>
  <div class="card p-4 shadow-sm">
    <div class="table-responsive">
      <?php if ($resultado && $resultado->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
          <thead class="table-primary text-center">
            <tr>
              <?php
              // Mostrar los encabezados de la tabla
              $columnas = $resultado->fetch_fields();
              foreach ($columnas as $columna) {
                echo "<th>" . htmlspecialchars($columna->name) . "</th>";
              }
              ?>
              <th>Acciones</th> <!-- Columna para los botones -->
            </tr>
          </thead>
          <tbody>
            <?php
            // Mostrar los datos
            while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              foreach ($fila as $valor) {
                echo "<td>" . htmlspecialchars($valor) . "</td>";
              }
              // Botones para Editar y Eliminar
              $id_informe = $fila['ID']; // ID del informe
              echo "<td>
                  <a class='btn btn-warning btn-sm' href='editar_informe.php?id=$id_informe'>Editar</a>
                  <a class='btn btn-danger btn-sm' href='../php/eliminar_informe.php?id=$id_informe' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este informe?\")'>Eliminar</a>
                </td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No hay datos disponibles en la tabla.</p>
      <?php endif; ?>

</body>

</html>
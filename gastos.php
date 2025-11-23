<?php
require_once "database.php";

// ELIMINAR
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM gastos WHERE id=$id");
    header("Location: gastos.php");
    exit();
}

// EDITAR (obtener datos)
$editando = false;
if (isset($_GET['editar'])) {
    $editando = true;
    $idEditar = $_GET['editar'];
    $result = $conexion->query("SELECT * FROM gastos WHERE id=$idEditar");
    $dataEditar = $result->fetch_assoc();
}

// ACTUALIZAR
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $tipo_gasto  = $_POST['tipo_gasto'];
    $monto       = $_POST['monto'];
    $fecha       = $_POST['fecha'];

    $conexion->query("
        UPDATE gastos SET 
        descripcion='$descripcion',
        tipo_gasto='$tipo_gasto',
        monto='$monto',
        fecha='$fecha'
        WHERE id=$id
    ");

    header("Location: gastos.php");
    exit();
}

$gastos = $conexion->query("SELECT * FROM gastos ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Gastos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container wide">
    <h1>Gastos Registrados</h1>

    <a href="index.php" class="btn-secondary">← Volver</a>

    <!-- FORMULARIO DE EDICIÓN -->
    <?php if ($editando): ?>
    <div class="edit-box">
        <h2>Editar Gasto</h2>

        <form action="gastos.php" method="POST">
            <input type="hidden" name="id" value="<?= $dataEditar['id'] ?>">

            <label>Descripción:</label>
            <input type="text" name="descripcion" value="<?= $dataEditar['descripcion'] ?>" required>

            <label>Tipo de gasto:</label>
            <input type="text" name="tipo_gasto" value="<?= $dataEditar['tipo_gasto'] ?>" required>

            <label>Monto:</label>
            <input type="number" name="monto" step="0.01" value="<?= $dataEditar['monto'] ?>" required>

            <label>Fecha:</label>
            <input type="date" name="fecha" value="<?= $dataEditar['fecha'] ?>" required>

            <button class="btn-primary" type="submit" name="actualizar">Actualizar</button>
        </form>
    </div>
    <?php endif; ?>

    <!-- TABLA -->
    <table class="tabla">
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        <?php while ($fila = $gastos->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['descripcion'] ?></td>
            <td><?= $fila['tipo_gasto'] ?></td>
            <td>Q.<?= $fila['monto'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td>
                <a class="btn-edit" href="gastos.php?editar=<?= $fila['id'] ?>">✏️ Editar</a>
                <a class="btn-delete" onclick="return confirm('¿Eliminar registro?')" href="gastos.php?eliminar=<?= $fila['id'] ?>">🗑️ Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
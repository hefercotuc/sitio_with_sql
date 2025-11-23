<?php
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Gastos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <h1>Registrar Gasto</h1>

    <form id="formGasto" action="index.php" method="POST">
        <label>Descripción:</label>
        <input type="text" name="descripcion" required>

        <label>Tipo de gasto:</label>
        <input type="text" name="tipo_gasto" required>

        <label>Monto:</label>
        <input type="number" step="0.01" name="monto" required>

        <label>Fecha:</label>
        <input type="date" name="fecha" required>

        <button class="btn-primary" type="submit" name="guardar">Guardar</button>

        <a href="gastos.php" class="btn-secondary">Ver Gastos</a>
    </form>

    <div id="mensaje">✔ ¡Gasto registrado con éxito!</div>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>
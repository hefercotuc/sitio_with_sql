<?php
$conexion = new mysqli("localhost", "root", "", "control_gastos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['guardar'])) {
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo_gasto'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];

    $sql = $conexion->prepare(
        "INSERT INTO gastos (descripcion, tipo_gasto, monto, fecha)
         VALUES (?, ?, ?, ?)"
    );
    $sql->bind_param("ssds", $descripcion, $tipo, $monto, $fecha);

    if ($sql->execute()) {
        echo "<script>localStorage.setItem('success', '1');</script>";
        echo "<script>window.location='index.php';</script>";
        exit;
    }
}
?>
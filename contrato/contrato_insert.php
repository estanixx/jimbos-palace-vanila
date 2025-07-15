<?php
require('../config/conexion.php');

$no_contrato = $_POST['no_contrato'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$salary = $_POST['salary'];

$query = "INSERT INTO contrato(no_contrato, fecha_inicio, fecha_fin, salary) VALUES ($1, $2, $3, $4)";
$result = pg_prepare($conn, "insert_contrato", $query);
$result = pg_execute($conn, "insert_contrato", array($no_contrato, $fecha_inicio, $fecha_fin, $salary));

$message = "Contrato Creado Exitosamente!";
if ($result) {
    header("Location: contrato.php?success=" . urlencode($message));
} else {
    echo "Error al crear el contrato: " . pg_last_error($conn);
}
pg_close($conn);
?>
<?php
require('../config/conexion.php');

// Collect common data
$codigo = $_POST['codigo'];
$nombre_completo = $_POST['nombre_completo'];
$codigo_mentor = !empty($_POST['codigo_mentor']) ? $_POST['codigo_mentor'] : null;
$tipo = $_POST['tipo'];
$no_contrato = $_POST['no_contrato'];

// Collect conditional data
$area_asignada = ($tipo === 'JEFE DE SALA' && !empty($_POST['area_asignada'])) ? $_POST['area_asignada'] : null;
$codigo_certificacion = ($tipo === 'JEFE DE SALA' && !empty($_POST['codigo_certificacion'])) ? $_POST['codigo_certificacion'] : null;
$años_experiencia = ($tipo === 'CRUPIER' && !empty($_POST['años_experiencia'])) ? $_POST['años_experiencia'] : null;
$juego_certificado = ($tipo === 'CRUPIER' && !empty($_POST['juego_certificado'])) ? $_POST['juego_certificado'] : null;

$query = "INSERT INTO empleado(codigo, nombre_completo, codigo_mentor, tipo, area_asignada, codigo_certificacion, años_experiencia, juego_certificado, no_contrato) 
          VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";

$params = array(
    $codigo,
    $nombre_completo,
    $codigo_mentor,
    $tipo,
    $area_asignada,
    $codigo_certificacion,
    $años_experiencia,
    $juego_certificado,
    $no_contrato
);

$result = pg_prepare($conn, "insert_empleado", $query);
$result = pg_execute($conn, "insert_empleado", $params);

$message = "Empleado Registrado Exitosamente!";
if ($result) {
    header("Location: empleado.php?success=" . urlencode($message));
} else {
    // Provide a more descriptive error message
    $error = pg_last_error($conn);
    echo "Error al registrar el empleado. Por favor, revise los datos. Detalle del error: " . $error;
}
pg_close($conn);
?>
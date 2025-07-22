<?php
require('../config/conexion.php');

// Collect data
$codigo = $_POST['codigo'];
$nombre_cliente = $_POST['nombre_cliente'];
$codigo_encargado = $_POST['codigo_encargado'];
$codigo_revisor = empty($_POST['codigo_revisor']) ? null : $_POST['codigo_revisor']; 
$monto_dinero = $_POST['monto_dinero'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$tipo = $_POST['tipo'];

// Collect conditional data
$cantidad_fichas = (in_array($tipo, ['CANJE FICHAS', 'COMPRA FICHAS']) && !empty($_POST['cantidad_fichas'])) ? $_POST['cantidad_fichas'] : null;
$nombre_torneo = ($tipo === 'INSCRIPCION' && !empty($_POST['nombre_torneo'])) ? $_POST['nombre_torneo'] : null;

$query = "INSERT INTO transaccion(codigo, nombre_cliente, codigo_encargado, codigo_revisor, monto_dinero, fecha, hora, tipo, cantidad_fichas, nombre_torneo) 
          VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";

$params = array($codigo, $nombre_cliente, $codigo_encargado, $codigo_revisor, $monto_dinero, $fecha, $hora, $tipo, $cantidad_fichas, $nombre_torneo);

$result = pg_prepare($conn, "insert_transaccion", $query);
$result = pg_execute($conn, "insert_transaccion", $params);

$message = "Transacción Registrada Correctamente!";
if ($result) {
    header("Location: transaccion.php?success=" . urlencode($message));
} else {
    echo "Error al registrar la transacción: " . pg_last_error($conn);
}
pg_close($conn);
?>
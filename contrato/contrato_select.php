<?php
// We're using PostgreSQL, so the functions are pg_*
require('../config/conexion.php');
$query = "SELECT no_contrato, fecha_inicio, fecha_fin, salary FROM contrato ORDER BY no_contrato ASC";
$resultContratos = pg_query($conn, $query);
// No need to close the connection here if it's included in another file that will close it.
?>
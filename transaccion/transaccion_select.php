<?php
require('../config/conexion.php');
$query = "
    SELECT t.codigo, t.nombre_cliente, e.nombre_completo as nombre_ejecutor, r.nombre_completo as nombre_revisor, t.monto_dinero, t.fecha, t.hora, t.tipo, t.cantidad_fichas, t.nombre_torneo
    FROM transaccion t
    INNER JOIN empleado e ON t.codigo_encargado = e.codigo
    LEFT JOIN empleado r ON t.codigo_revisor = r.codigo
    ORDER BY t.fecha DESC, t.hora DESC
";
$resultTransacciones = pg_query($conn, $query);
?>
<?php
require('../config/conexion.php');
$query = "
    SELECT t.codigo, t.nombre_cliente, e.nombre_completo as nombre_empleado, t.monto_dinero, t.fecha, t.hora, t.tipo, t.cantidad_fichas, t.nombre_torneo
    FROM transaccion t
    JOIN empleado e ON t.codigo_empleado = e.codigo
    ORDER BY t.fecha DESC, t.hora DESC
";
$resultTransacciones = pg_query($conn, $query);
?>
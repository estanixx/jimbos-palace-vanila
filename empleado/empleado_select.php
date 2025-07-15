<?php
// This script will be required in empleado.php to populate the main table
require('../config/conexion.php');
$query = "
    SELECT e.codigo, e.nombre_completo, m.nombre_completo as nombre_mentor, e.tipo, 
           e.area_asignada, e.codigo_certificacion, e.años_experiencia, e.juego_certificado, e.no_contrato
    FROM empleado e
    LEFT JOIN empleado m ON e.codigo_mentor = m.codigo
    ORDER BY e.codigo ASC
";
$resultEmpleados = pg_query($conn, $query);
// The connection will be closed in the main file
?>
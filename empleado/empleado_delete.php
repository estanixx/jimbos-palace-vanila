<?php
require('../config/conexion.php');
$codigo_eliminar = $_POST['codigo_eliminar'];

$query = "DELETE FROM empleado WHERE codigo = $1";
$result = pg_prepare($conn, "delete_empleado", $query);
$result = pg_execute($conn, "delete_empleado", array($codigo_eliminar));

$message = "Empleado Eliminado!";
if ($result) {
    header("Location: empleado.php?success=" . urlencode($message));
} else {
    echo "Error al eliminar el empleado: " . pg_last_error($conn);
}
pg_close($conn);
?>
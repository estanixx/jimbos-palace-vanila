<?php
require('../config/conexion.php');
$codigo_eliminar = $_POST['codigo_eliminar'];

$query = "DELETE FROM transaccion WHERE codigo = $1";
$result = pg_prepare($conn, "delete_transaccion", $query);
$result = pg_execute($conn, "delete_transaccion", array($codigo_eliminar));

$message = "Transacción Eliminada!";
if ($result) {
    header("Location: transaccion.php?success=" . urlencode($message));
} else {
    echo "Error al eliminar la transacción: " . pg_last_error($conn);
}
pg_close($conn);
?>
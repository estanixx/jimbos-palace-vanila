<?php
require('../config/conexion.php');
$no_contrato_eliminar = $_POST['no_contrato_eliminar'];
$query = "DELETE FROM contrato WHERE no_contrato = $1";
$result = pg_prepare($conn, "delete_contrato", $query);
$result = pg_execute($conn, "delete_contrato", array($no_contrato_eliminar));

$message = "Contrato Eliminado!";
if ($result) {
    header("Location: contrato.php?success=" . urlencode($message));
} else {
    echo "Error al eliminar el contrato: " . pg_last_error($conn);
}
pg_close($conn);
?>
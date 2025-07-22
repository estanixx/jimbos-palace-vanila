<?php 
include "../includes/header.php"; 
require('../config/conexion.php');

// --- YOU WILL PROVIDE THE SQL QUERY HERE ---
// Example: $query = "SELECT codigo, tipo, monto_dinero, fecha, hora FROM transaccion WHERE monto_dinero > 5000";
$query = "SELECT tran.codigo, tran.monto_dinero, tran.tipo as tipotran,  tran.codigo_revisor, tran.fecha, tran.hora, tran.nombre_cliente, tran.codigo_encargado, emp.nombre_completo, emp.tipo FROM transaccion as tran
LEFT JOIN empleado AS emp ON emp.codigo = tran.codigo_encargado
WHERE tran.codigo_revisor IS NULL
ORDER BY monto_dinero DESC
LIMIT 3;"; // <<< DEJE ESTA LÍNEA VACÍA O REEMPLÁCELA CON SU CONSULTA

$result = null;
if (!empty($query)) {
    $result = pg_query($conn, $query);
}
?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-4">Resultados de la Consulta 1</h1>
<p class="text-center text-gray-400 mb-8">Mostrando los resultados de la consulta personalizada.</p>

<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8 max-w-4xl mx-auto">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Código</th>
                <th class="py-3 px-4 text-left">Movimiento</th>
                <th class="py-3 px-4 text-left">Monto</th>
                <th class="py-3 px-4 text-left">Fecha y Hora</th>
                <th class="py-3 px-4 text-left">Encargado</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php if ($result && pg_num_rows($result) > 0): ?>
                <?php while ($fila = pg_fetch_assoc($result)): ?>
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['codigo']); ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['tipotran']); ?> a <?= htmlspecialchars($fila['nombre_cliente']); ?></td>
                    <td class="py-3 px-4">$<?= number_format($fila['monto_dinero'], 2, ',', '.'); ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['fecha']); ?>, <?= htmlspecialchars($fila['hora']); ?></td>
                    <td class="py-3 px-4"><?= $fila['nombre_completo']; ?> <span class="px-2 py-1 rounded <?= $fila['tipo'] == 'CRUPIER' ? 'bg-blue-600' : 'bg-purple-600' ?>"><?= $fila['tipo']; ?></span></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr class="border-b border-gray-700">
                    <td colspan="5" class="text-center py-4">
                        <?php if (empty($query)): ?>
                            La consulta está vacía. Por favor, edite el archivo `consulta1.php` para agregar una consulta SQL.
                        <?php else: ?>
                            No se encontraron resultados para esta consulta.
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
if ($conn) { pg_close($conn); }
include "../includes/footer.php"; 
?>

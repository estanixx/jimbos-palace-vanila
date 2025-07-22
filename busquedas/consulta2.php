<?php 
include "../includes/header.php"; 
require('../config/conexion.php');

// --- YOU WILL PROVIDE THE SQL QUERY HERE ---
// Example: $query = "SELECT codigo, nombre_completo, codigo_mentor, tipo FROM empleado WHERE tipo = 'JEFE DE SALA'";
$query = "SELECT emp.codigo, emp.nombre_completo, emp.tipo, emp.codigo_mentor FROM empleado as emp
INNER JOIN contrato as con ON emp.no_contrato = con.no_contrato
INTERSECT
SELECT emp.codigo, emp.nombre_completo, emp.tipo, emp.codigo_mentor FROM empleado as emp
INNER JOIN transaccion as tran ON tran.codigo_revisor = emp.codigo
GROUP BY emp.codigo
HAVING COUNT(*) >= 2
INTERSECT
SELECT emp.codigo, emp.nombre_completo, emp.tipo, emp.codigo_mentor FROM empleado as emp
LEFT JOIN transaccion as tran ON tran.codigo_encargado = emp.codigo
WHERE tran.codigo IS NULL"; // <<< DEJE ESTA LÍNEA VACÍA O REEMPLÁCELA CON SU CONSULTA

$result = null;
if (!empty($query)) {
    $result = pg_query($conn, $query);
}
?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-4">Resultados de la Consulta 2</h1>
<p class="text-center text-gray-400 mb-8">Mostrando los resultados de la consulta personalizada.</p>

<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8 max-w-4xl mx-auto">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Código Empleado</th>
                <th class="py-3 px-4 text-left">Nombre Completo</th>
                <th class="py-3 px-4 text-left">Tipo</th>
                <th class="py-3 px-4 text-left">Código de Mentor</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php if ($result && pg_num_rows($result) > 0): ?>
                <?php while ($fila = pg_fetch_assoc($result)): ?>
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['codigo']); ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['nombre_completo']); ?></td>
                    <td class="py-3 px-4"><span class="px-2 py-1 rounded <?= $fila['tipo'] == 'CRUPIER' ? 'bg-blue-600' : 'bg-purple-600' ?>"><?= htmlspecialchars($fila['tipo']); ?></span></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($fila['codigo_mentor'] ?? 'N/A'); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr class="border-b border-gray-700">
                    <td colspan="4" class="text-center py-4">
                        <?php if (empty($query)): ?>
                            La consulta está vacía. Por favor, edite el archivo `consulta2.php` para agregar una consulta SQL.
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

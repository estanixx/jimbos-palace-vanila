<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-2">Búsqueda de Inscripciones a Torneos</h1>
<p class="text-center text-gray-400 mb-8">Filtre las inscripciones por empleado y rango de fechas.</p>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-lg mx-auto">
    <form action="busqueda2.php" method="POST">
        <div class="mb-4">
            <label for="codigo_empleado" class="block text-white mb-2">Empleado</label>
            <select name="codigo_empleado" id="codigo_empleado" class="w-full p-2 bg-gray-700 rounded" required>
                <option value="" disabled selected>Seleccione un empleado...</option>
                <?php
                    require('../config/conexion.php');
                    $query_empleados = "SELECT codigo, nombre_completo FROM empleado ORDER BY nombre_completo";
                    $result_empleados = pg_query($conn, $query_empleados);
                    $selected_empleado = $_POST['codigo_empleado'] ?? '';
                    while ($row = pg_fetch_assoc($result_empleados)) {
                        $selected = ($row['codigo'] == $selected_empleado) ? 'selected' : '';
                        echo "<option value='{$row['codigo']}' $selected>{$row['nombre_completo']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="fecha_inicio" class="block text-white mb-2">Desde</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full p-2 bg-gray-700 rounded" required value="<?= $_POST['fecha_inicio'] ?? '' ?>">
            </div>
            <div>
                <label for="fecha_fin" class="block text-white mb-2">Hasta</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="w-full p-2 bg-gray-700 rounded" required value="<?= $_POST['fecha_fin'] ?? '' ?>">
            </div>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar Transacciones</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    // Connection already open from dropdown population, no need to require again
    $empleado_id = $_POST['codigo_empleado'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $query = "SELECT codigo, nombre_cliente, nombre_torneo, monto_dinero, fecha 
              FROM transaccion 
              WHERE tipo = 'INSCRIPCION' 
              AND codigo_empleado = $1 
              AND fecha BETWEEN $2 AND $3
              ORDER BY fecha DESC";
    
    $result = pg_prepare($conn, "busqueda_inscripcion", $query);
    $result = pg_execute($conn, "busqueda_inscripcion", array($empleado_id, $fecha_inicio, $fecha_fin));

    if ($result && pg_num_rows($result) > 0):
?>
<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Cliente</th>
                <th class="py-3 px-4 text-left">Torneo</th>
                <th class="py-3 px-4 text-left">Monto</th>
                <th class="py-3 px-4 text-left">Fecha</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php while ($fila = pg_fetch_assoc($result)): ?>
            <tr class="border-b border-gray-700">
                <td class="py-3 px-4"><?= $fila['nombre_cliente']; ?></td>
                <td class="py-3 px-4"><?= $fila['nombre_torneo']; ?></td>
                <td class="py-3 px-4">$<?= number_format($fila['monto_dinero']); ?></td>
                <td class="py-3 px-4"><?= $fila['fecha']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="text-center bg-red-800 p-4 rounded-lg text-white mt-8">No se encontraron inscripciones para este empleado en el rango de fechas seleccionado.</div>
<?php 
    endif;
    if ($conn) { pg_close($conn); }
endif; 
?>

<?php include "../includes/footer.php"; ?>
<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-2">Búsqueda Avanzada de Transacciones</h1>
<p class="text-center text-gray-400 mb-8">Encuentre el contrato asociado a una transacción.</p>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-lg mx-auto">
    <form action="busqueda1.php" method="POST">
        <div class="mb-4">
            <label for="codigo" class="block text-white mb-2">Transaccion</label>
            <select name="codigo" id="codigo" class="w-full p-2 bg-gray-700 rounded" required>
                <option value="" disabled selected>Seleccione una transaccion...</option>
                <?php
                    require('../config/conexion.php');
                    $query_transaccion = "SELECT codigo FROM transaccion ORDER BY codigo";
                    $result_transaccion = pg_query($conn, $query_transaccion);
                    $selected_transaccion = $_POST['codigo'] ?? '';
                    while ($row = pg_fetch_assoc($result_transaccion)) {
                        $selected = ($row['codigo'] == $selected_transaccion) ? 'selected' : '';
                        echo "<option value='{$row['codigo']}' $selected>Transacción REF{$row['codigo']}</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar Contrato asociado🤔</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    require('../config/conexion.php');
    $codigo = $_POST['codigo'];

    $query = "SELECT tran.codigo, emp.nombre_completo, con.salary, con.fecha_inicio, con.fecha_fin, con.no_contrato FROM transaccion AS tran
            INNER JOIN empleado AS emp ON tran.codigo_encargado = emp.codigo
            INNER JOIN contrato AS con ON con.no_contrato = emp.no_contrato
            WHERE tran.codigo = $1
            LIMIT 1";

    $result = pg_prepare($conn, "busqueda1", $query);
    $result = pg_execute($conn, "busqueda1", array($codigo));


    if ($result && pg_num_rows($result) > 0):
?>
<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">No. Contrato</th>
                <th class="py-3 px-4 text-left">Nombre Completo</th>
                <th class="py-3 px-4 text-left">Salario</th>
                <th class="py-3 px-4 text-left">Fecha Inicio</th>
                <th class="py-3 px-4 text-left">Fecha Fin</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php while ($fila = pg_fetch_assoc($result)): ?>
            <tr class="border-b border-gray-700">
                <td class="py-3 px-4"><?= $fila['no_contrato']; ?></td>
                <td class="py-3 px-4"><?= $fila['nombre_completo']; ?></td>
                <td class="py-3 px-4"><?= $fila['salary']; ?></td>
                <td class="py-3 px-4"><?= $fila['fecha_inicio']; ?></td>
                <td class="py-3 px-4"><?= $fila['fecha_fin']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="text-center bg-red-800 p-4 rounded-lg text-white mt-8">No se contratos relacionados con esta transaccion.</div>
<?php 
    endif;
    if ($conn) { pg_close($conn); }
endif; 
?>

<?php include "../includes/footer.php"; ?>
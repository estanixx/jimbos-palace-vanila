<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-2">Transacciones extemporáneas</h1>
<p class="text-center text-gray-400 mb-8">Obtenga las transacciones extemporaneas a un contrato</p>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-lg mx-auto">
    <form action="busqueda2.php" method="POST">
        <div class="mb-4">
            <label for="no_contrato" class="block text-white mb-2">Contrato</label>
            <select name="no_contrato" id="no_contrato" class="w-full p-2 bg-gray-700 rounded" required>
                <option value="" disabled selected>Seleccione un contrato...</option>
                <?php
                    require('../config/conexion.php');
                    $query_contratos = "SELECT no_contrato FROM contrato ORDER BY no_contrato";
                    $result_contratos = pg_query($conn, $query_contratos);
                    $selected_contrato = $_POST['no_contrato'] ?? '';
                    while ($row = pg_fetch_assoc($result_contratos)) {
                        $selected = ($row['no_contrato'] == $selected_contrato) ? 'selected' : '';
                        echo "<option value='{$row['no_contrato']}' $selected>Contrato #{$row['no_contrato']}</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar Transacciones Extemporaneas🤔</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    // Connection already open from dropdown population, no need to require again
    $no_contrato = $_POST['no_contrato'];

    $query = "SELECT con.no_contrato, con.fecha_inicio, con.fecha_fin, emp.nombre_completo, tran.fecha, tran.nombre_cliente, tran.tipo, tran.monto_dinero
        FROM contrato AS con
        INNER JOIN empleado AS emp ON emp.no_contrato = con.no_contrato
        INNER JOIN transaccion AS tran ON tran.codigo_revisor = emp.codigo
        WHERE con.no_contrato = $1 AND tran.fecha NOT BETWEEN con.fecha_inicio AND con.fecha_fin
        ORDER BY tran.fecha DESC";
    
    $result = pg_prepare($conn, "busqueda2", $query);
    $result = pg_execute($conn, "busqueda2", array($no_contrato));

    if ($result && pg_num_rows($result) > 0):
?>
<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Empleado</th>
                <th class="py-3 px-4 text-left">Movimiento</th>
                <th class="py-3 px-4 text-left">Monto</th>
                <th class="py-3 px-4 text-left">Inicio Contrato</th>
                <th class="py-3 px-4 text-left">Fin Contrato</th>
                <th class="py-3 px-4 text-left">Fecha Transaccion</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php while ($fila = pg_fetch_assoc($result)): ?>
            <tr class="border-b border-gray-700">
                <td class="py-3 px-4"><?= $fila['nombre_completo']; ?></td>
                <td class="py-3 px-4"><?= $fila['tipo']; ?> a <?= $fila['nombre_cliente']; ?> </td>
                <td class="py-3 px-4">$<?= number_format($fila['monto_dinero']); ?></td>
                <td class="py-3 px-4"><?= $fila['fecha_inicio']; ?></td>
                <td class="py-3 px-4"><?= $fila['fecha_fin']; ?></td>
                <td class="py-3 px-4"><?= $fila['fecha']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="text-center bg-red-800 p-4 rounded-lg text-white mt-8">No se encontraron transacciones extemporaneas al contrato.</div>
<?php 
    endif;
    if ($conn) { pg_close($conn); }
endif; 
?>

<?php include "../includes/footer.php"; ?>
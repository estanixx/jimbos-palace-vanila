<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-8">Registro de Transacciones</h1>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-white mb-4">Nueva Transacción</h2>
    <form action="transaccion_insert.php" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="codigo" class="block text-white mb-2">Código Trans.</label>
                <input type="number" name="codigo" id="codigo" class="w-full p-2 bg-gray-700 rounded" required>
            </div>
            <div>
                <label for="nombre_cliente" class="block text-white mb-2">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" id="nombre_cliente" class="w-full p-2 bg-gray-700 rounded" required>
            </div>
            <div>
                <label for="codigo_encargado" class="block text-white mb-2">Encargado</label>
                <select name="codigo_encargado" id="codigo_encargado" class="w-full p-2 bg-gray-700 rounded" required>
                    <option value="" selected disabled>Seleccione...</option>
                    <?php
                        require('../config/conexion.php');
                        $query_empleados = "SELECT codigo, nombre_completo FROM empleado ORDER BY nombre_completo";
                        $result_empleados = pg_query($conn, $query_empleados);
                        while ($row = pg_fetch_assoc($result_empleados)) {
                            echo "<option value='{$row['codigo']}'>#{$row['codigo']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="codigo_revisor" class="block text-white mb-2">Revisor (Opcional)</label>
                <select name="codigo_revisor" id="codigo_revisor" class="w-full p-2 bg-gray-700 rounded">
                    <option value="" selected>Sin Revisor</option>
                    <?php
                        require('../config/conexion.php');
                        $query_empleados = "SELECT codigo, nombre_completo FROM empleado ORDER BY nombre_completo";
                        $result_empleados = pg_query($conn, $query_empleados);
                        while ($row = pg_fetch_assoc($result_empleados)) {
                            echo "<option value='{$row['codigo']}'>#{$row['codigo']}</option>";
                        }
                    ?>
                </select>
            </div>
             <div>
                <label for="monto_dinero" class="block text-white mb-2">Monto ($)</label>
                <input type="number" step="0.01" name="monto_dinero" id="monto_dinero" class="w-full p-2 bg-gray-700 rounded" required>
            </div>
            <div>
                <label for="fecha" class="block text-white mb-2">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full p-2 bg-gray-700 rounded" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div>
                <label for="hora" class="block text-white mb-2">Hora</label>
                <input type="time" name="hora" id="hora" class="w-full p-2 bg-gray-700 rounded" value="<?= date('H:i') ?>" required>
            </div>
             <div>
                <label for="tipo" class="block text-white mb-2">Tipo de Transacción</label>
                <select name="tipo" id="tipo" class="w-full p-2 bg-gray-700 rounded" required onchange="toggleTransactionFields()">
                    <option value="" selected disabled>Seleccione...</option>
                    <option value="COMPRA FICHAS">Compra de Fichas</option>
                    <option value="CANJE FICHAS">Canje de Fichas</option>
                    <option value="INSCRIPCION">Inscripción a Torneo</option>
                </select>
            </div>
        </div>
        
        <div id="fichas_field" class="hidden mt-4">
            <label for="cantidad_fichas" class="block text-white mb-2">Cantidad de Fichas</label>
            <input type="number" name="cantidad_fichas" id="cantidad_fichas" class="w-full p-2 bg-gray-700 rounded">
        </div>
        <div id="torneo_field" class="hidden mt-4">
            <label for="nombre_torneo" class="block text-white mb-2">Nombre del Torneo</label>
            <input type="text" name="nombre_torneo" id="nombre_torneo" class="w-full p-2 bg-gray-700 rounded">
        </div>

        <button type="submit" class="w-full mt-6 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded">Registrar Transacción</button>
    </form>
</div>

<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-x-auto">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Cliente</th>
                <th class="py-3 px-4 text-left">Encargado</th>
                <th class="py-3 px-4 text-left">Revisor</th>
                <th class="py-3 px-4 text-left">Tipo</th>
                <th class="py-3 px-4 text-left">Monto</th>
                <th class="py-3 px-4 text-left">Fecha y Hora</th>
                <th class="py-3 px-4 text-left">Detalles</th>
                <th class="py-3 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php
            require("transaccion_select.php");
            if ($resultTransacciones && pg_num_rows($resultTransacciones) > 0) {
                while ($fila = pg_fetch_assoc($resultTransacciones)) {
            ?>
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4"><?= $fila['nombre_cliente']; ?></td>
                        <td class="py-3 px-4"><?= $fila['nombre_ejecutor']; ?></td>
                        <td class="py-3 px-4"><?= empty($fila['nombre_revisor']) ? 'N/A' : $fila['nombre_revisor'] ?></td>
                        <td class="py-3 px-4"><?= $fila['tipo']; ?></td>
                        <td class="py-3 px-4">$<?= number_format($fila['monto_dinero'], 2); ?></td>
                        <td class="py-3 px-4"><?= $fila['fecha']; ?> <?= $fila['hora']; ?></td>
                        <td class="py-3 px-4 text-sm">
                            <?php if ($fila['cantidad_fichas']): ?>
                                Fichas: <?= $fila['cantidad_fichas']; ?>
                            <?php elseif ($fila['nombre_torneo']): ?>
                                Torneo: <?= $fila['nombre_torneo']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="transaccion_delete.php" method="POST" onsubmit="return confirm('¿Seguro? Se eliminará esta transacción.');">
                                <input type="hidden" name="codigo_eliminar" value="<?= $fila['codigo']; ?>">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 font-bold py-1 px-3 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' class='text-center py-4'>No hay transacciones registradas.</td></tr>";
            }
            if ($conn) { pg_close($conn); }
            ?>
        </tbody>
    </table>
</div>

<script>
    // JS to toggle conditional fields based on transaction type
    function toggleTransactionFields() {
        const type = document.getElementById('tipo').value;
        const fichasField = document.getElementById('fichas_field');
        const torneoField = document.getElementById('torneo_field');
        const fichasInput = document.getElementById('cantidad_fichas');
        const torneoInput = document.getElementById('nombre_torneo');

        // Hide all and remove required
        fichasField.classList.add('hidden');
        torneoField.classList.add('hidden');
        fichasInput.required = false;
        torneoInput.required = false;

        if (type === 'COMPRA FICHAS' || type === 'CANJE FICHAS') {
            fichasField.classList.remove('hidden');
            fichasInput.required = true;
        } else if (type === 'INSCRIPCION') {
            torneoField.classList.remove('hidden');
            torneoInput.required = true;
        }
    }
    // Initial call
    toggleTransactionFields();
</script>

<?php include "../includes/footer.php"; ?>
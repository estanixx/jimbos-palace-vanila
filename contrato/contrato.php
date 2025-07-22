<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-8">Administrar Contratos</h1>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-white mb-4">Nuevo Contrato</h2>
    <form action="contrato_insert.php" method="POST">
        <div class="mb-4">
            <label for="no_contrato" class="block text-white mb-2">No. Contrato</label>
            <input type="number" name="no_contrato" id="no_contrato" class="w-full p-2 bg-gray-700 rounded border border-gray-600 focus:outline-none focus:border-yellow-400" required>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="fecha_inicio" class="block text-white mb-2">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
            </div>
            <div>
                <label for="fecha_fin" class="block text-white mb-2">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
            </div>
        </div>
        <div class="mb-4">
            <label for="salary" class="block text-white mb-2">Salario</label>
            <input type="number" step="0.01" name="salary" id="salary" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
        </div>
        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded">Agregar Contrato</button>
    </form>
</div>

<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">No. Contrato</th>
                <th class="py-3 px-4 text-left">Fecha Inicio</th>
                <th class="py-3 px-4 text-left">Fecha Fin</th>
                <th class="py-3 px-4 text-left">Salario</th>
                <th class="py-3 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php
            require("contrato_select.php");
            if ($resultContratos && pg_num_rows($resultContratos) > 0) {
                while ($fila = pg_fetch_assoc($resultContratos)) {
            ?>
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4"><?= $fila['no_contrato']; ?></td>
                        <td class="py-3 px-4"><?= $fila['fecha_inicio']; ?></td>
                        <td class="py-3 px-4"><?= $fila['fecha_fin']; ?></td>
                        <td class="py-3 px-4">$<?= number_format($fila['salary'], 2); ?></td>
                        <td class="py-3 px-4 text-center">
                            <form action="contrato_delete.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contrato?');">
                                <input type="hidden" name="no_contrato_eliminar" value="<?= $fila['no_contrato']; ?>">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5' class='text-center py-4'>No hay contratos registrados.</td></tr>";
            }
            if ($conn) { pg_close($conn); }
            ?>
        </tbody>
    </table>
</div>

<?php include "../includes/footer.php"; ?>
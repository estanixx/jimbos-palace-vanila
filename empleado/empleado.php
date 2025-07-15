<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-8">Gerenciar Empleados</h1>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-white mb-4">Nuevo Empleado</h2>
    <form action="empleado_insert.php" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="codigo" class="block text-white mb-2">Código</label>
                <input type="number" name="codigo" id="codigo" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
            </div>
            <div class="mb-4">
                <label for="nombre_completo" class="block text-white mb-2">Nombre Completo</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
            </div>
             <div class="mb-4">
                <label for="tipo" class="block text-white mb-2">Tipo</label>
                <select name="tipo" id="tipo" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required onchange="toggleFields()">
                    <option value="" selected disabled>Seleccione un tipo...</option>
                    <option value="CRUPIER">Crupier</option>
                    <option value="JEFE DE SALA">Jefe de Sala</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="no_contrato" class="block text-white mb-2">Contrato</label>
                <select name="no_contrato" id="no_contrato" class="w-full p-2 bg-gray-700 rounded border border-gray-600" required>
                    <option value="" selected disabled>Seleccione un contrato...</option>
                    <?php
                        require('../config/conexion.php');
                        $query_contratos = "SELECT no_contrato FROM contrato ORDER BY no_contrato";
                        $result_contratos = pg_query($conn, $query_contratos);
                        while ($row = pg_fetch_assoc($result_contratos)) {
                            echo "<option value='{$row['no_contrato']}'>Contrato N° {$row['no_contrato']}</option>";
                        }
                    ?>
                </select>
            </div>
             <div class="mb-4">
                <label for="codigo_mentor" class="block text-white mb-2">Mentor (Opcional)</label>
                <select name="codigo_mentor" id="codigo_mentor" class="w-full p-2 bg-gray-700 rounded border border-gray-600">
                    <option value="">Sin mentor</option>
                     <?php
                        // Re-query employees for mentor dropdown
                        $query_mentores = "SELECT codigo, nombre_completo FROM empleado ORDER BY nombre_completo";
                        $result_mentores = pg_query($conn, $query_mentores);
                        while ($row = pg_fetch_assoc($result_mentores)) {
                            echo "<option value='{$row['codigo']}'>{$row['nombre_completo']}</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div id="crupier_fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label for="años_experiencia" class="block text-white mb-2">Años de Experiencia</label>
                <input type="number" name="años_experiencia" id="años_experiencia" class="w-full p-2 bg-gray-700 rounded border border-gray-600">
            </div>
            <div>
                <label for="juego_certificado" class="block text-white mb-2">Juego Certificado</label>
                <input type="text" name="juego_certificado" id="juego_certificado" class="w-full p-2 bg-gray-700 rounded border border-gray-600">
            </div>
        </div>
        <div id="jefe_fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label for="area_asignada" class="block text-white mb-2">Área Asignada</label>
                <input type="text" name="area_asignada" id="area_asignada" class="w-full p-2 bg-gray-700 rounded border border-gray-600">
            </div>
            <div>
                <label for="codigo_certificacion" class="block text-white mb-2">Código de Certificación</label>
                <input type="number" name="codigo_certificacion" id="codigo_certificacion" class="w-full p-2 bg-gray-700 rounded border border-gray-600">
            </div>
        </div>
        <button type="submit" class="w-full mt-6 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded">Agregar Empleado</button>
    </form>
</div>

<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-x-auto">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Código</th>
                <th class="py-3 px-4 text-left">Nombre</th>
                <th class="py-3 px-4 text-left">Tipo</th>
                <th class="py-3 px-4 text-left">Mentor</th>
                <th class="py-3 px-4 text-left">Detalles</th>
                <th class="py-3 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php
            require("empleado_select.php");
            if ($resultEmpleados && pg_num_rows($resultEmpleados) > 0) {
                while ($fila = pg_fetch_assoc($resultEmpleados)) {
            ?>
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4"><?= $fila['codigo']; ?></td>
                        <td class="py-3 px-4"><?= $fila['nombre_completo']; ?></td>
                        <td class="py-3 px-4"><span class="px-2 py-1 rounded <?= $fila['tipo'] == 'CRUPIER' ? 'bg-blue-600' : 'bg-purple-600' ?>"><?= $fila['tipo']; ?></span></td>
                        <td class="py-3 px-4"><?= $fila['nombre_mentor'] ?? 'N/A'; ?></td>
                        <td class="py-3 px-4 text-sm">
                            <?php if ($fila['tipo'] == 'CRUPIER'): ?>
                                Exp: <?= $fila['años_experiencia']; ?> años<br>Juego: <?= $fila['juego_certificado']; ?>
                            <?php else: ?>
                                Área: <?= $fila['area_asignada']; ?><br>Cert: <?= $fila['codigo_certificacion']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="empleado_delete.php" method="POST" onsubmit="return confirm('¿Seguro? Se eliminará este empleado.');">
                                <input type="hidden" name="codigo_eliminar" value="<?= $fila['codigo']; ?>">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center py-4'>No hay empleados registrados.</td></tr>";
            }
            if ($conn) { pg_close($conn); }
            ?>
        </tbody>
    </table>
</div>

<script>
    // JS to toggle conditional fields based on employee type
    function toggleFields() {
        const type = document.getElementById('tipo').value;
        const crupierFields = document.getElementById('crupier_fields');
        const jefeFields = document.getElementById('jefe_fields');

        // Get inputs inside the conditional divs
        const expInput = document.getElementById('años_experiencia');
        const juegoInput = document.getElementById('juego_certificado');
        const areaInput = document.getElementById('area_asignada');
        const certInput = document.getElementById('codigo_certificacion');

        if (type === 'CRUPIER') {
            crupierFields.classList.remove('hidden');
            jefeFields.classList.add('hidden');
            expInput.required = true;
            juegoInput.required = true;
            areaInput.required = false;
            certInput.required = false;
        } else if (type === 'JEFE DE SALA') {
            crupierFields.classList.add('hidden');
            jefeFields.classList.remove('hidden');
            expInput.required = false;
            juegoInput.required = false;
            areaInput.required = true;
            certInput.required = true;
        } else {
            crupierFields.classList.add('hidden');
            jefeFields.classList.add('hidden');
            expInput.required = false;
            juegoInput.required = false;
            areaInput.required = false;
            certInput.required = false;
        }
    }
    // Initial call to set state on page load
    toggleFields();
</script>

<?php include "../includes/footer.php"; ?>
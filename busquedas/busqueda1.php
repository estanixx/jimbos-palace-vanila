<?php include "../includes/header.php"; ?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-2">Búsqueda Avanzada de Crupieres</h1>
<p class="text-center text-gray-400 mb-8">Encuentre crupieres por juego certificado y años de experiencia.</p>

<div class="formulario bg-gray-800 p-6 rounded-lg shadow-lg mb-8 max-w-lg mx-auto">
    <form action="busqueda1.php" method="POST">
        <div class="mb-4">
            <label for="juego_certificado" class="block text-white mb-2">Juego Certificado</label>
            <input type="text" name="juego_certificado" id="juego_certificado" class="w-full p-2 bg-gray-700 rounded" required value="<?= $_POST['juego_certificado'] ?? '' ?>">
        </div>
        <div class="mb-4">
            <label for="min_experiencia" class="block text-white mb-2">Años de experiencia (mínimo)</label>
            <input type="number" name="min_experiencia" id="min_experiencia" class="w-full p-2 bg-gray-700 rounded" required value="<?= $_POST['min_experiencia'] ?? 0 ?>">
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar Crupieres</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    require('../config/conexion.php');
    $juego = $_POST['juego_certificado'];
    $experiencia = $_POST['min_experiencia'];

    $query = "SELECT codigo, nombre_completo, años_experiencia, juego_certificado 
              FROM empleado 
              WHERE tipo = 'CRUPIER' 
              AND años_experiencia >= $1 
              AND lower(juego_certificado) LIKE lower($2)";

    $result = pg_prepare($conn, "busqueda_crupier", $query);
    $result = pg_execute($conn, "busqueda_crupier", array($experiencia, '%' . $juego . '%'));

    if ($result && pg_num_rows($result) > 0):
?>
<div class="tabla bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8">
    <table class="min-w-full">
        <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4 text-left">Código</th>
                <th class="py-3 px-4 text-left">Nombre Completo</th>
                <th class="py-3 px-4 text-left">Años Exp.</th>
                <th class="py-3 px-4 text-left">Juego Certificado</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            <?php while ($fila = pg_fetch_assoc($result)): ?>
            <tr class="border-b border-gray-700">
                <td class="py-3 px-4"><?= $fila['codigo']; ?></td>
                <td class="py-3 px-4"><?= $fila['nombre_completo']; ?></td>
                <td class="py-3 px-4"><?= $fila['años_experiencia']; ?></td>
                <td class="py-3 px-4"><?= $fila['juego_certificado']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="text-center bg-red-800 p-4 rounded-lg text-white mt-8">No se encontraron crupieres que coincidan con los criterios de búsqueda.</div>
<?php 
    endif;
    if ($conn) { pg_close($conn); }
endif; 
?>

<?php include "../includes/footer.php"; ?>
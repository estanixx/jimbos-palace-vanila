<?php
// The PHP redirection logic is no longer needed here.
include "../includes/header.php";
?>

<h1 class="text-4xl pixel-font text-center text-yellow-400 mb-4">Consultas Personalizadas</h1>
<p class="text-center text-gray-400 mb-12">Seleccione una de las consultas predefinidas para ver los resultados.</p>

<!-- The single form has been replaced with two separate forms -->
<div class="flex justify-center items-center gap-8">
    
    <!-- Form 1: Navigates to consulta1.php -->
    <form action="consulta1.php" method="POST">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-200">
            Ver Consulta 1
        </button>
    </form>

    <!-- Form 2: Navigates to consulta2.php -->
    <form action="consulta2.php" method="POST">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-200">
            Ver Consulta 2
        </button>
    </form>

</div>

<?php include "../includes/footer.php"; ?>

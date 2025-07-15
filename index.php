<?php include "./includes/header.php"; ?>

<div class="text-center">
    <img src="/public/jimbo.png" alt="Jimbo, the casino mascot" class="mx-auto my-8 w-48 object-cover">

    <h1 class="text-6xl pixel-font fade-in-text text-yellow-400">
        Jimbo's Palace
    </h1>

    <p class="mt-4 text-xl text-gray-300">
        Your premier destination for high-stakes fun and entertainment.
    </p>

    <div class="enlaces mt-12 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/empleado/empleado.php" class="bg-red-700 hover:bg-red-800 p-4 rounded-lg text-lg font-bold">Gerenciar Empleados</a>
        <a href="/contrato/contrato.php" class="bg-blue-700 hover:bg-blue-800 p-4 rounded-lg text-lg font-bold">Administrar Contratos</a>
        <a href="/transaccion/transaccion.php" class="bg-green-700 hover:bg-green-800 p-4 rounded-lg text-lg font-bold">Ver Transacciones</a>
    </div>
</div>

<?php include "./includes/footer.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 4 - Ejercicio 4</title>
</head>

<body>
    <?php

    function saltoLinea(): void
    {
        echo "<br>";
    }

    $platos = [
        ["nombre" => "callos", "precio" => 12.9, "cantidad" => 1],
        ["nombre" => "olla", "precio" => 18.9, "cantidad" => 7],
        ["nombre" => "pan", "precio" => 3.9, "cantidad" => 10],
        ["nombre" => "filetes", "precio" => 19.1, "cantidad" => 2]
    ];

    function subtotalPlato(array $plato): float
    {
        return round($plato["cantidad"] * $plato["precio"], 2);
    }

    function totalComanda(array $platos): float
    {
        $total = 0;
        foreach ($platos as $plato) {
            $total += $plato["cantidad"] * $plato["precio"];
        }

        return $total;
    }

    // Mostrar todo de cada plato
    foreach ($platos as $plato) {
        echo "Nombre: {$plato["nombre"]} - cantidad: {$plato["cantidad"]}"
            . " - subtotal : " . subtotalPlato($plato);
        saltoLinea();
    }

    // TOTAL CON IVA

    static $iva = 10;

    $totalConIva = totalComanda($platos) * (1 + $iva / 100);

    echo "Total con IVA: $totalConIva";
    saltoLinea();

    // Propina
    $propina = 0;

    if ($totalConIva >= 80) {
        $propina = $totalConIva * (1 + 0.05) - $totalConIva;
    }

    $totalPagar = $totalConIva + $propina;

    echo "<h2>RESUMEN</h2>";
    echo "Total sin IVA: " . totalComanda($platos);
    saltoLinea();
    echo "IVA: $iva";
    saltoLinea();
    echo "Propina: " .  round($propina, 2);
    saltoLinea();
    echo "Total a pagar: " . round($totalPagar, 2);
    ?>
</body>

</html>
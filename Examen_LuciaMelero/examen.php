<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen PHP - Lucía Melero</title>
</head>

<body>
    <?php
    // Función para todos los ejercicios (saltar línea)
    function saltoLinea(): void
    {
        echo "<br>";
    }

    // Pregunta 1
    // 1.a
    $unidades = "4";
    $precio = 12.50;
    $codigo = null;
    $esSocio = true;
    $estado = "P";

    $cantidad = (int)$unidades;

    $importe = $cantidad * $precio;

    echo "Cantidad: $cantidad - precio: {$precio}€ - importe obtenido: {$importe}€";
    saltoLinea();

    // 1.b
    $descuento = 10;
    $importeFinal = $importe;

    if ($esSocio && $cantidad >= 4) {
        $importeFinal = $importe * (1 - $descuento / 100);
    }

    echo "Importe inicial: {$importe}€ - Importe final: {$importeFinal}€";
    saltoLinea();

    // 1.c
    // Código
    echo $codigo ?? "SIN CÓDIGO";
    saltoLinea();

    // Estado
    echo "Estado: ";

    echo match ($estado) {
        "P" => "Pendiente",
        "E" => "Enviado",
        default => "Desconocido"
    };

    saltoLinea();

    // Pregunta 2
    $temperaturas = [18, 22, 19, 25, 17, 23, 21];
    // 2.a
    foreach ($temperaturas as $t => $value) {
        $dia = $t + 1;
        echo "Día {$dia}: $value grados.";
        saltoLinea();
    }

    //2.b
    $suma = 0;
    foreach ($temperaturas as $t) {
        $suma += $t;
    }

    $media = round($suma / count($temperaturas), 2);

    echo "Temperatura media: $media grados.";
    saltoLinea();

    // 2.c
    $maxima = PHP_INT_MIN;
    $minima = PHP_INT_MAX;

    foreach ($temperaturas as $t) {
        if ($maxima < $t) {
            $maxima = $t;
        }

        if ($minima > $t) {
            $minima = $t;
        }
    }

    echo "Temperatura máxima: $maxima grados.";
    saltoLinea();
    echo "Temperatura mínima: $minima grados.";
    saltoLinea();

    //2.d
    $temperaturasSuperiores = [];

    foreach ($temperaturas as $t) {
        if ($t > $media) {
            $temperaturasSuperiores[] = $t;
        }
    }

    echo "Temperaturas superiores a la media: ";
    print_r($temperaturasSuperiores);
    saltoLinea();

    //Pregunta 3
    $productos = [
        ["nombre" => "Teclado", "precio" => 25.00, "stock" => 4],
        ["nombre" => "Ratón", "precio" => 15.00, "stock" => 0],
        ["nombre" => "Monitor", "precio" => 180.00, "stock" => 3],
        ["nombre" => "Webcam", "precio" => 40.00, "stock" => 2]
    ];

    $nombreBuscado = " Monitor ";
    //3.a

    $valorExistencias = 0;

    foreach ($productos as $p) {
        $valorExistencias = $p["precio"] * $p["stock"];

        echo "Nombre: {$p["nombre"]} - precio unidad: {$p["precio"]}€ - unidades disponibles: {$p["stock"]} uds - valor existencias: {$valorExistencias}€";
        saltoLinea();
    }

    //3.b
    $valorTotal = 0;
    foreach ($productos as $p) {
        $valorTotal += $p["precio"] * $p["stock"];
    }

    echo "Valor total: {$valorTotal}€";
    saltoLinea();

    //3.c
    $nombresStockInferior = [];

    foreach ($productos as $p) {
        if ($p["stock"] < 3) {
            $nombresStockInferior[] = $p["nombre"];
        }
    }

    echo "Productos con stock inferior a 3 unidades: ";
    echo implode(", ", $nombresStockInferior);
    saltoLinea();

    // 3.d
    function buscarProducto(string $nombreBuscado, array $productos): void
    {
        $encontrado = false;

        foreach ($productos as $p) {
            if ($p["nombre"] === trim($nombreBuscado)) {
                echo "Nombre: {$p["nombre"]} - precio: {$p["precio"]}€ - stock: {$p["stock"]} uds.";
                saltoLinea();
                $encontrado = true;
                break;
            }
        }

        if (!$encontrado) {
            echo "Producto no encontrado.";
            saltoLinea();
        }
    }

    buscarProducto("Monitor   ", $productos); // muestra: Nombre: Monitor - precio: 180€ - stock: 3 uds.
    buscarProducto("  Impresora  ", $productos); // muestra: Producto no encontrado.

    // Pregunta 4
    // 4.a

    function calcularBase(float $precio, int $unidades): float
    {
        return round($precio * $unidades, 2);
    }

    //4.b
    function calcularTotal(float $base, float $iva = 21): float
    {
        return $base * (1 + $iva / 100);
    }

    //4.c
    function aplicarDescuento(float &$importe, float $porcentaje): void
    {
        // Suponiendo que el porcentaje se pasa en formato (ej. porcentaje = 40):
        $importe = $importe * (1 - $porcentaje / 100);
    }

    //4.d
    $articulo = ["precio" => 50, "unidades" => 3];

    // 1 y 2
    $base = calcularBase($articulo["precio"], $articulo["unidades"]);
    $copiaBase = $base;

    // 3
    aplicarDescuento($base, 10);

    // 4
    $total21Iva = calcularTotal($base);

    // 5
    $total10Iva = calcularTotal($base, 10);

    // 6
    echo "Base original: {$copiaBase}€ - base descontada: {$base}€ - total con IVA 21: {$total21Iva}€ - total con IVA 10: {$total10Iva}€";
    saltoLinea();

    // Pregunta 5
    $notas = [3.5, 5, 7.25, 9.5, 4, 6];
    $estados = [
        "AP" => "Aprobado",
        "SU" => "Suspenso",
        "NP" => "No presentado"
    ];

    // 5.a
    $notasIncrementadas = [];

    $notasIncrementadas = array_map(fn($n) => $n > 9 ? 10 : $n+1, $notas);

    // 5.b
    $notasAptasYNoAptas = array_map(fn($n) => $n >= 5 ?  "Apto" : "No Apto", $notas);

    // 5.c
    $estadosVolteado = array_flip($estados);

    echo "Código correspondiente a Aprobado: {$estadosVolteado["Aprobado"]}";
    saltoLinea();

    // 5.d
    // Notas originales
    echo "Notas originales: " . implode(", ", $notas);
    saltoLinea();

    // Notas incrementadas
    echo "Notas incrementadas: " . implode(", ", $notasIncrementadas);
    saltoLinea();

    // Clasificación notas originales
    echo "Clasificación notas originales: ";
    saltoLinea();
    foreach ($notasAptasYNoAptas as $key => $value) {
        echo "La nota con key $key es $value.";
        saltoLinea();
    }

    // Array de estados invertido
    echo "Array de estados invertido";
    saltoLinea();
    foreach ($estadosVolteado as $key => $value) {
        echo "$key -> $value";
        saltoLinea();
    }

    // Código obtenido al consultar "Aprobado"
    echo "Código correspondiente a Aprobado: {$estadosVolteado["Aprobado"]}";
    ?>
</body>

</html>
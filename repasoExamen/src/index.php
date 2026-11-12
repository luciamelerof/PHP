<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 1</title>
</head>

<body>
    <?php

    /*Ejercicio: Control de Inventario y Almacén
Crea un array multidimensional con cuatro productos de un almacén. Cada producto debe contener: nombre, precio_coste (precio de adquisición unitario) y unidades (stock disponible en almacén), con precios y unidades mayores que cero.
Función de valor por producto: Escribe una función que calcule el valor total en inventario de un producto individual (precio_coste * unidades).
Función de valor total del almacén: Escribe otra función que reciba el array completo de productos y devuelva el valor total sumado de todo el inventario.
Listado de inventario: Muestra el nombre del producto, la cantidad de unidades disponibles y el valor total de su stock.
Recargo por seguro de mercancía: Aplica una tasa de seguro de almacenamiento del 5 % si el valor total del inventario es igual o superior a 500 euros. Si no alcanza esa cifra, la tasa será de 0 euros.
Resumen de valoración: Muestra el valor total del inventario sin tasa, el importe del seguro aplicado y el coste total final (inventario + seguro) formateado a dos decimales.
Caso límite: Prueba también las funciones pasándoles un almacén vacío (array sin productos): su valor total y su seguro deben ser 0.00 €.
    */

    $productos = [
        ["nombre" => "art1", "precio_coste" => 12.50, "unidades" => 3],
        ["nombre" => "art2", "precio_coste" => 10.3, "unidades" => 1],
        ["nombre" => "art3", "precio_coste" => 8.40, "unidades" => 6],
        ["nombre" => "art4", "precio_coste" => 32.15, "unidades" => 12]
    ];

    function saltoLinea(): void
    {
        echo "<br>";
    }

    function valorProducto(string $nombre, array $productos): float
    {

        foreach ($productos as $key) {
            if ($key["nombre"] === $nombre) {
                return number_format($key["precio_coste"] * $key["unidades"], 2);
            }
        }

        return 0;
    }

    function valorTotal(array $productos): float
    {
        $total = 0;
        foreach ($productos as $key) {
            $total += $key["precio_coste"] * $key["unidades"];
        }

        return number_format($total, 2);
    }

    function listado(array $productos): void
    {
        foreach ($productos as $key => $value) {
            echo "Producto $key: nombre {$value["nombre"]} - precio: {$value["precio_coste"]}€ - unidades: {$value["unidades"]}uds.";
            saltoLinea();
        }
    }

    function tasa(array $productos): float
    {
        $total = valorTotal($productos);

        if ($total >= 500) {
            return $total *= 1.05;
        }

        return $total;
    }

    function resumen(array $productos): void
    {
        $valorSinTasa = valorTotal($productos);
        $importeSeguro = tasa($productos) - $valorSinTasa;
        $importeFinal = number_format(tasa($productos), 2);

        echo "Valor sin tasa: {$valorSinTasa}€ - importe seguro: {$importeSeguro}€ - importe final: {$importeFinal}€";
    }

    // Comprobar si sale 0/0€ con array vacío (funciona)
    $arrayVacio = [];

    echo "V total: " . valorTotal($arrayVacio);
    saltoLinea();
    echo "V tasa: " . tasa($arrayVacio);
    saltoLinea();
    resumen($arrayVacio);
    saltoLinea();

    echo valorProducto("art1", $productos);
    saltoLinea();
    echo "V total: " . valorTotal($productos);
    saltoLinea();
    echo "V tasa: " . tasa($arrayVacio);
    saltoLinea();
    resumen($productos);
    ?>
</body>

</html>
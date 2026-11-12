<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Callbacks</title>
</head>

<body>
    <?php
    $productos = [
        ["nombre" => "Camiseta", "precio" => 15.0, "stock" => 10],
        ["nombre" => "Sudadera", "precio" => 39.9, "stock" => 0],
        ["nombre" => "Gorra",    "precio" => 12.5, "stock" => 4],
        ["nombre" => "Chaqueta", "precio" => 89.0, "stock" => 2],
    ];

    function filtrar(array $productos, callable $condicion): array
    {
        $productosCondicion = [];
        foreach ($productos as $p) {
            if ($condicion($p)) {
                $productosCondicion[] = $p;
            }
        }

        return $productosCondicion;
    }

    function transformar(array $productos, callable $cambio): array
    {
        $arrayTransformados = [];
        foreach ($productos as $p) {
            $arrayTransformados[] = $cambio($p);
        }

        return $arrayTransformados;
    }

    function hayStock(array $p): bool
    {
        if ($p["stock"] > 0) {
            return true;
        }

        return false;
    }

    $precioMaximo = 20;

    filtrar($productos, "hayStock");
    filtrar($productos, fn(array $a) => $a["precio"] < $precioMaximo);

    $descartados = 0;

    $funcionAnonima = function (array $productos) use (&$descartados): bool {

        if ($productos["precio"] < 15) {
            return true;
        }
        $descartados++;

        return false;
    };

    $numeros = ["c" =>4, "b" => 10, "a" => 1];

    $numerosIndex  = $numeros;
    
    foreach($numerosIndex as $n => $value) {
        echo $n . ":" . $value;
        echo "<br>";
    }





    ?>
</body>

</html>
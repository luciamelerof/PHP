<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda online</title>
</head>

<body>
    <?php
    function saltoLinea(): void
    {
        echo "<br>";
    }

    $catalogo = [
        ["codigo" => "P01", "nombre" => "Auriculares", "categoria" => "Audio",       "precio" => 39.90, "stock" => 15],
        ["codigo" => "P02", "nombre" => "Teclado",     "categoria" => "Periféricos", "precio" => 54.50, "stock" => 0],
        ["codigo" => "P03", "nombre" => "Altavoz",     "categoria" => "Audio",       "precio" => 89.00, "stock" => 4],
        ["codigo" => "P04", "nombre" => "Ratón",       "categoria" => "Periféricos", "precio" => 19.99, "stock" => 32],
        ["codigo" => "P05", "nombre" => "Webcam",      "categoria" => "Vídeo",       "precio" => 64.00, "stock" => 7],
    ];

    function mostrarCatalogo(array $catalogo): void
    {
        if (empty($catalogo)) {
            echo "El catálogo está vacío.";
        } else {
            foreach ($catalogo as $key => $value) {
                echo "$key - nombre: {$value["nombre"]} - precio " . number_format($value["precio"], 2) . " - stock {$value["stock"]}";
                saltoLinea();
            }
        }
    }

    mostrarCatalogo($catalogo);

    function buscarProducto(array $catalogo, string $codigo): ?array
    {
        foreach ($catalogo as $producto) {
            if ($producto["codigo"] === $codigo) {
                return $producto;
            }
        }
        return null;
    }
    ?>
</body>

</html>
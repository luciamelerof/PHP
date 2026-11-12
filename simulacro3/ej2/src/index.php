<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 3 - ejercicio 2</title>
</head>

<body>
    <?php
    function saltoLinea(): void
    {
        echo "<br>";
    }

    function analizarTemperaturas(array $temps): array
    {
        $mayor = PHP_INT_MIN;
        $menor = PHP_INT_MAX;
        $media = 0;
        $total = 0;
        $contadorBajo = 0;

        if (empty($temps)) {
            return ["Mayor" => null, "Menor" => null, "Media" => null, "Bajo 0" => 0];
        }

        foreach ($temps as $t) {
            if ($mayor < $t) {
                $mayor = $t;
            }

            if ($menor > $t) {
                $menor = $t;
            }

            $total += $t;

            if ($t < 0) {
                $contadorBajo++;
            }
        }

        $media = round($total / count($temps), 2, ",");

        return ["Mayor" => $mayor, "Menor" => $menor, "Media" => $media, "Bajo 0" => $contadorBajo];
    }

    echo "<h1>Analizador temperaturas</h1>";
    echo "<h2>Array normal</h2>";
    print_r(analizarTemperaturas([14, -2, 21, 0, 9, 17, -5]));
    echo "<h2>Solo una temperatura</h2>";
    print_r(analizarTemperaturas([8]));
    echo "<h2>Sin temperaturas</h2>";
    print_r(analizarTemperaturas([]));

    ?>
</body>

</html>
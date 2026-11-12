<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - simulacro 3</title>
</head>

<body>
    <?php
    $texto = "php, html,  css,php ,js, html,php";
    
    // Contar etiquetas

    function contarEtiquetas(string $texto): array
    {
        $arrayTexto = array_map('trim', explode(",", $texto));

        $contador = [];

        foreach ($arrayTexto as $a) {
            if ($a === "") {
                continue;
            }

            if (isset($contador[$a])) {
                $contador[$a]++;
            } else {
                $contador[$a] = 1;
            }
        }

        return $contador;
    }

    // Etiquetas únicas
    function etiquetasUnicas(string $texto): array
    {
        $arrayTexto = array_map('trim',  explode(",", $texto));

        $veces = [];

        foreach ($arrayTexto as $a) {
            if ($a === "") {
                continue;
            }

            if (isset($veces[$a])) {
                $veces[$a]++;
            } else {
                $veces[$a] = 1;
            }
        }

        $unicas = [];
        foreach ($veces as $key => $value) {
            $unicas[] = $key;
        }

        return $unicas;
    }

    $masMenosUsadas = contarEtiquetas($texto);
    arsort($masMenosUsadas);
    print_r($masMenosUsadas);

    $unicas = etiquetasUnicas($texto);
    sort($unicas);
    echo implode(", ", $unicas);


    ?>
</body>

</html>
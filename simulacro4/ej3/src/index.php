<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 4 -Ejercicio 3</title>
</head>

<body>
    <?php
    $paises = ["es" => "España", "pt" => "Portugal", "fr" => "Francia", "it" => "Italia"];

    // Ahora key = value y value = key
    $paises = array_flip($paises);

    function codigoDe(array $paises,  string $nombre): ?string
    {
        foreach ($paises as $key => $value) {
            if ($key === $nombre) {
                return $value;
            }
        }

        return null;
    }

    function existeCodigo(array $paises, string $codigo): bool
    {
        $claves = array_keys($paises);

        if (in_array($codigo, $claves)) {
            return true;
        }

        return false;
    }

    $paises["ad"] = "España";
    $paises = array_flip($paises);

    $ordenados = $paises;
    krsort($ordenados);

    $partes = [];
    foreach ($ordenados as $key => $value) {
        $partes[] = "$key=$value";
    }

    echo implode("|", $partes);
    ?>
</body>

</html>
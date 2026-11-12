<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 4 - ejercicio 5</title>
</head>

<body>
    <?php
    $resultados = "Granada-Málaga:2-1,Sevilla-Granada:0-0,Málaga-Sevilla:3-2,Granada-Sevilla:1-3,Málaga-Granada:1-1";

    function procesarLiga(string $resultados) : array {
        $partidos = explode(",", $resultados);
        
        $liga = [];
        $puntos = 0;

        foreach($partidos as $partido) {
            if ($partido === "") {
                continue;
            }
            
            [$equipos, $marcador] = explode(":", $partido);

            [$local, $visitante] = explode("-", $equipos);
            [$gf, $gc] = explode("-", $marcador);

            $gf = (int)$gf;
            $gc = (int)$gc;

            if (array_key_exists($local, $liga)) {
                $liga[$local]["gf"] += $gf;
                $liga[$local]["gc"] += $gc;
                $liga[$local]["jugados"] += 1;
            } else {
                $liga[$local] = ["puntos" => $puntos, "gf" => $gf, "gc" => $gc, "jugados" => 1];
            }

            if ($gf > $gc) {
                $liga[$local]["puntos"] += 3;
            } elseif ($gf === $gc) {
                $liga[$local]["puntos"] += 1;
                $liga[$visitante]["puntos"] += 1;
            } elseif($gf < $gc) {
                $liga[$visitante]["puntos"] += 3;
            }

            if (array_key_exists($visitante, $liga)) {
                $liga[$visitante]["gf"] += $gc;
                $liga[$visitante]["gc"] += $gf;
                $liga[$visitante]["jugados"] += 1;
            } else {
                $liga[$visitante] = ["puntos" => $puntos, "gf" => $gc, "gc" => $gf, "jugados" => 1];
            }
        }

        return $liga;
    }

    print_r(procesarLiga($resultados));
    ?>
</body>

</html>
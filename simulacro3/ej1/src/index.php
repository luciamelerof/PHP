<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - ciudades</title>
</head>

<body>
    <?php
    function saltoLinea() : void {
        echo "<br>";
    }

    $ciudades = ["Malaga", "Sevilla", "Cadiz", "Jaen", "Paris", "Madrid"];

    echo "<h1>Ciudades</h1>";
    echo "<h2>Ciudad primera</h2>";
    echo "{$ciudades[0]}";

    echo "<h2>Ciudad cuarta</h2>";
    echo "{$ciudades[3]}";

    echo "<h2>Ciudad última</h2>";
    echo "{$ciudades[count($ciudades) - 1]}";

    array_push($ciudades, "Almeria");
    array_push($ciudades, "Galicia");

    unset($ciudades[2]);
    unset($ciudades[4]);

    echo "<h2>Modificaciones en array</h2>";
    print_r($ciudades);

    $claves = array_keys($ciudades);
    echo "<h2>Claves que quedan</h2>";
    echo implode(", ", $claves);

    $ciudades = array_values($ciudades);
    $clavesNuevas = array_keys($ciudades);

    echo "<h2>Claves después de array_values</h2>";
    echo implode(", ", $clavesNuevas);

    echo "<h2>Todas las ciudades</h2>";
    foreach($ciudades as $key => $value) {
        echo "{$key}:{$value}";
        saltoLinea();
    }

    echo "<h2>Total ciudades</h2>";
    echo count($ciudades);
    ?>
</body>

</html>
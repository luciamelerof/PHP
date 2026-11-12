<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro - Ejercicio 1</title>
</head>

<body>
    <?php
    function saltoLinea() : void {
        echo "<br>";
    }
    $notas = [6, 9, 4, 7, 10, 3];

    // Mostrar primera y última
    echo "<h1>Notas</h1>";
    echo"<h2>Primera y última</h2>";
    echo "Primera: $notas[0]";
    saltoLinea();
    echo "Última: {$notas[count($notas) - 1]}";

    // Hacer 3 copias
    $notasAscendente = $notas;
    sort($notas);
    $notasDescendente = $notas;
    rsort($notas);
    $notasReversas = array_reverse($notas);

    // Mostrar original + 3 copias
    echo "<h2>Original y 3 copias</h2>";
    print_r($notas);
    saltoLinea();
    print_r($notasAscendente);
    saltoLinea();
    print_r($notasDescendente);
    saltoLinea();
    print_r($notasReversas);
    saltoLinea();

    // Diferencia entre rsort y array_reverse: rsort ordena de forma descendente según los valores del array (mayor a menor),
    // mientras que array_reverse da la vuelta al array, convirtiendose la ultima posicion en la primera y asi sucesivamente.
    ?>
</body>

</html>
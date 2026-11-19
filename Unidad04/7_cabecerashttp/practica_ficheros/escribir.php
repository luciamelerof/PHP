<?php
$ruta = __DIR__ . '/datos/notas.txt';

if (!file_exists($ruta) || !is_readable($ruta)) {
    exit('No se ha podido abrir el fichero.');
}

$fichero = fopen($ruta, 'a'); // add de añadir

$texto = 'Nueva nota añadida' . PHP_EOL; // salto de linea el PHP_EOL
$resultado = fwrite($fichero, $texto);

if (!$resultado)
    exit('No se ha podido completar la escritura');

fclose($fichero);

echo 'La nota se ha subido correctamente';

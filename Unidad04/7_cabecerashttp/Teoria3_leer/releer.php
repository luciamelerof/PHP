<?php
$ruta = __DIR__ . '/../practica_ficheros/datos/notas.txt';

if (!file_exists($ruta) || !is_readable($ruta)) {
    exit('No se ha podido abrir el fichero.');
}

$fichero = fopen($ruta, 'r'); // r de leer

$linea = fgets($fichero);

echo htmlspecialchars($linea, ENT_QUOTES, 'UTF-8') . "<br>";

// Mueve un puntero y apunta a la linea de atras
rewind($fichero);

$linea = fgets($fichero);

echo htmlspecialchars($linea, ENT_QUOTES, 'UTF-8') . "<br>";

fclose($fichero);



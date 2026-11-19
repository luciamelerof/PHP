<?php
$ruta = __DIR__ . '/datos/notas.txt';

if (!file_exists($ruta) || !is_readable($ruta)) {
    exit('No se ha podido abrir el fichero.');
}

$fichero = fopen($ruta, 'r');

while (($linea = fgets($fichero)) !== false) { // gets coge palabras, getc letras
    echo htmlspecialchars($linea, ENT_QUOTES, 'UTF-8') . "<br>";
}

if (!feof($fichero)) {
    echo 'Se ha producido un error de lectura';
}



fclose($fichero);
?>

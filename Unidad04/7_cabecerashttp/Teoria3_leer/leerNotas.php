<?php
// Acceder a datos linea por lineacon un array (fscanf)
$ruta = __DIR__ . '/../practica_ficheros/datos/notas.txt';

if (!file_exists($ruta) || !is_readable($ruta)) {
    exit('No se ha podido abrir el fichero.');
}

$fichero = fopen($ruta, 'r'); // r de leer

while (($datos = fscanf($fichero, '%s %d')) !== false) {
    if (count($datos) === 2 && $datos[0] !== null) {
        [$nombre, $nota] = $datos;
        echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($nota, ENT_QUOTES, 'UTF-8') . "<br>";
    }
}

// Acceder a un archivo completo (string)
$contenido = file_get_contents($fichero);
        echo htmlspecialchars($contenido, ENT_QUOTES, 'UTF-8');

        
fclose($fichero);


<?php


$ruta = __DIR__ . '/datos/notas.txt';


file_put_contents($ruta, "Sergio\n");
file_put_contents($ruta,"Armenteros\n",FILE_APPEND | LOCK_EX);


echo "<pre>";
echo htmlspecialchars(file_get_contents($ruta));
echo "</pre>";
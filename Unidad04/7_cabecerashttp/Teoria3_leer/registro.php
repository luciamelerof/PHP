<?php
    $ruta = __DIR__ . '/datos/registro.txt';
    $entrada = date('Y-m-d H:i:s') . " - Visita \n";


    $resultado = file_put_contents($ruta,$entrada,FILE_APPEND);


    $contenido = file_get_contents($ruta);
    echo htmlspecialchars($contenido);


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>


</body>


</html>
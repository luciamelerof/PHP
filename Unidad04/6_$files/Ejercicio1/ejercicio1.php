<?php
session_start();

function escapar(string $mensaje): string
{
    return htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');
}

$mensajes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreRecibido = $_POST['nombre'];

    $nombre = is_string($nombreRecibido) ? trim($nombreRecibido) : '';
    $documento = $_FILES['documento'] ?? null;

    if (
        !is_array($documento) ||
        !isset($documento['error'], $documento['size'], $documento['tmp_name']) ||
        !is_int($documento['error']) ||
        !is_int($documento['size']) ||
        !is_string($documento['tmp_name'])
    ) {
        $mensajes = 'No se ha recibido un archivo válido';
    } elseif (!($documento['error'] === UPLOAD_ERR_OK)) {
        $mensajes = 'No se ha cargado el archivo correctamente.';
    } elseif ($documento['size'] <= 0 || $documento['size'] > 2 * 1024 * 1024) {
        $mensajes = 'Tamaño de archivo inválido';
    } elseif (!is_uploaded_file($documento['tmp_name'])) {
        $mensajes = 'No se ha cargado el archivo. Vuelve a intentarlo';
    } else {
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if ($finfo->file($documento['tmp_name']) !== 'application/pdf') {
            $mensajes = 'Formato de archivo inválido';
        } else {
            $directorio = '/var/www/html/Unidad04/6_$files/Ejercicio1/subidas';

            if (!is_dir($directorio) || !is_writable($directorio)) {
                $mensajes = 'Almacenamiento no disponible';
            } else {
                $nombre = bin2hex(random_bytes(16)) . '.pdf';
                $destino = $directorio . DIRECTORY_SEPARATOR . $nombre;

                if (!move_uploaded_file($documento['tmp_name'], $destino)) {
                    $mensaje = 'No se ha movido el archivo al directorio';
                } else {
                    $mensaje = '';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Lucía Melero</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" required>

        <br>

        <label for="documento">File: (máx. 2MB)</label>
        <input type="file" name="documento" id="documento" accept="application/pdf" required>

        <br>

        <button type="submit">Enviar</button>
    </form>

    !-- Escribimos mensaje de error o de éxito -->
    <?php foreach ($mensajes as $m) { ?>
        <p><?= escapar($m) ?></p>
    <?php } ?>
</body>

</html>
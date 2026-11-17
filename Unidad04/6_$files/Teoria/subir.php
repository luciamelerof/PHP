<?php
session_start();
// Escribir siempre: función escapar
function escapar(string $mensaje): string
{
    return htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $archivo = $_FILES['documento'] ?? null;

    if (
        !is_array($archivo)
        || !isset($archivo['error'], $archivo['size'], $archivo['tmp_name'])
        || !is_int($archivo['error'])
        || !is_int($archivo['size'])
        || !is_string($archivo['tmp_name'])
    ) {
        $mensaje = 'No se ha recibido un archivo válido';
    } elseif ($archivo['error'] !== UPLOAD_ERR_OK) {
        $mensaje = 'Fallo en la subida';
    } elseif ($archivo['size'] <= 0 || $archivo['size'] > 2 * 1024 * 1024) {
        $mensaje = 'Tamaño del archivo inválido';
    } elseif (!is_uploaded_file($archivo['tmp_name'])) {
        $mensaje = "El fichero no tiene origen válido";
    } else {
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        // Comprobar con finfo que el fichero es del tipo que quiero (pdf)
        if ($finfo->file($archivo['tmp_name']) !== 'application/pdf') {
            $mensaje = 'Solo se admiten ficheros PDF';
        } else {
            $directorio = '/var/www/html/Unidad04/6_$files/subidas';

            if (!is_dir($directorio) || !is_writable($directorio)) {
                $mensaje = 'El almacenamiento no está disponible';
            } else {
                $nombre = bin2hex(random_bytes(16)) . '.pdf';
                $destino = $directorio . DIRECTORY_SEPARATOR . $nombre;

                if (!move_uploaded_file($archivo['tmp_name'], $destino)) {
                    $mensaje = "No se ha podido guardar el archivo";
                } else {
                    $mensaje = "Guardado con éxito";
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
    <title>Ejercicio de teoría - FILES</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <!--action="" es lo mismo que action="subir.php"-->
        <label for="documento">Selecciona un archivo PDF (máx. 2MB)</label>
        <input type="file" name="documento" id="documento" accept="application/pdf" required>
        <br>
        <button type="submit">Cargar archivo</button>
    </form>

    <!-- Escribimos mensaje de error o de éxito -->
    <?php if ($mensaje !== ''): ?>
        <p><?= escapar($mensaje) ?></p>
    <?php endif; ?>
</body>

</html>
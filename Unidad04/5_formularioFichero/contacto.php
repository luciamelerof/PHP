<?php

// 1. Inicializar las variables $nombre, $email, $asunto y $mensaje con cadenas vacías.
$nombre  = '';
$email   = '';
$asunto  = '';
$mensaje = '';

// 2. Inicializar un array vacío para guardar los errores.
$errores = [];

// 3. Inicializar una variable booleana para indicar si los datos son correctos.
$correctos = false;

// 4. Crear una función llamada escapar() que utilice htmlspecialchars().
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// 5. Comprobar si la petición se ha realizado mediante POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 6. Recuperar los cuatro campos utilizando $_POST y el operador ??.
    $nombre  = $_POST['nombre'] ?? '';
    $email   = $_POST['correo'] ?? '';
    $asunto  = $_POST['asunto'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    // 7. Comprobar que los datos recibidos son cadenas antes de aplicar trim().
    $nombre  = is_string($nombre) ? trim($nombre) : '';
    $email   = is_string($email) ? trim($email) : '';
    $asunto  = is_string($asunto) ? trim($asunto) : '';
    $mensaje = is_string($mensaje) ? trim($mensaje) : '';

    // 8. Validar el nombre.
    if ($nombre === '') {
        $errores[] = "El nombre no puede estar vacío";
    } elseif (mb_strlen($nombre) > 100) {
        $errores[] = "El nombre no puede tener más de 100 caracteres";
    }

    // 9. Validar el correo electrónico.
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errores[] = "El email no es válido";
    }

    // 10. Validar el asunto.
    if ($asunto === '') {
        $errores[] = "El asunto no puede estar vacío";
    } elseif (mb_strlen($asunto) > 150) {
        $errores[] = "El asunto no puede tener más de 150 caracteres";
    }

    // 11. Validar el mensaje.
    if ($mensaje === '') {
        $errores[] = "El mensaje no puede estar vacío";
    } elseif (mb_strlen($mensaje) > 1000) {
        $errores[] = "El mensaje no puede tener más de 1000 caracteres";
    }

    // 12. Todos los errores se guardan en el array sin detener la ejecución.
    if (empty($errores)) {
        $correctos = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Contacto</h1>

    <!-- 13. Mostrar todos los errores utilizando escapar(). -->
    <?php if (!empty($errores)): ?>
        <h2>Errores</h2>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escapar($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    // 16. Mostrar un mensaje de confirmación únicamente cuando no haya errores.
    <?php if ($correctos): ?>
        <p>Datos enviados correctamente.</p>
    <?php endif; ?>

    <!-- 14. Conservar los valores introducidos en los campos. -->
    <form method="post" action="">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" maxlength="100" required>

        <br>

        <label for="correo">Correo electrónico: </label>
        <input type="email" name="correo" id="correo" value="<?= escapar($email) ?>" required>

        <br>

        <label for="asunto">Asunto: </label>
        <input type="text" name="asunto" id="asunto" value="<?= escapar($asunto) ?>" maxlength="150" required>

        <br>

        <label for="mensaje">Mensaje: </label>
        <textarea id="mensaje" name="mensaje" rows="10" cols="30" maxlength="1000" required><?= escapar($mensaje) ?></textarea>

        <br>

        <button type="submit">Enviar</button>
    </form>
</body>

</html>
<?php
session_start();

// Leer lo que dejó la petición anterior y borrarlo (flash)
$errores = $_SESSION['errores'] ?? [];
$old = $_SESSION['old'] ?? [];
$exito = $_SESSION['exito'] ?? '';

// Flash
unset($_SESSION['errores'], $_SESSION['old'], $_SESSION['exito']);

// 4. Crear una función llamada escapar() que utilice htmlspecialchars().
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// 5. Comprobar si la petición se ha realizado mediante POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = [];

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
        $errores['nombre'] = "El nombre no puede estar vacío";
    } elseif (mb_strlen($nombre) > 100) {
        $errores['nombre'] = "El nombre no puede tener más de 100 caracteres";
    }

    // 9. Validar el correo electrónico.
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errores['correo'] = "El email no es válido";
    }

    // 10. Validar el asunto.
    if ($asunto === '') {
        $errores['asunto'] = "El asunto no puede estar vacío";
    } elseif (mb_strlen($asunto) > 150) {
        $errores['asunto'] = "El asunto no puede tener más de 150 caracteres";
    }

    // 11. Validar el mensaje.
    if ($mensaje === '') {
        $errores['mensaje'] = "El mensaje no puede estar vacío";
    } elseif (mb_strlen($mensaje) > 1000) {
        $errores['mensaje'] = "El mensaje no puede tener más de 1000 caracteres";
    }

    // 12. Todos los errores se guardan en el array sin detener la ejecución.
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        $_SESSION['old'] = ['nombre' => $nombre, 'email' => $email,  'asunto' => $asunto, 'mensaje' => $mensaje];
    } else {
        $_SESSION['exito'] = 'Mensaje enviado correctamente';
    }

    // Redirect => la siguiente peticion es el GET
    header('Location: contacto.php');
    exit;
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
    
    <?php if ($exito): ?>
        <p><?= escapar($exito) ?></p>
    <?php endif; ?>

    <!-- 14. Conservar los valores introducidos en los campos. -->
    <form method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?= escapar($old['nombre'] ?? '') ?>" maxlength="100" required>

        <?php if (isset($errores['nombre'])) : ?>
            <p><?= escapar($errores['nombre']) ?> </p>
        <?php endif; ?>

        <label for="correo">Email: </label>
        <input type="email" name="correo" id="correo" value="<?= escapar($old['email'] ?? '') ?>" required>
        
        <?php if (isset($errores['correo'])) : ?>
            <p><?= escapar($errores['correo']) ?> </p>
        <?php endif; ?>

        <label for="asunto">Asunto: </label>
        <input type="text" name="asunto" id="asunto" value="<?= escapar($old['asunto'] ?? '') ?>" maxlength="150" required>

        <?php if (isset($errores['asunto'])) : ?>
            <p><?= escapar($errores['asunto']) ?> </p>
        <?php endif; ?>

        <label for="mensaje">Mensaje: </label>
        <textarea id="mensaje" name="mensaje" rows="10" cols="30" maxlength="1000" required><?= escapar($old['mensaje'] ?? '') ?></textarea>

        <?php if (isset($errores['mensaje'])) : ?>
            <p><?= escapar($errores['mensaje']) ?> </p>
        <?php endif; ?>

        <button type="submit">Enviar</button>
    </form>
</body>

</html>
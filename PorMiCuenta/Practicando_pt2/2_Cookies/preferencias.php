<?php
session_start();

$temasPermitidos = ['claro', 'oscuro'];
$idiomasPermitidos = ['es', 'en'];

// Guardar preferencia (POST → cookie → redirect)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accion = $_POST['accion'] ?? '';
    $temaValido = false;
    $idiomaValido = false;
    if ($accion === 'guardar') {
        $tema = $_POST['tema'] ?? '';
        $idioma = $_POST['idioma'] ?? '';


        if (is_string($tema) && in_array($tema, $temasPermitidos, true)) {
            setcookie('tema', $tema, [
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            $temaValido = true;
        }

        if (is_string($idioma) && in_array($idioma, $idiomasPermitidos, true)) {
            setcookie('idioma', $idioma, [
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);

            $idiomaValido = true;
        }

        if ($idiomaValido && $temaValido) {
            $_SESSION['mensaje'] = 'Preferencias guardadas';
        } else {
            $_SESSION['mensaje'] = 'Preferencias enviadas no válidas';
        }
    } elseif ($accion === 'restablecer') {
        $tema = $_POST['tema'] ?? '';
        $idioma = $_POST['idioma'] ?? '';

        setcookie('tema', $tema, [
            'expires' => time() - 60 * 60 * 24 * 30,
            'path' => '/'
        ]);

        setcookie('idioma', $idioma, [
            'expires' => time() - 60 * 60 * 24 * 30,
            'path' => '/'
        ]);

        $_SESSION['mensaje'] = 'Preferencias restablecidas';
    }
    header('Location: preferencias.php');
    exit;
}

// Leer y validar cookie
$tema = $_COOKIE['tema'] ?? 'claro';
$idioma = $_COOKIE['idioma'] ?? 'es';

if (!is_string($tema) || !in_array($tema,  $temasPermitidos, true)) {
    $tema = 'claro';
}

if (!is_string($idioma) || !in_array($idioma, $idiomasPermitidos, true)) {
    $idioma = 'es';
}

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang="<?= $idioma ?>">

<head>
    <meta charset="UTF-8">
    <title>Preferencias</title>
    <style>
        body.claro {
            background: white;
            color: black;
        }

        body.oscuro {
            background: black;
            color: white;
        }
    </style>
</head>

<body class="<?= htmlspecialchars($tema, ENT_QUOTES,  'UTF-8') ?>">
    <form method="post">
        <input type="radio" name="tema" id="claro" value="claro" <?= $tema === 'claro' ? 'checked' : '' ?>>
        <label for="claro">Claro</label>

        <input type="radio" name="tema" id="oscuro" value="oscuro" <?= $tema === 'oscuro' ? 'checked' : '' ?>>
        <label for="oscuro">Oscuro</label>

        <label for="idioma">Idioma:</label>
        <select name="idioma" id="idioma">
            <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
            <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
        </select>

        <button type="submit" name="accion" value="guardar">Guardar</button>
        <button type="submit" name="accion" value="restablecer">Restablecer</button>
        </label>
    </form>

    <?php
    if ($mensaje !== '') : ?>
        <p><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <?php
    if ($idioma === 'en') :
    ?>
        <p>Hello, welcome!</p>
    <?php elseif ($idioma === 'es') : ?>
        <p>Hola, ¡bienvenido!</p>
    <?php endif; ?>
</body>




</html>
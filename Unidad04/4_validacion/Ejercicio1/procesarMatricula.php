<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar matrícula - Ejercicio 1</title>
</head>

<body>
    <?php
    $errores = [];

    // 1. Recuperamos los datos
    $nombreRecibido   = $_POST['nombre'] ?? '';
    $emailRecibido    = $_POST['correo'] ?? '';
    $edadRecibida     = $_POST['edad'] ?? '';
    $cursoRecibido    = $_POST['curso'] ?? '';
    $politicaRecibida = $_POST['politica'] ?? '';

    // 2. Normalizamos los datos
    $nombreTexto   = is_string($nombreRecibido) ? trim($nombreRecibido) : '';
    $emailTexto    = is_string($emailRecibido) ? trim($emailRecibido) : '';
    $edadTexto     = is_string($edadRecibida) ? trim($edadRecibida) : '';
    $cursoTexto    = is_string($cursoRecibido) ? trim($cursoRecibido) : '';
    $politicaTexto = is_string($politicaRecibida) ? trim($politicaRecibida) : '';

    // 3. Validamos los datos con filter_var
    // Nombre: solo letras, espacios, apóstrofo y guion, entre 1 y 80 caracteres
    $nombre = filter_var($nombreTexto, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => "/^[\p{L}\s'-]{1,80}$/u"]
    ]);
    if ($nombre === false) {
        $errores[] = "El nombre no puede estar vacío, tener más de 80 caracteres ni contener números o símbolos";
    }

    // Email
    $email = filter_var($emailTexto, FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        $errores[] = "El email no es válido";
    }

    // Edad: entero entre 16 y 120
    $edad = filter_var($edadTexto, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 16, 'max_range' => 120]
    ]);
    if ($edad === false) {
        $errores[] = "La edad debe ser un número entero entre 16 y 120";
    }

    // Curso: solo valores permitidos
    $curso = filter_var($cursoTexto, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => '/^(1smr|2smr|1daw|2daw)$/']
    ]);
    if ($curso === false) {
        $errores[] = "El curso no está en la lista";
    }

    // Política de privacidad: debe valer "si"
    $politica = filter_var($politicaTexto, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => '/^si$/']
    ]);
    if ($politica === false) {
        $errores[] = "Debes aceptar la política de privacidad";
    }

    // 4. Mostramos el resultado
    if (empty($errores)) {
        echo '<p>Todos los datos son válidos.</p>';
        echo '<p>Hola, ' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8')
            . ' - tu email es ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
            . ' - tu edad es ' . htmlspecialchars((string)$edad, ENT_QUOTES, 'UTF-8')
            . ' - tu curso es ' . htmlspecialchars($curso, ENT_QUOTES, 'UTF-8') . '</p>';
    } else {
        foreach ($errores as $error) {
            echo '<p>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }
    }
    ?>
    
</body>
</html>
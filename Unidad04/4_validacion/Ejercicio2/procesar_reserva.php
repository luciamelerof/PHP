<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva - Procesar formulario</title>
</head>

<body>
    <?php
    $errores = [];

    // 1. Recuperamos los datos
    $nombreRecibido = $_POST['nombre'] ?? '';
    $emailRecibido = $_POST['email'] ?? '';
    $numeroRecibido = $_POST['numeroAsistentes'] ?? '';
    $fechaRecibida = $_POST['fecha'] ?? '';
    $actividadRecibida = $_POST['actividad'] ?? '';
    $materialesRecibidos = $_POST['materiales'] ?? [];

    // 2. Normalizamos los datos
    $nombreTexto = is_string($nombreRecibido) ? trim($nombreRecibido) : '';
    $emailTexto = is_string($emailRecibido) ? trim($emailRecibido) : '';
    $numeroTexto = is_string($numeroRecibido) ? trim($numeroRecibido) : '';
    $fechaTexto = is_string($fechaRecibida) ? trim($fechaRecibida) : '';
    $actividadTexto = is_string($actividadRecibida) ? trim($actividadRecibida) : '';
    $materiales = is_array($materialesRecibidos) ? $materialesRecibidos : [];

    // 3. Validamos nombre
    $nombre = filter_var($nombreTexto, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => "/^[\p{L}\s'-]{1,80}$/u"]
    ]);

    if ($nombre === false) {
        $errores[] = "El nombre no puede estar vacío, tener más de 80 caracteres ni contener números o símbolos";
    }

    // 4. Validamos email
    $email = filter_var($emailTexto, FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        $errores[] = "El email no tiene un formato válido";
    }

    // 5. Validamos número de asistentes (entero entre 1 y 20)
    $numeroAsistentes = filter_var($numeroTexto, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 20]
    ]);

    if ($numeroAsistentes === false) {
        $errores[] = "El número de asistentes debe ser un número entero entre 1 y 20";
    }

    // 6. Validamos fecha (formato AAAA-MM-DD y no anterior a hoy)
    $fecha = DateTime::createFromFormat('Y-m-d', $fechaTexto);
    $hoy = new DateTime('today');

    if ($fecha === false || $fecha->format('Y-m-d') !== $fechaTexto) {
        $errores[] = "La fecha no es válida";
    } elseif ($fecha < $hoy) {
        $errores[] = "La fecha no puede ser anterior a hoy";
    }

    // 7. Comprobar que la actividad pertenece a las opciones permitidas.
    $actividadesPermitidas = ["charla", "taller", "visita"];

    if (!in_array($actividadTexto, $actividadesPermitidas, true)) {
        $errores[] = "La actividad seleccionada no es correcta.";
    }

    // 8. Comprobar que cada material seleccionado pertenece a la lista autorizada.
    $listaAutorizada = ["material1", "material2", "material3"];

    foreach ($materiales as $material) {
        if (!is_string($material) || !in_array($material, $listaAutorizada, true)) {
            $errores[] = "Hay un material que no está en la lista autorizada.";
            break;
        }
    }

    // 9. Mostrar todos los errores
    if (!empty($errores)) {
        echo "<p>Los errores son:</p>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
        }
        echo "</ul>";
    } else {
        // 10. Escapar todos los datos antes de mostrarlos en HTML.
        $nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $emailSeguro = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $fechaSegura = htmlspecialchars($fecha->format('d/m/Y'), ENT_QUOTES, 'UTF-8');
        $actividadSegura = htmlspecialchars($actividadTexto, ENT_QUOTES, 'UTF-8');

        echo "<p>Reserva realizada correctamente.</p>";
        echo "<ul>";
        echo "<li>Nombre: $nombreSeguro</li>";
        echo "<li>Email: $emailSeguro</li>";
        echo "<li>Asistentes: $numeroAsistentes</li>";
        echo "<li>Fecha: $fechaSegura</li>";
        echo "<li>Actividad: $actividadSegura</li>";
        echo "<li>Materiales: ";
        if (empty($materiales)) {
            echo "ninguno";
        } else {
            $materialesSeguros = [];
            foreach ($materiales as $material) {
                $materialesSeguros[] = htmlspecialchars($material, ENT_QUOTES, 'UTF-8');
            }
            echo implode(", ", $materialesSeguros);
        }
        echo "</li>";
        echo "</ul>";
    }
    ?>
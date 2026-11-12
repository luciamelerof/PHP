<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulacro 4- ejercicio 2</title>
</head>

<body>
    <?php
    function saltoLinea(): void
    {
        echo "<br>";
    }
    $usuario = ["nombre" => "Lucía", "email" => null, "edad" => 20];

    // Añadir ciudad y cambiar edad
    $usuario["ciudad"] = "Málaga";

    $usuario["edad"] = 29;

    // Mostrar por pantalla datos
    echo "<h1>Usuario</h1>";
    echo "<h2>Datos de usuario</h2>";

    foreach ($usuario as $key => $value) {
        if ($value === null) {
            echo "$key: sin datos";
            saltoLinea();
            continue;
        }

        echo "$key: $value";
        saltoLinea();
    }

    // Función con isset y array_key_exists para comprobar el estado de los campos
    function estadoCampo(array $ficha,  string $campo): string
    {
        if (isset($ficha[$campo])) {
            return "Tiene valor";
        } 
        
        if (array_key_exists($campo, $ficha)) {
            return "Existe pero es null";
        }

        return "No existe";
    }

    //isset da falso con email ya que comprueba que el campo existe y no sea nulo; email, al estar nulo,
    // mostraría "Existe pero es null", ya que es false.

    echo"<h2>Comprobar estados de los campos</h2>";
    echo "Nombre: " . estadoCampo($usuario, "nombre");
    saltoLinea();

    echo "Edad: " . estadoCampo($usuario, "edad");
    saltoLinea();

    echo "Email: " . estadoCampo($usuario, "email");
    saltoLinea();

    echo "Telefono: " . estadoCampo($usuario, "telefono");

    ?>
</body>

</html>
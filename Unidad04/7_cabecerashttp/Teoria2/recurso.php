<?php
    $existe = false;

    if(!$existe) {
        http_response_code(404);
        exit('El recurso solicitado no existe');
    }

    echo 'Aquí esta el resultado';
?>
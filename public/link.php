<?php
$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (symlink($target, $link)) {
    echo '¡Enlace simbólico creado con éxito!';
} else {
    echo 'No se pudo crear el enlace simbólico.';
}

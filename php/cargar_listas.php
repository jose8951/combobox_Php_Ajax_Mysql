<?php

include_once 'conexion.php';

if (filter_has_var(INPUT_POST, 'func')) {
    $func = filter_input(INPUT_POST, 'func');

    switch ($func) {
        case 'editar':
            $resultado = DB::editar();
            echo json_encode($resultado);
            break;

            case 'video';
            $id= filter_input(INPUT_POST,'busc');
            $resultado= DB::videos($id);
            echo json_encode($resultado);
    }
}

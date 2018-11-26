<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden'));

    $request_uri = explode('/', $_SERVER['REQUEST_URI']);

    switch ($request_uri[1]) {
        case '/' :
        case '' :
            require APP_PATH.'home.php';
        break;

        case 'employees' :
            require APP_PATH.'employees/list.php';
        break;

        case 'employee' :
            require APP_PATH.'employees/single.php';
        break;

        case 'employees_sub_type' :
            require APP_PATH.'employees/sub_types.php';
        break;

        case 'business' :
            require APP_PATH.'business/info.php';
        break;

        default:
            header('HTTP/1.1 404 Not Found.', TRUE, 404);
            echo 'Página no encontrada';
        break;
}

<?php    
    require '../vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    define('ENVIRONMENT', getenv('ENVIRONMENT'));

    switch (ENVIRONMENT) {
    
        case 'development':
            error_reporting(-1);
            ini_set('display_errors', 1);
        break;

        case 'production':
            ini_set('display_errors', 0);
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        break;

        default:
            header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
            echo 'Falta configurar el entorno de la aplicación';
        exit();
    }
    
    $application_folder = 'app';

    define('FPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
    define('APP_PATH', __DIR__.DIRECTORY_SEPARATOR.$application_folder.DIRECTORY_SEPARATOR);
    define('CONFIG_PATH', FPATH.'config'.DIRECTORY_SEPARATOR);
    define('CLASS_PATH', FPATH.'class'.DIRECTORY_SEPARATOR);
    define('THEME_PATH', FPATH.'template'.DIRECTORY_SEPARATOR);

    if (file_exists(CONFIG_PATH.'routes.php')) {
        require_once(CONFIG_PATH.'routes.php');
	} else {
        header('HTTP/1.1 404 Not Found.', TRUE, 404);
        echo 'Página no encontrada';
    }
?>

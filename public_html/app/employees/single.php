<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden')); ?>

<?php
    $request_uri = explode('/', $_SERVER['REQUEST_URI']);

    if (count($request_uri) != 3 OR $request_uri[2] == '') {
        header('HTTP/1.1 404 Not Found.', TRUE, 404);
        echo 'Página no encontrada';
        exit();
    }
    $id = $request_uri[2];

    require(CLASS_PATH.'Employees.php');

    $employees = new Employees();

    $infoEmployee = $employees->getInfo($id);

    if ((bool)$infoEmployee->rowCount()) {
        $info = $infoEmployee->fetch();
    } else {
        header('HTTP/1.1 404 Not Found.', TRUE, 404);
        echo 'Página no encontrada';
        exit();
    }


?>

<?php include(THEME_PATH.'header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nombre</label>
                        <p class="static-control"><?php echo $info->e_first_name;?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Apellido</label>
                        <p class="static-control"><?php echo $info->e_last_name;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="age">Edad</label>
                        <p class="static-control"><?php echo $info->e_age;?></p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="typeEmployee">Tipo de Empleado</label>
                        <p class="static-control"><?php echo $info->et_name;?> <span class="badge badge-secondary"><?php echo $info->est_name;?></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="business">Empresa</label>
                        <p class="static-control"><?php echo $info->b_name;?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-start mb-4">
            <div class="col-3">
                <a href="/employees" role="button" class="btn btn-dark btn-sm float-left"><i class="fas fa-arrow-alt-circle-left fa-fw"></i> Volver</a>
            </div>
        </div>
    </div>
<?php include(THEME_PATH.'footer.php'); ?>

<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden')); ?>

<?php

    require(CLASS_PATH.'Employees.php');
    require(CLASS_PATH.'Business.php');

    $employees = new Employees();
    $biz = new Business();

    $listAllEmployees = $employees->getInfo();
    $typeEmployees = $employees->typeEmployees();
    $listAllBiz = $biz->getInfo();

    $totalEmployees = $listAllEmployees->rowCount();
    $ageTotal = $employees->getInfo(NULL,TRUE);

    if($_POST) {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $employees->first_name = $_POST['firstName'];
            $employees->last_name = $_POST['lastName'];
            $employees->age = $_POST['age'];
            $employees->type_employee = $_POST['typeEmployee'];
            $employees->sub_type = $_POST['subType'];
            $employees->biz_id = $_POST['business'];


            if((bool)$employees->setData()){
                $arr = array(
                    'status' => TRUE,
                    'message' => 'Información guardada!',
                    'redirUrl' => '/employees'
                );
            } else{
                $arr = array(
                    'status' => FALSE,
                    'message' => 'Error al procesar el formulario'
                );
            }
            header('Content-type: application/json');
            echo json_encode($arr);
            exit();
        } else {
            header('HTTP/1.1 404 Not Found.', TRUE, 404);
            echo 'Página no encontrada';
            exit();
        }
    }
?>

<?php include(THEME_PATH.'header.php'); ?>
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-3">
                <button type="button" class="btn btn-info">
                    Total de Empleados <span class="badge badge-light"><?php echo $totalEmployees;?></span>
                </button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-secondary">
                    Edad Promedio <span class="badge badge-light"><?php echo number_format($ageTotal->fetch()->average, 0);?></span>
                </button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addEmployeeModal"><i class="fas fa-user-plus fa-fw"></i> Agregar Empleado</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
            <?php if ($totalEmployees > 0) { ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre y Apellido</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Empresa</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listAllEmployees->fetchAll() as $employee) { ?>
                        <tr>
                            <th scope="row"><?php echo $employee->e_id;?></th>
                            <td><?php echo $employee->e_full_name;?></td>
                            <td><?php echo $employee->et_name;?> <span class="badge badge-secondary"><?php echo $employee->est_name;?></span></td>
                            <td><?php echo $employee->e_age;?></td>
                            <td><?php echo $employee->b_name;?></td>
                            <td><a href="/employee/<?php echo $employee->e_id;?>" role="button" class="btn btn-info"><i class="fas fa-id-card fa-fw"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    No hay registros
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
<?php include(APP_PATH.'employees/modal.php');?>
<?php include(THEME_PATH.'footer.php'); ?>

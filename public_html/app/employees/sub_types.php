<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden')); ?>

<?php

    require(CLASS_PATH.'Employees.php');

    $employees = new Employees();

    if($_POST) {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $idSubTypes = $_POST['typeEmployee'];

            $listAllSubTypes = $employees->subTypeById($idSubTypes);
            $infoTypeEmployee = $employees->typeEmployees($idSubTypes);


            $arr = array(
                'status' => TRUE,
                'listSubTypes' => $listAllSubTypes,
                'questionText' => $infoTypeEmployee->fetch()->et_question_text
            );

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

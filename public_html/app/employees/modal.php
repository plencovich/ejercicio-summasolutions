<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden')); ?>
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="needs-validation" id="addEmployeeForm" action="/employees" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Alta de Empleados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Nombre</label>
                                <input type="text" class="form-control required" name="firstName" id="firstName" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Apellido</label>
                                <input type="text" class="form-control required" name="lastName" id="lastName" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label for="age">Edad</label>
                                <input type="text" class="form-control required" name="age" id="age" value="">
                            </div>
                            <div class="col-md-10 mb-3">
                                <label for="typeEmployee">Tipo de Empleado</label>
                                <select class="form-control required" name="typeEmployee" id="typeEmployee" data-ajax-url="/employees_sub_type">
                                    <option value="">Seleccionar...</option>
                                    <?php foreach ($typeEmployees->fetchAll() as $type) { ?>
                                    <option value="<?php echo $type->et_id;?>"><?php echo $type->et_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row d-none" id="subTypeDiv">
                            <div class="col-md-8 mb-3">
                                <label for="subType" id="questionTxt"></label>
                                <select class="form-control required" name="subType" id="subType">
                                    <option value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="business">Empresa</label>
                                <select class="form-control required" name="business" id="business">
                                    <?php foreach ($listAllBiz->fetchAll() as $biz) { ?>
                                    <option value="<?php echo $biz->b_id;?>"><?php echo $biz->b_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php defined('APP_PATH') or die(header('HTTP/1.0 403 Forbidden')); ?>

<?php

    $id = 1;

    require(CLASS_PATH.'Business.php');

    $employees = new Business();

    $biz = new Business();

    $result = $biz->getInfo($id);
    $info = $result->fetch();
?>

<?php include(THEME_PATH.'header.php'); ?>
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg">
                <div class="jumbotron">
                    <h1 class="display-4"><?php echo $info->b_name;?></h1>
                    <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum nostrum et sunt accusantium excepturi ut maxime reprehenderit aliquid nihil accusamus.</p>
                    <hr class="my-4">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam magni provident facilis perspiciatis animi ducimus porro, quia vel reprehenderit totam quasi aperiam amet asperiores saepe at eveniet obcaecati fugiat explicabo fugit distinctio? Atque sint ullam inventore fugit vel temporibus numquam cumque, fuga ab ut quas deleniti repellat sit beatae repudiandae quibusdam! Eaque cupiditate neque a fugiat, aspernatur quia quos earum.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-start mb-4">
            <div class="col-3">
                <a href="/" role="button" class="btn btn-dark btn-sm float-left"><i class="fas fa-arrow-alt-circle-left fa-fw"></i> Volver</a>
            </div>
        </div>
    </div>
<?php include(THEME_PATH.'footer.php'); ?>

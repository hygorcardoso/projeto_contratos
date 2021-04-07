<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/utils/FlashMessages.php');

    $errors = FlashMessages::getMessages('error');
    $infos = FlashMessages::getMessages('info');
    $sucess = FlashMessages::getMessages('sucess');
?>

<?php if(isset($errors)) : ?>
    <div class="alert alert-danger" id="mensagem">
        <ul>
            <li><?= $errors ?></li>
        </ul>
    </div>
<?php endif ?>

<?php if(isset($infos)) : ?>
    <div class="alert alert-info" id="mensagem">
        <ul>
            <li><?= $infos ?></li>
        </ul>
    </div>
<?php endif ?>

<?php if(isset($sucess)) : ?>
    <div class="alert alert-success" role="alert" id="mensagem">
        <ul>
            <li><?= $sucess?></li>    
        </ul>
    </div>
<?php endif ?>
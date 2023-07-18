<?php
/** @var $model \app\core\models\BaseModel */

use app\form\Form;

?>

<h1>Login</h1>

<?php $form = Form::begin('', 'post') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>

    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>
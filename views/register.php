<!--<form method="post">-->
<!--    <div class="mb-3">-->
<!--        <label for="exampleInputEmail1" class="form-label">Email address</label>-->
<!--        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="exampleInputPassword1" class="form-label">Password</label>-->
<!--        <input name="password" type="password" class="form-control" id="exampleInputPassword1">-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<!--</form>-->

<?php
/** @var $model \app\core\models\BaseModel */

use app\form\Form;

?>

<h1>Register</h1>

<?php $form = Form::begin('', 'post') ?>
    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'password')->passwordField() ?>

    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>
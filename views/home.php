<?php use app\core\Application; ?>

<?php if (Application::isGuest()): ?>
    <h1>Welcome Guest</h1>
<?php else: ?>
    <h1>Welcome <?= Application::$app->user->firstname ?></h1>
<?php endif; ?>

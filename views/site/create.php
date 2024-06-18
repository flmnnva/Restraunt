<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\users $model */

$this->title = 'Create users';
$this->params['breadcrumbs'][] = ['label' => 'users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

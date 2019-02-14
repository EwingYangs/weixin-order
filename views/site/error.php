<?php

use yii\helpers\Html;

$this->title = $name;

$this->context->layout = false; //不使用布局,或者改为自己所需要使用的布局

?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
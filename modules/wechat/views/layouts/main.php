<?php
use yii\helpers\Html;
use app\assets\AppAssetWechat;
use common\widgets\Alert;
/* @var $this yii\web\View */
/* @var $content string 字符串 */

AppAssetWechat::register($this);//注册
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php $this->head() ?>
</head>

<body>
    
    <?php $this->beginBody() ?>
    
    <div class="main-wrap">
        <?=$content?>
    </div>
    <!--/main-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
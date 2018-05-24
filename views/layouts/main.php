<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\PublicAsset;
use yii\helpers\Html;
use yii\helpers\Url;


PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/uploads/images/logo.jpg" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a data-toggle="dropdown" class="dropdown-toggle" href="/">Home</a>

                    </li>
                </ul>
                <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase d-flex">
                        <?php if(Yii::$app->user->isGuest): ?>
                        <li><a href="<?php echo Url::toRoute(['/auth/login']);?>">Login</a></li>
                        <li><a href="<?php echo Url::toRoute(['/auth/signup']);?>">Register</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo Url::toRoute(['/admin']);?>">Admin panel</a></li>
                            <?php echo '<li>'.Html::beginForm(['/auth/logout'], 'post')
                                . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->name . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm().'</li>';
                            ?>

                        <?php endif; ?>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>



<?php echo $content; ?>

<?php echo $this->render('/partials/footer'); ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

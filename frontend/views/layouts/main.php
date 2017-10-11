<?php


/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
    <link rel="canonical" href="<?php echo Yii::$app->request->getHostInfo() . '/' . Yii::$app->request->getPathInfo(); ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['projectName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (\frontend\components\Common::getCity()) {
        $city = '/' . \frontend\components\Common::getCity() . '/types';
    } else {
        $city = '/';
    }


    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Города', 'url' => '',  'options' => ['class' => 'citys'], 

            'items' => [['label' => 'Москва', 'url' => ['/moscow']],
                        ['label' => 'Екатеринбург', 'url' => ['/ekb']],
                        ['label' => 'Ростов-на-Дону', 'url' => ['/rostov']]],
        ],
        ['label' => 'По видам', 'url' => [$city]],
        ['label' => 'О проекте', 'url' => ['/site/about']],
        ['label' => 'Контакт', 'url' => ['/site/contact']]];
        

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Логин', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    

    <div class="menu-city">
        <a href="">Москва</a><br>
        <a href="">Екатеринбург</a><br>
        <a href="">Ростов-на-Дону</a><br>  
    </div>

    

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

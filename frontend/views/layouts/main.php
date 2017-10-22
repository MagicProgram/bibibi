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

// echo '<br><br><br><pre>';
// print_r(Yii::$app->params);
// echo '</pre>';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo  Html::encode(\frontend\components\Common::getTitle()); ?></title>
    <meta name="description" content="<?php echo  Html::encode(\frontend\components\Common::getDescription()); ?>"/>
    <meta name="keywords" content="Боевые искусства, школы боевых искусств, секции, развитие тела, каталог"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/img/favicons/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <meta name="yandex-verification" content="9db1c3e7029449ac" />
    <?= Html::csrfMetaTags() ?>
    <link rel="canonical" href="<?php echo Yii::$app->request->getHostInfo() . '/' . Yii::$app->request->getPathInfo(); ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['logo'] . Yii::$app->params['projectName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (\frontend\components\Common::getCity() && 
        array_key_exists(\frontend\components\Common::getCity(), Yii::$app->params['city'])) {
        $city = '/' . \frontend\components\Common::getCity() . '/types';
    } else {
        $city = '/moscow/types';
    }


    $menuItems = [
        // ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'По городам', 'url' => '',  'options' => ['class' => 'citys'], 

            'items' => [['label' => 'Москва', 'url' => ['/moscow']],
                        ['label' => 'Екатеринбург', 'url' => ['/ekb']],
                        ['label' => 'Ростов-на-Дону', 'url' => ['/rostov']]],
        ],
        ['label' => 'По видам', 'url' => [$city]],
        // ['label' => 'О проекте', 'url' => ['/site/about']],
        // ['label' => 'Контакт', 'url' => ['/site/contact']]
    ];
        

    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        // $menuItems[] = ['label' => 'Логин', 'url' => ['/site/login']];
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
        <p class="pull-left">&copy; Драконы <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter45839046 = new Ya.Metrika({ id:45839046, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45839046" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

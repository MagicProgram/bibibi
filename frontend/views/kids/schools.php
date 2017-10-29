<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this yii\web\View */

// print_r($this);

$currentCity = Yii::$app->params['city'][$city];

// $this->description = 'sssss';
$this->params['breadcrumbs'][] = ['label' => $currentCity, 'url' => ['/' . $city]];
$this->params['breadcrumbs'][] = 'Для детей';

// $this->params['breadcrumbs'][] = $this->title;
// $this->params['type'] = $this->title;



\frontend\components\Common::setDescription($modelCity->description);
\frontend\components\Common::setTitle($modelCity->title);

?>



<h1><?php echo Yii::$app->formatter->asNtext($modelCity->h1) ?></h1>

<div class="col-md-12"><?php echo Yii::$app->formatter->asHtml($modelCity->text) ?></div>

<hr class="xclear">

<!-- Блок с видами  -->
<?php if ($types): ?>
<div class="detail_school_types">    
    <?php foreach ($types as $type):  ?>
        
    <div class="well well-sm">
        ⭐<?= Html::a(Html::encode($type['name']), [$city . '/types/' . $type['url'] . '/for-kids'], ['class' => '']) ?></li>
    </div>

    <?php endforeach; ?>
</div>
<?php endif; ?>

<hr>

<?=$this->render("//common/listhead") ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '../site/_item',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'tag' => 'div',
        'class' => 'schools-list',
        'id' => 'schools-list',
    ],
]); ?>





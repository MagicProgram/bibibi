<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::$app->params['city'][$model->city], 'url' => ['/' . $city]];

\frontend\components\Common::setDescription($model->description, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');
\frontend\components\Common::setTitle($model->title, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');


$crumbs = [];

$typeLinks = [];
foreach ($model->types as $type) {
    $typeLinks[] = Html::a(Html::encode($type->name), [$model->city . '/types/' . $type->url]);
}

$phonesArray = explode(',', $model->phone);
$phoneLinks = [];
foreach ($phonesArray as $phonelink) {
    $phoneLinks[] = Html::a(Html::encode($phonelink), 'tel:' . $model->phone);
}

$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], array_reverse($crumbs));

$this->params['breadcrumbs'][] = $this->title;
// $this->params['category'] = $model->category;
?>
<div class="school-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-6">


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    // [
                    //     'attribute' => 'category_id',
                    //     'value' => ArrayHelper::getValue($model, 'category.name'),
                    // ],
                    'phone',
                    'address',
                    // 'timetable',
                    'email',
                    // 'price',
                    // [
                    //     'label' => 'Типы',
                    //     'value' => implode(', ', ArrayHelper::map($model->types, 'id', 'name')),
                    // ],
                ],
            ]) ?>

            <!-- Блок с видами  -->
            <?php if ($typeLinks): ?>
            <div class="detail_school_types">    
                <? foreach ($typeLinks as $type):  ?>
                    
                <div class="well well-sm">
                    ⭐<? echo $type ?>
                </div>

                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- О школе боевых искусств, описание -->
            <div class="panel panel-default detail_about">
                <div class="panel-body">
                <h2>Информация о школе</h2>
                <?php if ($model->about != ''): ?>
                    <p><?= Yii::$app->formatter->asHtml($model->about) ?></p>
                <?php else: ?>
                    <p>Описание и дополнительные данные отсутствуют.<br>
                    Чтобы заполнить данные отправьте их нам, мы добавим.</p>
                <?php endif; ?>
                </div>
            </div>
           
        </div>
        
       
        <div class="col-sm-6 detail_about">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Расписание занятий</h2>
                    <?php if ($model->timetable != ''): ?>
                        <?= Yii::$app->formatter->asHtml($model->timetable) ?>
                    <?php else: ?>

                        <p>У <?= Yii::$app->formatter->asNtext($model->name) ?> 
                        нет доступного расписания на данный момент. 
                        Чтобы узнать расписание позвоните по телефону.<br> 
                        Также вы можете отправить нам расписание и мы его добавим.<br>
                        Если вы представляете школу боевых искусств 
                        <?= Yii::$app->formatter->asNtext($model->name) ?>
                        вы можете прислать нам информацию на доступный источник описания,
                        и мы добавим всю интересующую вас информацию удобную для учеников вашей школы.
                        </p>

                    <? endif; ?>
                </div>
            </div>

        </div>


    </div>

</div>

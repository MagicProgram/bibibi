<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->params['breadcrumbs'][] = ['label' => Yii::$app->params['city'][$model->city], 'url' => ['/' . $city]];

\frontend\components\Common::setDescription($model->description, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');
\frontend\components\Common::setTitle($model->title, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');


$crumbs = [];

$typeLinks = [];
foreach ($model->types as $type) {
    $typeLinks[] = Html::a(Html::encode($type->name), [$model->city . '/types/' . $type->url]);
}

$phonesArray = explode(',', $model->phone);
$phoneLinks = '';
foreach ($phonesArray as $phonelink) {
    $phonelink = trim($phonelink);
    $phoneLinks .= Html::a(Html::encode($phonelink), 'tel:' . $phonelink);
}

$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], array_reverse($crumbs));

$this->params['breadcrumbs'][] = $model->name;
// $this->params['category'] = $model->category;
?>
<div class="school-view">

    <h1><?= Html::encode($model->name) ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row">
                        <?php if ($model->general_image != '' && file_exists(Yii::getAlias('@frontend/web' . $model->general_image))): ?>
                            <?= Html::img($model->general_image, ['class' => 'school_general_image', 'alt' => Html::encode($model->name)]) ?>
                        <?php else: ?>
                            <img src="/img/chake_not_found_image.png" alt="Чак не нашел картинку этой школы, Чак расстроен." class="school_general_image">
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-sm-7 info_box_view">
                        
                        <div class="school_address_view">
                            <?php if ($model->address != ''): ?>
                                <?= Yii::$app->params['city'][$model->city] . ',' ?>

                                <?php $address = str_replace(' ', '&nbsp;', $model->address);
                                 echo Yii::$app->formatter->asHtml($address) ?><br>(показать карту)
                            <?php endif; ?>
                        </div>
                        
                        <div class="school_phones_view">
                            <?php if ($model->phone != ''): ?>
                            <?= $phoneLinks ?>
                            <?php endif; ?>
                        </div>

                        <div class="school_age_view">
                            <?php if ($model->age == 0): ?>
                                <span class="for_adults"><?= 'Для взрослых' ?></span>
                            <?php elseif ($model->age == 1): ?>
                                <span class="for_children">
                                    <?= Html::a(Html::encode('Для детей'), ['/'. $model->city . '/for-kids']) ?>
                                </span>
                            <?php elseif ($model->age == 2): ?>
                                <span class="for_adults"><?= 'Для взрослых' ?></span>
                                <span class="for_children"><?= Html::a(Html::encode('Для детей'), ['/'. $model->city . '/for-kids']) ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="school_links_view">
                            <?php if ($model->www != ''): ?>
                                <?= $model->getParseSites(); ?>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>           
            </div>

            <div class="map_single_school">
                <div class="close_map">Закрыть &times; </div>
                <? echo $map->display(); ?>      
            </div>

            <!-- Блок с видами  -->
            <?php if ($typeLinks): ?>
            <div class="detail_school_types">    
                <?php foreach ($typeLinks as $type):  ?>
                    
                <div class="well well-sm">
                    ⭐<?php echo $type ?>
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

                    <?php endif; ?>
                </div>
            </div>

        </div>


    </div>

</div>

<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */

// print_r($this);

$this->title = 'My Yii Application';
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_item',
]); ?>





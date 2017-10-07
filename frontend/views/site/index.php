<?php

/* @var $this yii\web\View */

// print_r($this);

$this->title = 'My Yii Application';
?>

    <header>
        <a href="/"><img src="/logo.png" alt=""></a>
    </header>
   <h1>Боевые искусства в Москве</h1>
    <p class="city">
          <a href="/moscow/">Москва</a>
        <a href="/saint-petersburg/">Санкт-Петербург</a>
        <a href="/ekaterinburg/">Екатеринбург</a>
        <a href="/rostov-on-don/">Ростов-на-Дону</a>
    </p>
    <h2>Москва</h2>



<table class="info-table">
    <tr>
            <th>Название</th>
            <th>Направление</th>
            <th>Адрес</th>
            <th>Телефоны</th>
            <th>Город</th>
        </tr>
<?
    foreach($model as $row):
        // print('<pre>');
        // var_dump($row);
        // print('<pre>');
        // die;
?>
    <tr>
        <td>
        <a href=""><? print($row['name']) ?></a></td>
        <td></td>
        <td><? print($row['address']) ?></td>
        <td><? print($row['phone']) ?></td>
        <td><? print($row['city']) ?></td>
    </tr>
<?
    endforeach;


?>
</table>

<div class="center">
    <? echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages
    ]) ?>
</div>



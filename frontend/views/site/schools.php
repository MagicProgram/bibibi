<?php

use yii\widgets\ListView;

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



<?php echo $city ?>





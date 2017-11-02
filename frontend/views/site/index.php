<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

// print_r($this);

\frontend\components\Common::setDescription('Школы и секции боевых искусств по городам России. Главная страница');
\frontend\components\Common::setTitle('Школы и секции по боевым искусствам городов России');

?>
<div class="main_page">
	<div class="row">
		<div class="col-md-12">
			<h1>Школы и секции боевых искусств России</h1>
			<p>Привет, меня зовут Чак! <img class="chuck_pixel" alt="Мистер чак, толстый нунчак" src="data:image/gif;base64,R0lGODlhMAAwANUgANzu7FFJC20XCUEEAcLLygAAC+r//yckBLUPC727LyoJADYyBuccGWNrZcITDzpBQEcQBaimKrmtG7MuFb68L///ubMOCrO7ubUxFrzAv4uCFG8GAjMLAURJRCcoJOTcU////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAACAALAAAAAAwADAAAAb/QJBwSCwaj8ikcslsOp/QqHRKrVqv2Kx2y+16v0YF2KmYcIbicVgwEYjLabVQIRBA2nR8HEy31yFsChgCGHtdChCAdYuLg4ZciH6Mk49bAxYWDg51m5oODAwDY5eZnqafoaJfiAkfrq+wBwehqxCtrgsfua+ytF6sC8G5wrmyA75cB7YVBRUSHxLMFR8QByAbyFoHFLfQzrAU1seqWwca3cKwEeLZ2hGvEhLd6wMICO3u0MLP6yDj5Fw8eFjwTt0Bgf7AeGjAkCCFh+sIGDDgAUyABgQAEFggq6PEiRkCeAmQACMAAwE+JFgZ4KOBBh9EbiGZYCGAkyldBbgJIKTOnZmtambEGXMoAQ+3ZGYh6coDAaNOeR5NCrTphaEZot6c+lNLPXtOoQ7V6MEeAoBXviIo8KBt2wJw2T4oaw+tlXoM1saF+4BtXLr4quBF4OHCSQN++04EbPfugAGFDycusPhx4yyRJ+6lTFHOQoYNBHYAHdrz0M5hF5u+ifrpzYpqtLYeCnuMwNsVcSMcw/SVyJy+eQcYThwE8eNQggAAOw==">
				<br>Я собрал для вашего удобства все школы боевых искусств нескольких городов Российской Федерации по видам.
			</p>

			<ul class="main_page_cities">
			<?php foreach (Yii::$app->params['city'] as $name => $city): ?>

				<li><?= Html::a(Html::encode($city), '/' . $name) ?></li>

			<?php endforeach ?>
			</ul>
		</div>

		<div class="col-md-8">
			<h2>Также боевые искусства отсортированы по видам</h2>
			<p>Ничего такого, но школы я отсортировал по видам и еще описание присовокупил. </p>
			<h4>Смотрите какие у нас есть виды:</h4>
			<p>
			<?php foreach ($types as $type): ?>
			<?= $type->name ?>,
			<?php endforeach; ?> космический кунг-фу и они пополняются ежедневно.</p>
			
			
		</div>
		<div class="col-md-4">
			<p><img src="/img/space_kung-fu.png" title="Редкое боевое искусство, космическое боевое кунг-фу." alt="Редкое боевое искусство, космическое боевое кунг-фу." width="700"></p>
		</div>

		<div class="col-md-12">
			<p>💥 Скоро здесь появится много всего интересного</p>
		</div>

		<div class="col-md-12">
			<div class="last_products">
				<h3>Последние добавленные школы единоборств</h3>
				<? foreach ($last_schools as $school): ?>
				<div class="last_product_box">
					<a href="/<?php echo $school['city'] ?>/<?php echo $school['id'] ?>-<?php echo $school['url'] ?>" class="last_product_box_img">
						<img src="<?php echo $school['general_image'] ?>" alt="<?php echo $school['name'] ?>">
					</a>
					<a href="/<?php echo $school['city'] ?>/<?php echo $school['id'] ?>-<?php echo $school['url'] ?>" class="last_product_box_name">
						<?php echo $school['name'] ?>
					</a>
				</div>
				<? endforeach; ?>
			</div>
		</div>

	</div>
</div>








<?php
check_prolog();

/** @var array $arResult */
/** @var array $arParams */
$presenter = new \Falur\Bitrix\Support\Presenter($arResult, $arParams, __DIR__);
?>

<div id="slider" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<? foreach ($presenter->each('ITEMS') as $k => $item): ?>
		<li data-target="#slider" data-slide-to="<?= $k ?>" class="<?= $k == 0 ? 'active' : '' ?>"></li>
		<? endforeach; ?>
	</ol>

	<div class="carousel-inner" role="listbox">
		<? foreach ($presenter->each('ITEMS') as $k => $item): ?>
		<div class="item <?= $k == 0 ? 'active' : '' ?>">
			<img src="<?= $item->image('PREVIEW_PICTURE', [1900, 800]) ?>" alt="">
			<div class="carousel-caption">
                <?= $item->field('PREVIEW_TEXT') ?>
			</div>
		</div>
		<? endforeach; ?>
	</div>

	<a class="left carousel-control" href="#slider" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Назад</span>
	</a>
	
	<a class="right carousel-control" href="#slider" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Далее</span>
	</a>
</div>

<?php
check_prolog();

/** @var array $arResult */
/** @var array $arParams */
$presenter = new \Falur\Bitrix\Support\Presenter($arResult, $arParams, __DIR__);
?>

<? foreach ($presenter->each('ITEMS') as $item): ?>
<div class="row">
	<? if ($item->has('PREVIEW_PICTURE')): ?>
    <div class="col-sm-4">
        <a href="<?= $item->field('DETAIL_PAGE_URL'); ?>">
            <img src="<?= $item->image('PREVIEW_PICTURE'); ?>" class="img-responsive">
        </a>
    </div>
    <?php endif; ?>

	<div class="<?= $item->has('PREVIEW_PICTURE') ? 'col-sm-8' : 'col-sm-12'; ?>">
		<div class="h3 title" style="margin-top: 0">
            <?= $item->field('NAME'); ?>
        </div>

		<? if ($item->has('DATE_ACTIVE_FROM')): ?>
		<p class="text-muted">
			<span class="glyphicon glyphicon-time"></span>
            <?= $item->date('DATE_ACTIVE_FROM'); ?>
		</p>
		<? endif; ?>

		<p><?= strip_tags($item->field('PREVIEW_TEXT')); ?></p>

		<p class="text-muted">
			<a href="<?= $item->field('DETAIL_PAGE_URL'); ?>">Подробнее</a>
		</p>
	</div>
</div>

<hr>
<? endforeach; ?>

<?= $presenter->field('PAGINATION'); ?>
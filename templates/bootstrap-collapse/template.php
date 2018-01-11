<?php
check_prolog();

/** @var array $arResult */
/** @var array $arParams */
$presenter = new \Falur\Bitrix\Support\Presenter($arResult, $arParams, __DIR__);
?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<? foreach ($presenter->each('ITEMS') as $k => $item): ?>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="h<?= $item->field('ID'); ?>">
			<h4 class="panel-title">
				<a role="button"
                   data-toggle="collapse"
                   data-parent="#accordion"
                   href="#collapse<?= $item->field('ID'); ?>"
                   aria-expanded="true"
                   aria-controls="collapse<?= $item->field('ID'); ?>"
                >
                    <?= $item->field('NAME'); ?>
				</a>
			</h4>
		</div>
		
		<div id="collapse<?= $item->field('ID'); ?>"
             class="panel-collapse collapse <?= $k == 0 ? 'in' : '' ?>"
             role="tabpanel"
             aria-labelledby="headingOne"
        >
			<div class="panel-body">
				<?= $item->field('PREVIEW_TEXT') ?>
			</div>
		</div>
	</div>
	<? endforeach; ?>
</div>
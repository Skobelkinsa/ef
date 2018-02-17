<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); $this->setFrameMode(true);?>
<div class="ex-detail">
		<div class="img-ex-detail fl">
			<img
				class="detail_picture"
				border="0"
				src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
				width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
				height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
				alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
				title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
		</div>
		<? /*
			<div class="prew-text-ex-detail fl" style="background:url(<?=$arResult["DISPLAY_PROPERTIES"]["PRINT"]["FILE_VALUE"]["SRC"];?>) 85% bottom no-repeat;">
			<h1><?=$arResult["DISPLAY_PROPERTIES"]["TITFIN"]["DISPLAY_VALUE"];?></h1>
			<p><?echo $arResult["PREVIEW_TEXT"];?></p>
			<p><?=$arResult["DISPLAY_PROPERTIES"]["DOC"]["DISPLAY_VALUE"];?></p>
			<p><?=$arResult["DISPLAY_PROPERTIES"]["YEAR"]["DISPLAY_VALUE"];?></p>
		</div>*/?>

	<div class="detail-text-ex-detail">
		<?echo $arResult["DETAIL_TEXT"];?>
	</div>
</div>
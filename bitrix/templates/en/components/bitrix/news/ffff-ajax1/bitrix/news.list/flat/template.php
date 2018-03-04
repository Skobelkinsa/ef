<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>
<?foreach($arResult["ITEMS"] as $arItem):?>

<div class="item pr">
	<div class="img-back-ittem-news pa"  style="background: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>') top no-repeat;">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt=""></a>
	</div>
	<div class="item_splash">
		<div class="name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></div>
        <div class="category"><a href="<?= $arItem["IBLOCK_SECTION_PAGE_URL"]?>"><?echo $arItem["IBLOCK_SECTION_NAME"]?></a></div>
		<div class="description"><?echo $arItem["PREVIEW_TEXT"];?></div>
        <div class="icons">
            <span class="date"><?=$arItem['ACTIVE_FROM']?></span>
            <span class="eye">
                <i class="fa fa-eye" aria-hidden="true"></i> <?=$arItem['SHOW_COUNTER']?>
            </span>
        </div>
    </div>
    <?//printr($arItem['SHOW_COUNTER']);?>
</div>
<?endforeach;?>
    <br /><?=$arResult["NAV_STRING"]?>

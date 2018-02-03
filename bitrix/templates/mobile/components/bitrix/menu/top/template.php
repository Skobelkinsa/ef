<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="top-menu">
    <?if($arParams["SHOW_COMPLEX"]=="Y"):?>
        <li><a href="/m/komplex/"><?=GetMessage("KOMPLEX")?></a></li>
    <?endif;
    foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?endforeach?>
</ul>
<?endif?>
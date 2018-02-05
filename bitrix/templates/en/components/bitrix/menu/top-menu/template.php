<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="menu">

<?
foreach($arResult as $kay => $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
    ?>
        <?if($arItem["SELECTED"]):?>
            <li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
        <?else:?>
            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
        <?endif;
    if($kay==4)
        echo "<li class='sub-menu'><a href='#'>".GetMessage("FAQ")."</a><ul class='sub'>";
    if($kay==end($arResult))
        echo "</ul></li>";
    ?>
<?endforeach?>

</ul> 
<?endif?>
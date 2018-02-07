<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="nav-main__left">

<?
$len = count($arResult);
$i = 0;
foreach($arResult as $kay => $arItem):
	$i++;
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
		continue;
?>
	<?
	if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif;
    if($kay==4)
        echo "<li class='sub-menu'><a href='#'>".GetMessage("FAQ")."</a><ul class='sub'>";
    ?>
<?endforeach?>
</ul></li>
</ul>
<?endif?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])):
?>
	<div class="search-tags-chain" <?=$arParams["WIDTH"]?>><?
		foreach ($arResult["TAGS_CHAIN"] as $tags):
			?>
            <span class="tag-select">
            <a href="<?=$tags["TAG_PATH"]?>" rel="nofollow"><?=str_replace("%", " " , $tags["TAG_NAME"])?></a> <?
			?><a href="<?=$tags["TAG_WITHOUT"]?>" class="search-tags-link" rel="nofollow">x</a>
            </span><?
		endforeach;?>
        <?
        if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])):
            ?>
            <div class="search-tags-cloud" <?=$arParams["WIDTH"]?>><?
                foreach ($arResult["SEARCH"] as $key => $res)
                {
                    ?><a href="<?=str_replace("+", "%" , $res["URL"])?>" style="font-size: <?=$res["FONT_SIZE"]?>px;" rel="nofollow"><?=$res["NAME"]?></a> <?
                }
                ?></div>
        <?
        endif;
        ?>
	</div>
<?
endif;?>
<?
if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"]) && empty($arResult["TAGS_CHAIN"])):
?>
	<div class="search-tags-cloud" <?=$arParams["WIDTH"]?>><?
		foreach ($arResult["SEARCH"] as $key => $res)
		{
		?><a href="<?=str_replace("+", "%" , $res["URL"])?>" style="font-size: <?=$res["FONT_SIZE"]?>px;" rel="nofollow"><?=$res["NAME"]?></a> <?
		}
	?></div>
<?
endif;
?>
<?php
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

$res = CIBlock::GetByID($arParams['IBLOCK_ID']);
if($ar_res = $res->GetNext())
    $arResult['DESCRIPTION'] = $ar_res['DESCRIPTION'];
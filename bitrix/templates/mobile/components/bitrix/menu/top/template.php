<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="top-menu">
    <?if($arParams["SHOW_COMPLEX"]=="Y"):?>
        <li><a href="/m/komplex/"><?=GetMessage("KOMPLEX")?></a></li>
    <?endif;
    foreach($arResult as $kay => $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?if($kay==4)
        echo "<li class='sub-menu'><span><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" viewBox=\"0 0 129 129\" enable-background=\"new 0 0 129 129\" width=\"25\" height=\"25\" class=\"\"><g><g>
    <path d=\"m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z\" data-original=\"#000000\" class=\"active-path\" style=\"fill:#FFFFFF\" data-old_color=\"#FDD3D3\"/>
  </g></g> </svg></span><a href='#'>".GetMessage("FAQ")."</a><ul class='sub'>";

    endforeach?>
</ul></li>
    </ul>
<?endif?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);
$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
    'ID' => $strMainID,
    'PICT' => $strMainID.'_pict',
    'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
    'STICKER_ID' => $strMainID.'_sticker',
    'BIG_SLIDER_ID' => $strMainID.'_big_slider',
    'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
    'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
    'SLIDER_LIST' => $strMainID.'_slider_list',
    'SLIDER_LEFT' => $strMainID.'_slider_left',
    'SLIDER_RIGHT' => $strMainID.'_slider_right',
    'OLD_PRICE' => $strMainID.'_old_price',
    'PRICE' => $strMainID.'_price',
    'DISCOUNT_PRICE' => $strMainID.'_price_discount',
    'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
    'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
    'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
    'QUANTITY' => $strMainID.'_quantity',
    'QUANTITY_DOWN' => $strMainID.'_quant_down',
    'QUANTITY_UP' => $strMainID.'_quant_up',
    'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
    'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
    'BASIS_PRICE' => $strMainID.'_basis_price',
    'BUY_LINK' => $strMainID.'_buy_link',
    'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
    'BASKET_ACTIONS' => $strMainID.'_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
    'COMPARE_LINK' => $strMainID.'_compare_link',
    'PROP' => $strMainID.'_prop_',
    'PROP_DIV' => $strMainID.'_skudiv',
    'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
    'OFFER_GROUP' => $strMainID.'_set_group_',
    'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);

$this->addExternalJS(SITE_TEMPLATE_PATH."/js/bootstrap.tabs.min.js");
?>

<script>
    $(document).ready(function(){
        $('.prod-cl-1').click(function(){
            $(".form-prod-cl-1").fadeIn(300);

        });
        /*$(".form-prod-cl-1").mouseleave(function(){$(this).fadeOut(300);});
         $(".form-prod-cl-2").mouseleave(function(){$(this).fadeOut(300);});		*/
        $('.by-one-klick-form').on('click', '.btn-closed-form',function(){
            $('body').css('overflow', 'auto');
            $('.prod-cl-2 .black-bg').hide();
            $(".form-prod-cl-2").hide();
        });
        $('.prod-cl-2 > span').click(function(){
            $(".form-prod-cl-2").fadeIn(300);
            $('.prod-cl-2 .black-bg').show();
            $('nav.wrapper-nav').removeClass('visible');
            $('body').css('overflow', 'hidden');
        });
        $('.by-one-klick-form').submit(function(){
            $('body').css('overflow', 'auto');
            $('.prod-cl-2 .black-bg').hide();
            $(".form-prod-cl-2").hide();
        });
        //$('.bx_bigimages').height($('.bx_bigimages_imgcontainer img.prev').height());
       // $('.bx_bigimages').height('<?=$arResult['OFFERS']['0']['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['0']['HEIGHT']/2?>');

    });
    $(window).load(function() {
        $('.bx_bigimages').height($('.bx_bigimages_imgcontainer img.prev').height());
    });
</script>
<p><a class="back-link" href="<?=$arResult["LIST_PAGE_URL"]?>"><?=GetMessageJS('BACK')?></a></p>
<div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $arItemIDs['ID']; ?>">
    <?
    if ('Y' == $arParams['DISPLAY_NAME'])
    {
        ?>
        <div class="bx_item_title"><h1><span><?
                    echo (
                    isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                        ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                        : $arResult["NAME"]
                    ); ?>
</span></h1></div>
        <?
    }
    reset($arResult['MORE_PHOTO']);
    $arFirstPhoto = current($arResult['MORE_PHOTO']);
    ?>
    <div class="bx_item_container">
        <div class="bx_lt">
            <div class="bx_item_slider" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
                <div class="bx_bigimages" id="<? echo $arItemIDs['BIG_IMG_CONT_ID']; ?>">
                    <div class="bx_bigimages_imgcontainer">
						<span class="bx_bigimages_aligner" >

						<div class="mask-loading pa">
						  <div class="spinner">
							<div class="double-bounce1"></div>
							<div class="double-bounce2"></div>
						  </div>
						</div>

	<img class="prev" id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arResult['OFFERS']['0']['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['0']['SRC'] ;?>">

                            <?//if($USER->IsAdmin()) {echo "<pre>";print_r ($arResult['OFFERS']['0']['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['0'] );echo "</pre>";}?>
                            <?/*<img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">*/?>

						</span>
                        <?
                        if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
                        {
                            if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
                            {
                                if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF'])
                                {
                                    ?>
                                    <div class="bx_stick_disc right bottom" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
                                    <?
                                }
                            }
                            else
                            {
                                ?>
                                <div class="bx_stick_disc right bottom" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
                                <?
                            }
                        }
                        if ($arResult['LABEL'])
                        {
                            ?>
                            <div class="bx_stick average left top" id="<? echo $arItemIDs['STICKER_ID'] ?>" title="<? echo $arResult['LABEL_VALUE']; ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
                            <?
                        }
                        ?>
                    </div>
                </div>






                <div class="bx_slider_conteiner" id="custum-slider">
                    <div class="bx_slider_scroller_container">
                        <div class="bx_slide">


                            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.zoom.js"></script>
                            <script>
                                $(window).load(function(){

                                    $(".bx_slide li:first").addClass("bx_active");
                                    var firstUrl = $(".bx_slide li:first").attr('url-param');
                                    /*$('.my-foto').attr('src', firstUrl).attr('data-large', firstUrl);*/
                                    $('.zoomImg').attr('src', firstUrl).attr('data-large', firstUrl);
                                    $('.bx_bigimages_imgcontainer span img').attr('src', firstUrl);
                                    $(".mask-loading").remove();
                                    $('.bx_bigimages').height($('.bx_bigimages_imgcontainer img.prev').height());
                                });
                                $(document).ready(function() {

                                    //$(".bx_bigimages_aligner").zoom();

                                    var zoomcount = 0;

                                    $('.bx_bigimages_aligner').zoom({
                                        url: $('.bx_bigimages_aligner img:first').attr('data-large'),
                                        magnify: 1.1,
                                        onZoomIn: function(){
                                            if(zoomcount == 0)
                                            {
                                                var firstUrl = $(".bx_slide li:first").attr('url-param');
                                                $('.zoomImg').attr('src', firstUrl);
                                                zoomcount++;
                                            }

                                        }
                                    });


                                    $(".bx_size li").click(function(e) {
                                        console.log($(this).index());
                                        var numGal = $(this).index();

                                        $('.bx_slider_conteiner-custum').fadeOut(0);
                                        $('.bxscc-'+numGal).fadeIn(0);

                                        var firstUrl = $('.bxscc-'+numGal+' li:first').attr('url-param');
                                        console.log(firstUrl);
                                        $('.bx_bigimages_imgcontainer span img').attr('src', firstUrl);
                                        $(".bx_slide li").removeClass("bx_active");

                                        $('.my-foto').attr('src', firstUrl).attr('data-large', firstUrl);
                                        $('.zoomImg').attr('src', firstUrl).attr('data-large', firstUrl);
                                        $('.bxscc-'+numGal+' li:first').addClass("bx_active");
                                    });

                                    $(".bx_slide li").click(function(e) {
                                        $(".bx_slide li").removeClass("bx_active");
                                        $(this).addClass("bx_active");
                                        var imageUrl = $(this).attr('url-param');
                                        $('.bx_bigimages_aligner img').attr('src', imageUrl).attr('data-large', imageUrl);
                                        $('.zoomImg').attr('src', imageUrl).attr('data-large', imageUrl);
                                    });
                                });
                            </script>

                            <?/*
		foreach ($arResult['OFFERS']['0']['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] as $srcmoreph)
		{
?>
	<li data-value="<? echo $srcmoreph['ID']; ?>" style="width: 100%; padding-top: 100%;" url-param="<? echo $srcmoreph['SRC']; ?>";><span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $srcmoreph['SRC']; ?>');"></span></span></li>
<?} */?>

                            <?
                            $custCount = 0;
                            foreach ($arResult['OFFERS'] as $offerimage) {
                                if($custCount > 0) {$custstyle = 'display: none';} else {$custstyle = 'display: block';}
                                ?>
                                <div class="bx_slider_conteiner-custum bxscc-<?=$custCount;?>" style="<?= $custstyle;?>;">
                                    <ul style="width: 20%" id="cust-st-param">

                                        <?foreach ($offerimage['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] as $offerimagevalue) {?>

                                            <li data-value="<? echo $offerimagevalue['ID']; ?>" style="width: 100%; padding-top: 100%;" url-param="<?= $offerimagevalue['SRC']; ?>";><span class="cnt"><span class="cnt_item" style="background-image:url('<?= $offerimagevalue['SRC']; ?>');"><img
                                                                src="<?= $offerimagevalue['SRC']; ?>" alt=""></span></span></li>

                                        <?}?>

                                    </ul>
                                </div>
                                <?
                                $custCount++;
                            }	?>

                        </div>
                    </div>

                </div>




                <?
                if ($arResult['SHOW_SLIDER'])
                {
                    if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
                        //if ($arResult['SHOW_SLIDER'])
                    {
                        if (5 < $arResult['MORE_PHOTO_COUNT'])
                        {
                            $strClass = 'bx_slider_conteiner full';
                            $strOneWidth = (100/$arResult['MORE_PHOTO_COUNT']).'%';
                            $strWidth = (20*$arResult['MORE_PHOTO_COUNT']).'%';
                            // $strSlideStyle = '';
                            $strSlideStyle = 'display: none;';
                        }
                        else
                        {
                            $strClass = 'bx_slider_conteiner';
                            $strOneWidth = '20%';
                            $strWidth = '100%';
                            $strSlideStyle = 'display: none;';
                        }
                        ?>
                        <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_ID']; ?>">
                            <div class="bx_slider_scroller_container">
                                <div class="bx_slide">


                                    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.zoom.js"></script>
                                    <script>
                                        jQuery(function(){

                                        });
                                        $(document).ready(function() {

                                            //$(".bx_bigimages_aligner").zoom();

                                            $('.bx_bigimages_aligner').zoom({
                                                url: $(".bx_slide li:first").attr('url-param'),
                                                magnify: 1.1,
                                                callback: function(){
                                                    $('.zoomImg').attr('src', firstUrl).attr('data-large', $(".bx_slide li:first").attr('url-param'));
                                                }

                                            });

                                            $(".bx_size li").click(function() {
                                                $(".bx_slide li:first").addClass("bx_active");
                                                var firstUrl = $(".bx_slide li:first").attr('url-param');
                                                $('.my-foto').attr('src', firstUrl).attr('data-large', firstUrl);
                                                $('.zoomImg').attr('src', firstUrl).attr('data-large', firstUrl);
                                            });

                                            $(".bx_slide li:first").addClass("bx_active");
                                            var firstUrl = $(".bx_slide li:first").attr('url-param');
                                            $('.my-foto').attr('src', firstUrl).attr('data-large', firstUrl);
                                            $('.zoomImg').attr('src', firstUrl).attr('data-large', firstUrl);

                                            $(".bx_slide li").click(function(e) {
                                                $(".bx_slide li").removeClass("bx_active");
                                                $(this).addClass("bx_active");
                                                var imageUrl = $(this).attr('url-param');
                                                $('.my-foto').attr('src', imageUrl).attr('data-large', imageUrl);
                                                $('.zoomImg').attr('src', imageUrl).attr('data-large', imageUrl);
                                            });
                                        });
                                    </script>
                                    <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST']; ?>">
                                        <?
                                        foreach ($arResult['OFFERS']['0']['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] as $srcmoreph)
                                        {
                                            ?>
                                            <li data-value="<? echo $srcmoreph['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;" url-param="<? echo $srcmoreph['SRC']; ?>";><span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $srcmoreph['SRC']; ?>');"></span></span></li>
                                        <?}?>

                                    </ul>








                                </div>
                                <div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                                <div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                            </div>
                        </div>
                        <?
                    }
                    else
                    {
                        foreach ($arResult['OFFERS'] as $key => $arOneOffer)
                        {
                            if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
                                continue;
                            $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
                            if (5 < $arOneOffer['MORE_PHOTO_COUNT'])
                            {
                                $strClass = 'bx_slider_conteiner full';
                                $strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
                                $strWidth = (20*$arOneOffer['MORE_PHOTO_COUNT']).'%';
                                // $strSlideStyle = '';
                                $strSlideStyle = 'display: none;';
                            }
                            else
                            {
                                $strClass = 'bx_slider_conteiner';
                                $strOneWidth = '20%';
                                $strWidth = '100%';
                                $strSlideStyle = 'display: none;';
                            }
                            ?>
                            <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
                                <div class="bx_slider_scroller_container">
                                    <div class="bx_slide">


                                        <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>">
                                            <?
                                            foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto)
                                            {
                                                ?>
                                                <li data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>"><span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
                                                <?
                                            }
                                            unset($arOnePhoto);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                    <div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                </div>
                            </div>
                            <?
                        }
                    }
                }
                ?>
            </div>
            <div class="bx_lb">
                <div class="tac ovh">
                </div>
                <div class="tab-section-container">
                    <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
                    <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,whatsapp"></div>
                    <?
                    if ('Y' == $arParams['USE_COMMENTS'])
                    {
                        ?>
                        <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.comments",
                        "detail",
                        array(
                            "ELEMENT_ID" => $arResult['ID'],
                            "ELEMENT_CODE" => "",
                            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                            "SHOW_DEACTIVATED" => $arParams['SHOW_DEACTIVATED'],
                            "URL_TO_COMMENT" => "",
                            "WIDTH" => "",
                            "COMMENTS_COUNT" => "5",
                            "BLOG_USE" => $arParams['BLOG_USE'],
                            "FB_USE" => $arParams['FB_USE'],
                            "FB_APP_ID" => $arParams['FB_APP_ID'],
                            "VK_USE" => $arParams['VK_USE'],
                            "VK_API_ID" => $arParams['VK_API_ID'],
                            "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                            "CACHE_TIME" => $arParams['CACHE_TIME'],
                            'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                            "BLOG_TITLE" => "",
                            "BLOG_URL" => $arParams['BLOG_URL'],
                            "PATH_TO_SMILE" => "",
                            "EMAIL_NOTIFY" => $arParams['BLOG_EMAIL_NOTIFY'],
                            "AJAX_POST" => "Y",
                            "SHOW_SPAM" => "Y",
                            "SHOW_RATING" => "N",
                            "FB_TITLE" => "",
                            "FB_USER_ADMIN_ID" => "",
                            "FB_COLORSCHEME" => "light",
                            "FB_ORDER_BY" => "reverse_time",
                            "VK_TITLE" => "",
                            "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME']
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );?>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="bx_rt">
            <?
            $useBrands = ('Y' == $arParams['BRAND_USE']);
            $useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
            if ($useBrands || $useVoteRating)
            {
                ?>
                <div class="bx_optionblock">
                    <?
                    if ($useVoteRating)
                    {
                        ?><?$APPLICATION->IncludeComponent(
                        "bitrix:iblock.vote",
                        "stars",
                        array(
                            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                            "ELEMENT_ID" => $arResult['ID'],
                            "ELEMENT_CODE" => "",
                            "MAX_VOTE" => "5",
                            "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                            "SET_STATUS_404" => "N",
                            "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                            "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                            "CACHE_TIME" => $arParams['CACHE_TIME']
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );?><?
                    }
                    if ($useBrands)
                    {
                        ?><?$APPLICATION->IncludeComponent("bitrix:catalog.brandblock", ".default", array(
                        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                        "ELEMENT_ID" => $arResult['ID'],
                        "ELEMENT_CODE" => "",
                        "PROP_CODE" => $arParams['BRAND_PROP_CODE'],
                        "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                        "CACHE_TIME" => $arParams['CACHE_TIME'],
                        "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                        "WIDTH" => "",
                        "HEIGHT" => ""
                    ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );?><?
                    }
                    ?>
                </div>
                <?
            }
            unset($useVoteRating, $useBrands);
            ?>

            <div class="item_title_product">
                <div class="name-product ibws">
                    <div class="name-product fl"><? $APPLICATION->ShowTitle(false) ?></div>
                    <?if ($arResult['PROPERTIES']['NEWPRODUCT']['VALUE'] == 'да'):?>
                        <div class="new-product-block fl"></div>
                        <div style="clear: both;"></div>
                    <?endif;?>
                </div>

                <div class="ibws section-block">
                    <?php  $db_old_groups = CIBlockElement::GetElementGroups($arResult['ID'], false);
                    while($ar_group = $db_old_groups->Fetch()) {   ?>
                        <?if ($ar_group["NAME"] != 'Sale'):?>
                            <a href="<?echo $ar_group["SECTION_PAGE_URL"]; echo $ar_group["CODE"];?>/"><?= $ar_group["NAME"];?></a>
                        <?endif;?>
                    <?}?>
                </div>

                <div class="ibws">
                    <div class="top-title-text-tovar"><? echo $arResult['PREVIEW_TEXT']; ?></div>
                </div>

            </div>

            <div class="item_price ibws">

                <?
                $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                ?>



                <div class="item_current_price" id="<? echo $arItemIDs['PRICE']; ?>">
                    <? echo $minPrice['PRINT_DISCOUNT_VALUE']; ?>
                </div>
                <?if ($arParams['SHOW_OLD_PRICE'] == 'Y'){ ?>
                    <div class="item_old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>">
                        <? echo($boolDiscountShow ? $minPrice['PRINT_VALUE'] : ''); ?>
                    </div>
                <?}?>
                <?/*if ($arParams['SHOW_OLD_PRICE'] == 'Y'){?>
                    <div class="item_economy_price" id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>" style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow ? GetMessage('CT_BCE_CATALOG_ECONOMY_INFO', array('#ECONOMY#' => $minPrice['PRINT_DISCOUNT_DIFF'])) : ''); ?></div>
                <?}*/?>

                <div class="sale-rec pr ttm"><? echo $MESS['MESS_BTN_COMPARE'];?> при покупке БОЛЕЕ двух упаковок </div>

            </div>
            <?
            unset($minPrice);
           /* if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
            {
                ?>
                <div class="item_info_section">
                    <?
                    if (!empty($arResult['DISPLAY_PROPERTIES']))
                    {
                        ?>
                        <dl>
                            <?
                            foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp)
                            {
                                ?>
                                <dt><? echo $arOneProp['NAME']; ?></dt><dd><?
                                echo (
                                is_array($arOneProp['DISPLAY_VALUE'])
                                    ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                                    : $arOneProp['DISPLAY_VALUE']
                                ); ?></dd><?
                            }
                            unset($arOneProp);
                            ?>
                        </dl>
                        <?
                    }

                    if ($arResult['SHOW_OFFERS_PROPS'])
                    {
                        ?>
                        <dl id="<? echo $arItemIDs['DISPLAY_PROP_DIV'] ?>"></dl>
                        <?
                    }
                    ?>
                </div>



                <?
            }*/
            if ('' != $arResult['PREVIEW_TEXT'])
            {
                if (
                    'S' == $arParams['DISPLAY_PREVIEW_TEXT_MODE']
                    || ('E' == $arParams['DISPLAY_PREVIEW_TEXT_MODE'] && '' == $arResult['DETAIL_TEXT'])
                )
                {
                    ?>
                    <div class="item_info_section">
                        <?
                        echo ('html' == $arResult['PREVIEW_TEXT_TYPE'] ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>');
                        ?>
                    </div>
                    <?
                }
            }
            if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP']))
            {
                $arSkuProps = array();
                ?>
                <div class="item_info_section" style="padding-right:150px;" id="<? echo $arItemIDs['PROP_DIV']; ?>">
                    <?
                    foreach ($arResult['SKU_PROPS'] as &$arProp)
                    {
                        if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
                            continue;
                        $arSkuProps[] = array(
                            'ID' => $arProp['ID'],
                            'SHOW_MODE' => $arProp['SHOW_MODE'],
                            'VALUES_COUNT' => $arProp['VALUES_COUNT']
                        );
                        if ('TEXT' == $arProp['SHOW_MODE'])
                        {
                            if (5 < $arProp['VALUES_COUNT'])
                            {
                                $strClass = 'bx_item_detail_size full';
                                $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                                $strWidth = (20*$arProp['VALUES_COUNT']).'%';
                                $strSlideStyle = '';
                            }
                            else
                            {
                                $strClass = 'bx_item_detail_size';
                                $strOneWidth = '20%';
                                $strWidth = '100%';
                                $strSlideStyle = 'display: none;';
                            }
                            ?>
                            <div class="ibws">
                                <div class="<? echo $strClass; ?> ibws" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
                                    <span class="doz-prop fl"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
                                    <div class="bx_size_scroller_container fl"><div class="bx_size">
                                            <ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                                <?
                                                foreach ($arProp['VALUES'] as $arOneValue)
                                                {
                                                    $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                    ?>
                                                    <li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>" data-onevalue="<? echo $arOneValue['ID']; ?>" style="width: <? echo $strOneWidth; ?>; display: none;">
                                                        <i title="<? echo $arOneValue['NAME']; ?>"></i><span class="cnt" title="<? echo $arOneValue['NAME']; ?>"><? echo $arOneValue['NAME']; ?></span></li>
                                                    <?
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                        <div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                            <?
                        }
                        elseif ('PICT' == $arProp['SHOW_MODE'])
                        {
                            if (5 < $arProp['VALUES_COUNT'])
                            {
                                $strClass = 'bx_item_detail_scu full';
                                $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                                $strWidth = (20*$arProp['VALUES_COUNT']).'%';
                                $strSlideStyle = '';
                            }
                            else
                            {
                                $strClass = 'bx_item_detail_scu';
                                $strOneWidth = '20%';
                                $strWidth = '100%';
                                $strSlideStyle = 'display: none;';
                            }
                            ?>
                            <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
                                <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
                                <div class="bx_scu_scroller_container"><div class="bx_scu">
                                        <ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                            <?
                                            foreach ($arProp['VALUES'] as $arOneValue)
                                            {
                                                $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                ?>
                                                <li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>; display: none;" >
                                                    <i title="<? echo $arOneValue['NAME']; ?>"></i>
                                                    <span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');" title="<? echo $arOneValue['NAME']; ?>"></span></span></li>
                                                <?
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                    <div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                </div>
                            </div>
                            <?
                        }
                    }
                    unset($arProp);
                    ?>
                </div>
                <?
            }
            ?>
            <div class="item_info_section" >
                <?
                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                {
                    $canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
                }
                else
                {
                    $canBuy = $arResult['CAN_BUY'];
                }
                $buyBtnMessage = ($arParams['MESS_BTN_BUY'] != '' ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_BUY'));
                $addToBasketBtnMessage = ($arParams['MESS_BTN_ADD_TO_BASKET'] != '' ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCE_CATALOG_ADD'));
                $notAvailableMessage = ($arParams['MESS_NOT_AVAILABLE'] != '' ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
                $showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
                $showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);

                $showSubscribeBtn = false;
                $compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCE_CATALOG_COMPARE'));

                if ($arParams['USE_PRODUCT_QUANTITY'] == 'Y')
                {
                    if ($arParams['SHOW_BASIS_PRICE'] == 'Y')
                    {
                        $basisPriceInfo = array(
                            '#PRICE#' => $arResult['MIN_BASIS_PRICE']['PRINT_DISCOUNT_VALUE'],
                            '#MEASURE#' => (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : '')
                        );

                        // цена за 1 банку
                        ?>
                        <p id="<? echo $arItemIDs['BASIS_PRICE']; ?>" class="item_section_name_gray d777 dn" style="display:none;"><?// echo GetMessage('CT_BCE_CATALOG_MESS_BASIS_PRICE', $basisPriceInfo); ?></p>
                        <?
                    }
                    ?>
                    <span class="col-v fl"><? echo GetMessage('CATALOG_QUANTITY'); ?></span>
                    <div class="item_buttons vam">
		<span class="item_buttons_counter_block">
			<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</a>
			<input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
                ? 1
                : $arResult['CATALOG_MEASURE_RATIO']
            ); ?>">
			<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</a>
            <script>
                 $(document).ready(function(){
                    $('body').on('click', "#<? echo $arItemIDs['QUANTITY_DOWN']; ?>, #<? echo $arItemIDs['QUANTITY_UP']; ?>", function(){
                     if ($('#<? echo $arItemIDs['QUANTITY']; ?>').val() >= 2){
                         $('#<? echo $arItemIDs['QUANTITY']; ?>').addClass('red');
                         $('.sale-rec').addClass('open');
                     }else{
                         $('#<? echo $arItemIDs['QUANTITY']; ?>').removeClass('red');
                        $('.sale-rec').removeClass('open');
                     }
                    });
                 });
            </script>
            <?/*
			<span class="bx_cnt_desc" id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><? echo (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : ''); ?></span>
			*/?>


		</span>
                        <span class="item_buttons_counter_block" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" style="display: <? echo ($canBuy ? '' : 'none'); ?>;">
<?
if ($showBuyBtn)
{
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
    <?
}
if ($showAddBtn)
{
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>"><span></span><? echo $addToBasketBtnMessage; ?></a>
    <a class="action-cart" href="/personal/cart/"><?=GetMessage('CT_BCT_ACTION_CART')?></a>
    <?
}
?>
		</span>
                        <span id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_notavailable" style="display: <? echo (!$canBuy ? '' : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
                        <?
                        if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn)
                        {
                            ?>
                            <span class="item_buttons_counter_block">
<?
if ($arParams['DISPLAY_COMPARE'])
{
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arItemIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
    <?
}
if ($showSubscribeBtn)
{

}
?>
		</span>
                            <?
                        }
                        ?>
                    </div>
                    <?
                    if ('Y' == $arParams['SHOW_MAX_QUANTITY'])
                    {
                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                        {
                            ?>
                            <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>" style="display: none;"><? echo GetMessage('OSTATOK'); ?>: <span></span></p>
                            <?
                        }
                        else
                        {
                            if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO'])
                            {
                                ?>
                                <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>"><? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span></p>
                                <?
                            }
                        }
                    }
                }
                else
                {
                    ?>
                    <div class="item_buttons vam">
		<span class="item_buttons_counter_block" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" style="display: <? echo ($canBuy ? '' : 'none'); ?>;">
<?
if ($showBuyBtn)
{
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
    <?
}
if ($showAddBtn)
{
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>"><span></span><? echo $addToBasketBtnMessage; ?></a>

    <?
}
?>
		</span>
                        <span id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_notavailable" style="display: <? echo (!$canBuy ? '' : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
                        <?
                        if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn)
                        {
                            ?>
                            <span class="item_buttons_counter_block">
	<?
    if ($arParams['DISPLAY_COMPARE'])
    {
        ?>
        <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arItemIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
        <?
    }
    if ($showSubscribeBtn)
    {

    }
    ?>
		</span>
                            <?
                        }
                        ?>
                    </div>
                    <?
                }
                unset($showAddBtn, $showBuyBtn);
                ?>
            </div>


            <div class="free-deliv-detail ttm">

                <div class="ibws text">
                    <img src="/bitrix/templates/mobile/img/prod_dev.svg" width="60" alt="">
                    <span>Бесплатная <br>доставка от 3000 ₽</span>
                </div>

                <div class="ibws text">
                    <img src="/bitrix/templates/mobile/img/prod_orig.svg" width="60" alt="">
                    <span>Только оригинальная <br>продукция</span>
                </div>

                <div class="ibws text">

                    <img src="/bitrix/templates/mobile/img/prod_pay.svg" width="60" alt="">
                    <span>Оплата <br>при получении</span>
                </div>

            </div>

            <? if( !isset($_GET["r1"]) && $_GET["r1"] != "yandext"): ?>
                <div class="ibws">
                    <div class="by-one-klick prod-cl-2">  <span>Купить в 1 клик</span>
                        <div class="black-bg" style="display:none"></div>
                        <div class="pr">
                            <form action="<?=SITE_TEMPLATE_PATH?>/mail.php" class="by-one-klick-form contact-form form-prod-cl-2">
                                <div class="btn-closed-form"></div>
                                <?=bitrix_sessid_post()?>
                                <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/utm_inputs.php", array(), array("SHOW_BORDER" => false, "MODE" => "php")); ?>
                                <input type="hidden" name="formname" value="Купить в 1 клик ">
                                <input type="hidden" name="tovarname" value="<?=$arResult['NAME'];?>">
                                <input type="hidden" placeholder="Ваше имя" type="text" name="name" required="" value="Форма Купить в 1 клик">
                                <input type="hidden" name="campaign" class="campaign" value="<?php echo isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : '' ;?>" />
                                <input type="hidden" name="term" class="term" value="<?php echo isset($_GET['utm_term']) ? $_GET['utm_term'] : '' ;?>" />
                                <input type="hidden" name="placement" class="placement" value="<?php echo isset($_GET['pm_placement']) ? htmlspecialchars($_GET['pm_placement']) : '' ;?>" />
                                <p>Ваш телефон</p>
                                <input placeholder="+7" type="text" name="phone" required="">
                                <input class="button_send tac" type="submit" placeholder="Купить в 1 клик" value="Купить в 1 клик">
                                <div class="ibws">
                                    <div class="operator-text">
                                        <p>Оператор позвонит Вам <br>для уточнения деталей заказа</p>
                                        <select class="input_m_f input_choose ibws" name="timeout">
                                            <option selected value="в течении дня до 21.00">в течении дня до 21.00</option>
                                            <option value="завтра утром после 9:00">завтра утром после 9:00</option>
                                            <option value="завтра днем после 14:00">завтра днем после 14:00</option>
                                            <option value="завтра вечером после 18:00">завтра вечером после 18:00</option> </select>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>



            <div class="bx_rb">
                <div class="item_info_section">
                    <?php if($arResult['PROPERTIES']['SOSTAV']['VALUE'] != '' || $arResult['DETAIL_TEXT'] != '' || $arResult['PROPERTIES']['INSTRUCTION']['VALUE'] != ''){?>
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            if('' != $arResult['DETAIL_TEXT']) {?>
                                <li role="presentation" class="active"><a href="#full_description" aria-controls="full_description" role="tab" data-toggle="tab"><? echo GetMessage('FULL_DESCRIPTION'); ?></a></li>
                                <?
                            }
                            if($arResult['PROPERTIES']['SOSTAV']['VALUE'] != '') {?>
                                <li role="presentation"><a href="#sostav" aria-controls="full_description" role="tab" data-toggle="tab">Состав</a></li>
                                <?php
                            }
                            if($arResult['PROPERTIES']['INSTRUCTION']['VALUE'] != '') { ?>
                                <li role="presentation"><a href="#instruction" aria-controls="instruction" role="tab" data-toggle="tab">Инструкция</a></li>
                                <?php
                            }?>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="full_description">
                                <?

                                if ('html' == $arResult['DETAIL_TEXT_TYPE'])
                                {
                                    echo $arResult['DETAIL_TEXT'];
                                }
                                else
                                {
                                    ?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
                                }

                                ?>
                            </div>
                            <?php if($arResult['PROPERTIES']['SOSTAV']['VALUE'] != '') {?>
                                <div role="tabpanel" class="tab-pane" id="sostav">
                                    <?
                                    //printr($arResult['PROPERTIES']['SOSTAV']['VALUE']);
                                    if ($arResult['PROPERTIES']['SOSTAV']['VALUE']['TYPE'] == 'HTML')
                                    {
                                        echo htmlspecialcharsBack($arResult['PROPERTIES']['SOSTAV']['VALUE']['TEXT']);
                                    }
                                    else
                                    {
                                        ?><p><? echo $arResult['PROPERTIES']['SOSTAV']['VALUE']['TEXT']; ?></p><?
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if($arResult['PROPERTIES']['INSTRUCTION']['VALUE'] != '') {?>
                                <div role="tabpanel" class="tab-pane" id="instruction">
                                    <?php
                                    if ($arResult['PROPERTIES']['INSTRUCTION']['VALUE']['TYPE'] == 'html')
                                    {
                                        echo htmlspecialcharsBack($arResult['PROPERTIES']['INSTRUCTION']['VALUE']['TEXT']);
                                    }
                                    else
                                    {
                                        ?><p><? echo $arResult['PROPERTIES']['INSTRUCTION']['VALUE']['TEXT']; ?></p><?
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?/*
<div class="by-one-klick ibws lowprice-form prod-cl-1">  Нашли дешевле?

<div class="pr">
	<form action="<?=SITE_TEMPLATE_PATH?>/mail.php" class="by-one-klick-form contact-form form-prod-cl-1">
			<?=bitrix_sessid_post()?>
			<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/utm_inputs.php", array(), array("SHOW_BORDER" => false, "MODE" => "php")); ?>
			<input type="hidden" name="formname" value="Нашли дешевле?">
			<input type="hidden" name="tovarname" value="<?=$arResult['NAME'];?>">
			<input placeholder="Ссылка" type="text" name="link" required="">
			<input placeholder="Ваше имя" type="text" name="name" required="">
			<input placeholder="+7" type="text" name="phone" required="">
			<input class="button_send tac" type="submit" placeholder="Нашли дешевле?" value=" Нашли дешевле?">
			<div class="ibws"><div class="operator-text">ЗАПОЛНИТЕ ФОРМУ И НАШ МЕНЕДЖЕР СВЯЖЕТСЯ С ВАМИ</div></div>
	</form>
</div>
</div>  */?>

                </div>
            </div>
            <div class="clb"></div>
        </div>

        <div class="bx_md">
            <div class="item_info_section">
                <?
                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                {
                    if ($arResult['OFFER_GROUP'])
                    {
                        foreach ($arResult['OFFER_GROUP_VALUES'] as $offerID)
                        {
                            ?>
                            <span id="<? echo $arItemIDs['OFFER_GROUP'].$offerID; ?>" style="display: none;">
<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
    ".default",
    array(
        "IBLOCK_ID" => $arResult["OFFERS_IBLOCK"],
        "ELEMENT_ID" => $offerID,
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "BASKET_URL" => $arParams["BASKET_URL"],
        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME'],
        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
        "CURRENCY_ID" => $arParams["CURRENCY_ID"]
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);?><?
?>
	</span>
                            <?
                        }
                    }
                }
                else
                {
                    if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP'])
                    {
                        ?><?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
                        ".default",
                        array(
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_ID" => $arResult["ID"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME'],
                            "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                            "CURRENCY_ID" => $arParams["CURRENCY_ID"]
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );?><?
                    }
                }
                ?>
            </div>
        </div>


        <div style="clear: both;"></div>
    </div>
    <div class="clb"></div>
</div><?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
    foreach ($arResult['JS_OFFERS'] as &$arOneJS)
    {
        if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
        {
            $arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
            $arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
        $strProps = '';
        if ($arResult['SHOW_OFFERS_PROPS'])
        {
            if (!empty($arOneJS['DISPLAY_PROPERTIES']))
            {
                foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp)
                {
                    $strProps .= '<dt>'.$arOneProp['NAME'] . ': ' .'</dt><dd>'.(
                        is_array($arOneProp['VALUE'])
                            ? implode(' / ', $arOneProp['VALUE'])
                            : $arOneProp['VALUE']
                        ).'</dd>';
                }
            }
        }
        $arOneJS['DISPLAY_PROPERTIES'] = $strProps;
    }
    if (isset($arOneJS))
        unset($arOneJS);
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE' => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y')
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
        ),
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'NAME' => $arResult['~NAME']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $arSkuProps
    );
    if ($arParams['DISPLAY_COMPARE'])
    {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH' => $arParams['COMPARE_PATH']
        );
    }
}
else
{
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
    {
        ?>
        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
            {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
                {
                    ?>
                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                    <?
                    if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                }
            }
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties)
            {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo)
                    {
                        ?>
                        <tr><td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                            <td>
                                <?
                                if(
                                    'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                    && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                                )
                                {
                                    foreach($propInfo['VALUES'] as $valueID => $value)
                                    {
                                        ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
                                    }
                                }
                                else
                                {
                                    ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                    foreach($propInfo['VALUES'] as $valueID => $value)
                                    {
                                        ?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
                                    }
                                    ?></select><?
                                }
                                ?>
                            </td></tr>
                        <?
                    }
                    ?>
                </table>
                <?
            }
            ?>
        </div>
        <?
    }
    if ($arResult['MIN_PRICE']['DISCOUNT_VALUE'] != $arResult['MIN_PRICE']['VALUE'])
    {
        $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        $arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
    }
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE' => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y')
        ),
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'PICT' => $arFirstPhoto,
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'PRICE' => $arResult['MIN_PRICE'],
            'BASIS_PRICE' => $arResult['MIN_BASIS_PRICE'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
        ),
        'BASKET' => array(
            'ADD_PROPS' => ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'),
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    if ($arParams['DISPLAY_COMPARE'])
    {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH' => $arParams['COMPARE_PATH']
        );
    }
    unset($emptyProductProperties);
}
?>
<script type="text/javascript">
    var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
    BX.message({
        ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
        BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
        TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
        TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
        BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
        BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
        BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
        BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
        TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
        COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
        COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
        COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
        BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
        SITE_ID: '<? echo SITE_ID; ?>'
    });
</script>
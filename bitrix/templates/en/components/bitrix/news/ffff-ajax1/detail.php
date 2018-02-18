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
?>
<div id="new-ajax-list" class="bx-newslist posts_block">
    <?
    $arParams["FILTER_NAME"] = "arFilter";
    if(isset($arResult['VARIABLES']['SECTION_CODE'])):
        $arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'CODE'=>$arResult['VARIABLES']['SECTION_CODE']);
        $db_list = CIBlockSection::GetList(Array(), $arFilter, true);
        if($arSection = $db_list->GetNext()){
            $arSelectSection = $arSection['ID'];
            $GLOBALS['arFilter'] = array(
                'SECTION_ID' => $arSection['ID']
            );
        }
    endif;
    if(isset($_GET['tags'])):
        $GLOBALS['arFilter'] = array(
            'TAGS' => '%'.$_GET["tags"].'%'
        );
    endif;
    if(isset($_GET['sort'])):
        $arParams["SORT_ORDER1"] = "DESC";
        if($_GET['sort']=='popular'):
            $arParams["SORT_BY1"] = "SHOW_COUNTER";
        elseif($_GET['sort']=='new'):
            $arParams["SORT_BY1"] = "DATE_CREATE";
        else:
            $arParams["SORT_BY1"] = "SORT";
        endif;
    endif;
    ?>
    <div class="blog">
        <div class="blog_filter">
            <div class="scroll-block">
                <div class="blog_filter-sort">
                    <a href="?sort=all"<?if($_GET['sort']=='all' || !isset($_GET['sort'])):?> class="select"<?endif;?>><?=GetMessage('SORT_ALL')?></a>
                    <a href="?sort=popular"<?if($_GET['sort']=='popular'):?> class="select"<?endif;?>><?=GetMessage('SORT_POP')?></a>
                    <a href="?sort=new"<?if($_GET['sort']=='new'):?> class="select"<?endif;?>><?=GetMessage('SORT_NEW')?></a>
                </div>
                <div class="blog_filter-category">
                    <div class="blog_filter-title"><?=GetMessage('CATEGORY_TITLE')?></div>
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list","left",
                        Array(
                            "SELECT_SECTION" => $arSelectSection,
                            "VIEW_MODE" => "TEXT",
                            "SHOW_PARENT_NAME" => "Y",
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],
                            "SECTION_CODE" => "",
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "COUNT_ELEMENTS" => "N",
                            "TOP_DEPTH" => "2",
                            "SECTION_FIELDS" => "",
                            "SECTION_USER_FIELDS" => "",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_NOTES" => "",
                            "CACHE_GROUPS" => "Y"
                        ),
                        $component
                    );?>
                </div>
                <div class="blog_filter-tags">
                    <div class="blog_filter-title"><?=GetMessage('TAG_TITLE')?></div>
                    <?$APPLICATION->IncludeComponent("bitrix:search.tags.cloud",".default",Array(
                        "FONT_MAX" => "18",
                        "FONT_MIN" => "18",
                        "COLOR_NEW" => "000",
                        "COLOR_OLD" => "000",
                        "PERIOD_NEW_TAGS" => "",
                        "SHOW_CHAIN" => "Y",
                        "COLOR_TYPE" => "Y",
                        "WIDTH" => "100%",
                        "SORT" => "NAME",
                        "PAGE_ELEMENTS" => "150",
                        "PERIOD" => "",
                        "URL_SEARCH" => "/news/",
                        "TAGS_INHERIT" => "N",
                        "CHECK_DATES" => "N",
                        "FILTER_NAME"=> $arParams["FILTER_NAME"],
                        "arrFILTER" => Array("no"),
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600"
                    ),
                        $component
                    );?>
                </div>
                <div class="blog_filter-subscribe">
                    <div class="blog_filter-title"><?=GetMessage('SUBSCRIBE_TITLE')?></div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sender.subscribe",
                        "ef",
                        Array(
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "CONFIRMATION" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_HIDDEN" => "N",
                            "USE_PERSONALIZATION" => "Y"
                        ),
                        $component
                    );?>
                </div>
            </div>
        </div>
        <div class="blog_list">
            <?
            $ElementID = $APPLICATION->IncludeComponent(
                "bitrix:news.detail",
                "",
                Array(
                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                    "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                    "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                    "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                    "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "SET_TITLE" => "Y",
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                    "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                    "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                    "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                    "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],
                    "USE_SHARE" => $arParams["USE_SHARE"],
                    "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                    "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                    "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                    "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                    "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                    "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
                    "USE_RATING" => $arParams["USE_RATING"],
                    "MAX_VOTE" => $arParams["MAX_VOTE"],
                    "VOTE_NAMES" => $arParams["VOTE_NAMES"],
                    "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
                    "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],
                    "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                ),
                $component
            );?>
            <?if($arParams["USE_CATEGORIES"]=="Y" && $ElementID):
                global $arCategoryFilter;
                $obCache = new CPHPCache;
                $strCacheID = $componentPath.LANG.$arParams["IBLOCK_ID"].$ElementID.$arParams["CATEGORY_CODE"];
                if(($tzOffset = CTimeZone::GetOffset()) <> 0)
                    $strCacheID .= "_".$tzOffset;
                if($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
                    $CACHE_TIME = 0;
                else
                    $CACHE_TIME = $arParams["CACHE_TIME"];
                if($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath))
                {
                    $rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE"=>"Y","CODE"=>$arParams["CATEGORY_CODE"]));
                    $arCategoryFilter = array();
                    while($arProperty = $rsProperties->Fetch())
                    {
                        if(is_array($arProperty["VALUE"]) && count($arProperty["VALUE"])>0)
                        {
                            foreach($arProperty["VALUE"] as $value)
                                $arCategoryFilter[$value]=true;
                        }
                        elseif(!is_array($arProperty["VALUE"]) && strlen($arProperty["VALUE"])>0)
                            $arCategoryFilter[$arProperty["VALUE"]]=true;
                    }
                    $obCache->EndDataCache($arCategoryFilter);
                }
                else
                {
                    $arCategoryFilter = $obCache->GetVars();
                }
                if(count($arCategoryFilter)>0):
                $arCategoryFilter = array(
                    "PROPERTY_".$arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
                    "!"."ID" => $ElementID,
                );
                ?>
                    <h3 class="block_title"><?=GetMessage("CATEGORIES")?></h3>
                    <?foreach($arParams["CATEGORY_IBLOCK"] as $iblock_id):?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "flat",
                            Array(
                                "IBLOCK_ID" => $iblock_id,
                                "FILTER_NAME" => "arCategoryFilter",
                                "NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],

                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],

                                "SORT_BY1" => $arParams["SORT_BY1"],
                                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                                "SORT_BY2" => $arParams["SORT_BY2"],
                                "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                "CHECK_DATES" => $arParams["CHECK_DATES"],
                                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                "SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],

                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

                                "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                                "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "MESSAGE_404" => $arParams["MESSAGE_404"],
                                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                "SHOW_404" => $arParams["SHOW_404"],
                                "FILE_404" => $arParams["FILE_404"],
                                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",

                                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                                "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
                                "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],

                                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                                "USE_RATING" => $arParams["USE_RATING"],
                                "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                                "MAX_VOTE" => $arParams["MAX_VOTE"],
                                "VOTE_NAMES" => $arParams["VOTE_NAMES"],

                                "USE_SHARE" => $arParams["LIST_USE_SHARE"],
                                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

                                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                            ),
                            $component
                        );?><br>
                    <?endforeach?>

                    <?endif?>
                <?endif?>
                    <?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
                        <hr />
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:forum.topic.reviews",
                            "",
                            Array(
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
                                "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                "USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
                                "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                                "PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
                                "FORUM_ID" => $arParams["FORUM_ID"],
                                "URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
                                "SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
                                "DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                                "ELEMENT_ID" => $ElementID,
                                "AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                            ),
                            $component
                        );?>
                    <?endif?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
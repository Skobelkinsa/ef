<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php include "include/utm.php"; IncludeTemplateLangFile(__FILE__);
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
$symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
$operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
$htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
$fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
$winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
$wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
$wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
if ($ipad || $iphone || $android || $palmpre || $ipod || $berry || $mobile || $symb || $operam || $htc || $fennec || $winphone || $wp7 || $wp8){
    LocalRedirect("/m".$_SERVER['REQUEST_URI']);
    exit();

}
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="yandex-verification" content="69674bae5de00601" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta http-equiv="Cache-Control" content="no-cache">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-1.9.1.min.js"></script>
        <? $APPLICATION->ShowHead(); ?>
        <title><? $APPLICATION->ShowTitle() ?> </title>


        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s) {if (f.fbq)return;n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)                };
                if (!f._fbq)f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s) }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '170622230009975'); fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=170622230009975&ev=PageView&noscript=1"/></noscript>
        <!-- End Facebook Pixel Code -->

    </head>
<body>
    <div id="particles-js">  </div>
    <script src="<?= SITE_TEMPLATE_PATH ?>/js/stats.js"></script>
    <script src="<?= SITE_TEMPLATE_PATH ?>/js/particles.js"></script>
    <script src="<?= SITE_TEMPLATE_PATH ?>/js/particles-config.js"></script>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

    <div class="overlay" style="display: none;"></div>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => "/in/fm/cb.php", "EDIT_TEMPLATE" => "")); ?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => "/in/fm/auth.php", "EDIT_TEMPLATE" => "")); ?>
    <div class="overlay"></div>
    <div class="pop-up-v animate-pp popup_style" style="display: none;">
        <div><p>Bаше сообщение успешно отправлено</p></div>
    </div>

    <nav class="wrapper-nav" style="display:none;">
        <div class="nav-main">
            <a class="logo" href="/"></a>

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "nav-main",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "COMPONENT_TEMPLATE" => "top-menu",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                ),
                false
            ); ?>

            <ul class="nav-main__right pp-sear-fix pr">
                <?$APPLICATION->IncludeComponent("bitrix:search.form", "global-search", Array(	"COMPONENT_TEMPLATE" => ".default","PAGE" => "#SITE_DIR#search/index.php","USE_SUGGEST" => "Y",	),false);?>
                <li>
                    <a class="switch-phone" id="switch-phone" href="#" onclick="return false;">
                        <span class="icon icon-phone"></span>
                        <span class="phone-number">8 (800) 707-88-09</span>
                    </a>
                </li>
                <li><a href="/personal/"><span class="icon icon-personal"></span></a></li>
                <li>
                    <a href="/personal/cart/">
                        <span class="icon icon-cart"></span>
                        <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "count", Array(
                            "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",    // Страница корзины
                            "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
                            "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
                            "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
                            "SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
                            "SHOW_PRODUCTS" => "N",    // Показывать список товаров
                            "POSITION_FIXED" => "Y",    // Отображать корзину поверх шаблона
                        ),
                            false
                        );?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <?/*
    <div class="mobile-menu pa cp">
        <div class="global-menu-fix pr">
            <div class="mob-menu-phone fklbtn">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Capa_1" x="0px" y="0px" viewBox="0 0 578.106 578.106" style="fill: rgb(255, 255, 255);"
                     xml:space="preserve">
            <path style="fill: rgb(255, 255, 255);" d="M577.83,456.128c1.225,9.385-1.635,17.545-8.568,24.48l-81.396,80.781    c-3.672,4.08-8.465,7.551-14.381,10.404c-5.916,2.857-11.729,4.693-17.439,5.508c-0.408,0-1.635,0.105-3.676,0.309    c-2.037,0.203-4.689,0.307-7.953,0.307c-7.754,0-20.301-1.326-37.641-3.979s-38.555-9.182-63.645-19.584    c-25.096-10.404-53.553-26.012-85.376-46.818c-31.823-20.805-65.688-49.367-101.592-85.68    c-28.56-28.152-52.224-55.08-70.992-80.783c-18.768-25.705-33.864-49.471-45.288-71.299    c-11.425-21.828-19.993-41.616-25.705-59.364S4.59,177.362,2.55,164.51s-2.856-22.95-2.448-30.294    c0.408-7.344,0.612-11.424,0.612-12.24c0.816-5.712,2.652-11.526,5.508-17.442s6.324-10.71,10.404-14.382L98.022,8.756    c5.712-5.712,12.24-8.568,19.584-8.568c5.304,0,9.996,1.53,14.076,4.59s7.548,6.834,10.404,11.322l65.484,124.236    c3.672,6.528,4.692,13.668,3.06,21.42c-1.632,7.752-5.1,14.28-10.404,19.584l-29.988,29.988c-0.816,0.816-1.53,2.142-2.142,3.978    s-0.918,3.366-0.918,4.59c1.632,8.568,5.304,18.36,11.016,29.376c4.896,9.792,12.444,21.726,22.644,35.802    s24.684,30.293,43.452,48.653c18.36,18.77,34.68,33.354,48.96,43.76c14.277,10.4,26.215,18.053,35.803,22.949    c9.588,4.896,16.932,7.854,22.031,8.871l7.648,1.531c0.816,0,2.145-0.307,3.979-0.918c1.836-0.613,3.162-1.326,3.979-2.143    l34.883-35.496c7.348-6.527,15.912-9.791,25.705-9.791c6.938,0,12.443,1.223,16.523,3.672h0.611l118.115,69.768    C571.098,441.238,576.197,447.968,577.83,456.128z"></path>
                    </g></g></svg>
            </div>
            <div class="mob-menu-but fl"><a class="mub-mlfi pr"><span class="icon-menu-burger"><span class="icon-menu-burger__line"></span></span></a></div>
            <a href="/personal/cart/">
                <div class="mob-cart-fiz">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1" viewBox="0 0 1850 1635" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="icon__cart"> <path fill="#fff" d="M1254 1163l-1203 0c-26,0 -51,-25 -51,-51l0 -131c0,-23 22,-51 51,-51l1075 0c22,0 36,-13 44,-30l96 -192c4,-9 1,-12 -8,-12l-1207 0c-22,0 -51,-25 -51,-51l0 -131c0,-23 23,-51 51,-51l1298 0c27,0 46,-13 56,-33l200 -401c9,-18 20,-29 41,-29l182 0c19,0 29,7 18,29l-554 1111c-5,10 -19,23 -38,23z"/><circle fill="#fff" cx="207" cy="1453" r="181"/><circle fill="#fff" cx="1062" cy="1453" r="181"/></g></svg>
                </div></a>
        </div>
    </div>*/?>
    <header>
        <div class="wrapper pr">
            <a class="black" href="/">
                <div class="pa head-logo-area">
                    <div class="head-logo-area-img fl"></div>
                    <div class="head-logo-area-txt ttm fl">
                        <? $APPLICATION->IncludeFile("/include/header_description.php", Array(), Array("MODE" => "html")); ?></div>
                </div>
            </a>

            <div class="bx_cart_login_top">
                <a href="/porsonal/cart/">
                <table>
                    <tr>
                        <td>
                            <?
                            $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "enven-backet", Array(
                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",    // Страница корзины
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
                                "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
                                "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
                                "SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
                                "SHOW_PRODUCTS" => "N",    // Показывать список товаров
                                "POSITION_FIXED" => "N",    // Отображать корзину поверх шаблона
                            ),
                                false
                            );
                            ?>
                        </td>

                    </tr>
                </table>
                </a>
            </div>

            <div class="pa head-phone-area">
                <div class="head-phone-area-txt ttm fl">
                    <span class="head-phone-text">Бесплатный звонок по России</span><br>
                    <span class="phone-number">8 (800) 707-88-09</span><br>

                </div>
            </div>

            <span class="but-dull callback fklbtn pa cp">Заказать обратный звонок</span>

            <?$APPLICATION->IncludeComponent("bitrix:search.form", "global-search", Array(	"COMPONENT_TEMPLATE" => ".default","PAGE" => "#SITE_DIR#search/index.php","USE_SUGGEST" => "Y",	),false);?>
            <? $APPLICATION->IncludeComponent("bitrix:menu", "top-menu", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "COMPONENT_TEMPLATE" => "top-menu",
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            ); ?>
        </div>
    </header>


<? if ($APPLICATION->GetCurPage(false) == '/'): ?>
    <?php //include "/in/main_page.php"; ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main-page-slider",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "main-page-slider",
            "DETAIL_URL" => "#SITE_DIR#/produktsiya/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "10",
            "IBLOCK_TYPE" => "news",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "10",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "LINK",
                2 => "",
            ),
            "SET_BROWSER_TITLE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC"
        ),
        false
    );?>
    <?
        $APPLICATION->IncludeComponent("bitrix:main.include", "main-tovar", Array(
            "AREA_FILE_SHOW" => "file",    // Показывать включаемую область
            "PATH" => SITE_DIR."/in/main_page.php",    // Путь к файлу области
            "EDIT_TEMPLATE" => "",    // Шаблон области по умолчанию
        ),
            false
        );
    ?>
    <div class="ibws text-bg-main">
        <div class="wrapper">
            <div class="company-block ws">
                <?/*<div class="ws">
				<span class="company-block-title tac ma">Envenom Pharm<br>
					<h1><span class="fwb ttm">SARMs</span></h1>
				</span>
			</div>*/?>
                <div class="company-block-text ma">
                    <p>Компания <b>Envenom Pharm</b> начала свою работу на рынке спортивных добавок в 2014 году. Наш ассортимент формируется под контролем специалистов. Мы сотрудничаем с авторитетными поставщиками, чтобы наши клиенты были уверены: Envenom Pharm реализует только качественные спортивные добавки. Убедитесь в этом, посетив раздел «Экспертизы». Препараты проходят проверку в лабораториях химико-аналитического контроля и биотестирования.</p>
                    <h2>Интернет-магазин продукции для фитнеса Envenom Pharm</h2>
                    <p>Каталог поделен на категории, поэтому вы легко и быстро найдете нужный препарат. Оптовикам мы предлагаем особые условия для приобретения предтренировочных и посттренировочных комплексов. В разделе «Представители» перечислены адреса магазинов, с которыми мы сотрудничаем. Блок «Информация» пополняется тематическими статьями. Мы любим получать обратную связь и будем благодарны, если вы уделите пару минут, оставив отзыв о Envenom Pharm.</p>
                    <h2>Как купить спортивные добавки</h2>
                    <p>Технические специалисты работали над сайтом, чтобы вы совершали покупки просто и больше времени могли уделить спорту. Элементарно: добавьте продукты в корзину, оплатите на сайте и выбирайте подходящий вариант доставки.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ibws">
        <div class="wrapper">
            <div class="ico-block">
                <div class="ico">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/home_icon_deliv.svg" alt="">
                    <p>Бесплатная доставка<br>в Ваш регион по почте</p>
                </div>
                <div class="ico">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/home_icon_pay.svg" alt="">
                    <p>Оплата онлайн<br>прямо на сайте</p>
                </div>
                <div class="ico">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/home_icon_like.svg" alt="">
                    <p>Программа лояльности для постоннянных клиентов</p>
                </div>
                <div class="ico">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/home_icon_opt.svg" alt="">
                    <p>Выгодные условия<br>для оптовиков</p>
                </div>
            </div>
        </div>
    </div>
    <br>
<? elseif (!CSite::InDir('/optovikam/') && !CSite::InDir('/personal/index.php') && !CSite::InDir('/personal/order/index.php')): ?>
    <div class="content-block">
    <div class="wrapper">
    <? if (CSite::InDir('/produktsiya/')): ?>
            <h1 class="sp-tdd" style="color: #000"><? $APPLICATION->ShowTitle(false) ?></h1>
        <? endif;?>
    <? if (CSite::InDir('/komplex/')): ?>
            <h1 class="sp-tdd">
                <a<?if(CSite::InDir('/produktsiya/')):?> class="select"<?endif;?> href="/produktsiya/"><?=GetMessage("CATALOG_NAME")?></a>
                <span>|</span>
                <a<?if(CSite::InDir('/komplex/')):?> class="select"<?endif;?> href="/komplex/"><?=GetMessage("KOMPLEX_NAME")?></a>
            </h1>
        <? endif;?>

    <div class="ibws"><div class="moln-zag"></div></div>
    <? if (!CSite::InDir('/produktsiya/') && !CSite::InDir('/komplex/') && !CSite::InDir('/optovikam/') && !CSite::InDir('/o-nas/')): ?>
        <h1 class="sp-tdd"><? $APPLICATION->ShowTitle(false) ?></h1>
    <? endif; ?>

<? endif; ?>
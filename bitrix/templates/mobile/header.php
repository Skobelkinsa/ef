<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="yandex-verification" content="292f0ba05f095b66" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta http-equiv="Cache-Control" content="no-cache">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <title><? $APPLICATION->ShowTitle() ?></title>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-2.2.4.min.js"></script>
        <? $APPLICATION->ShowHead(); ?>
		<!-- Facebook Pixel Code -->
		<script>
		!function (f, b, e, v, n, t, s) {if (f.fbq)return;n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)                };
		if (!f._fbq)f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t, s) }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '170622230009975'); fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=170622230009975&ev=PageView&noscript=1"/></noscript>
		<!-- End Facebook Pixel Code -->

    </head>
<body>
<?if ($USER->IsAdmin()):?><div class="panel"><? $APPLICATION->ShowPanel();?></div><?endif;?>
<?global $USER; ?>
    <header<?if ($USER->IsAdmin()):?>  style="margin-top: 39px"<?endif;?>>
        <div class="wrapper">
            <a href="/"><div class="logo"></div></a>
            <div class="btn-menu">
                <div class="ico open"></div>
                <div class="ico close"></div>
            </div>
            <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "top", Array(
                "PATH_TO_BASKET" => SITE_DIR."m/personal/cart/",	// Страница корзины
                "PATH_TO_PERSONAL" => SITE_DIR."m/personal/",	// Страница персонального раздела
                "SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
                "SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
                "SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
                "SHOW_PRODUCTS" => "N",	// Показывать список товаров
                "POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
            ),
                false
            ); ?>
            <!--<a href="tel:88007078809" class="callback"><div class="ico phone"></div></a>-->
            <a href="/m/personal/"><div class="ico personal"></div></a>
        </div>
    </header>
    <div class="scroll-menu">
        <?$APPLICATION->IncludeComponent("bitrix:search.form", "top", Array(	"COMPONENT_TEMPLATE" => ".default","PAGE" => "#SITE_DIR#m/search/index.php","USE_SUGGEST" => "Y",	),false);?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top",
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
                "USE_EXT" => "N",
                "SHOW_COMPLEX" => "N" // not in options default templates !
            ),
            false
        ); ?>
        <?/*<div class="info">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",    // Показывать включаемую область
                "PATH" => SITE_DIR."/m/in/menu_contact.php",    // Путь к файлу области
                "EDIT_TEMPLATE" => "",    // Шаблон области по умолчанию
            ),
                false
            ); ?>
        </div>
        */?>
    </div>
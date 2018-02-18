<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); $this->setFrameMode(true);
$this->addExternalCss($this->GetFolder()."/css/font-awesome.css");

?>
<div class="ex-detail">
    <div class="title"><?=$arResult['NAME']?></div>
    <div class="info">
        <p><?=$arResult['DATE_ACTIVE_FROM']?></p>
        <p><?=$arResult['SECTION']['PATH'][0]['NAME']?></p>
    </div>
    <div class="img-ex-detail fl">
    	<img
    		class="detail_picture"
    		border="0"
    		src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
    		width="100%"
    		alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
    		title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
    	/>
    </div>
    <div class="detail-text-ex-detail">
        <?echo $arResult["DETAIL_TEXT"];?>
    </div>
    <div class="footer-info">
        <div class="info">
            <div class="tags">
                <?if(strlen($arResult['TAGS'])>0):
                foreach(explode(", ", $arResult['TAGS']) as $tag):?>
                    <span class="tag"><?=$tag?></span>
                <?endforeach;
                endif;
                ?>
            </div>
            <span class="eye"><i class="fa fa-eye" aria-hidden="true"></i> <?=$arResult['SHOW_COUNTER']?></span>
        </div>
        <div class="share">
            <span class="block_title"><?=GetMessage('SARE_TITLE')?></span>
            <a class="share_link vk" onclick="Share.vkontakte('<?="https://".$_SERVER["SERVER_NAME"].$arResult["DETAIL_PAGE_URL"]?>','<?=$arResult['NAME']?>','<?=$arResult["DETAIL_PICTURE"]["SRC"]?>','<?=substr(strip_tags($arResult["PREVIEW_TEXT"]),0,-1)?>')"><i class="fa fa-vk" aria-hidden="true"></i></a>
            <a class="share_link fb" onclick="Share.facebook('<?="https://".$_SERVER["SERVER_NAME"].$arResult["DETAIL_PAGE_URL"]?>','<?=$arResult['NAME']?>','<?=$arResult["DETAIL_PICTURE"]["SRC"]?>','<?=substr(strip_tags($arResult["PREVIEW_TEXT"]),0,-1)?>')"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a class="share_link ok" onclick="Share.odnoklassniki('<?="https://".$_SERVER["SERVER_NAME"].$arResult["DETAIL_PAGE_URL"]?>','<?=substr(strip_tags($arResult["PREVIEW_TEXT"]),0,-1)?>')"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
            <span class="back"><a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>"><?=GetMessage("BACK_HREF")?></a></span>
        </div>
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?117"></script>

        <script type="text/javascript">
            VK.init({apiId: 5075595, onlyWidgets: true});
            Share = {
                vkontakte: function(purl, ptitle, pimg, text) {
                    url  = 'http://vkontakte.ru/share.php?';
                    url += 'url='          + encodeURIComponent(purl);
                    url += '&title='       + encodeURIComponent(ptitle);
                    url += '&description=' + encodeURIComponent(text);
                    url += '&image='       + encodeURIComponent(pimg);
                    url += '&noparse=true';
                    Share.popup(url);
                },
                odnoklassniki: function(purl, text) {
                    url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
                    url += '&st.comments=' + encodeURIComponent(text);
                    url += '&st._surl='    + encodeURIComponent(purl);
                    Share.popup(url);
                },
                facebook: function(purl, ptitle, pimg, text) {
                    url  = 'http://www.facebook.com/sharer.php?s=100';
                    url += '&p[title]='     + encodeURIComponent(ptitle);
                    url += '&p[summary]='   + encodeURIComponent(text);
                    url += '&p[url]='       + encodeURIComponent(purl);
                    url += '&p[images][0]=' + encodeURIComponent(pimg);
                    Share.popup(url);
                },
                twitter: function(purl, ptitle) {
                    url  = 'http://twitter.com/share?';
                    url += 'text='      + encodeURIComponent(ptitle);
                    url += '&url='      + encodeURIComponent(purl);
                    url += '&counturl=' + encodeURIComponent(purl);
                    Share.popup(url);
                },
                mailru: function(purl, ptitle, pimg, text) {
                    url  = 'http://connect.mail.ru/share?';
                    url += 'url='          + encodeURIComponent(purl);
                    url += '&title='       + encodeURIComponent(ptitle);
                    url += '&description=' + encodeURIComponent(text);
                    url += '&imageurl='    + encodeURIComponent(pimg);
                    Share.popup(url)
                },

                popup: function(url) {
                    window.open(url,'','toolbar=0,status=0,width=626,height=436');
                }
            };
        </script>

        <!-- Put this div tag to the place, where the Comments block will be -->
        <div id="vk_comments"></div>
        <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 10, width: "864", attach: "*"});
            VK.Observer.subscribe("widgets.comments.new_comment", function f(num, last, date, hash) {
                var xmlHttp = new XMLHttpRequest();
                var params = 'num=' + encodeURIComponent(num) + '&last=' + encodeURIComponent(last) + '&date=' + encodeURIComponent(date) + '&hash=' + encodeURIComponent(hash) + '&url=' + encodeURIComponent(window.location) + '&title=' + encodeURIComponent(document.title);
                xmlHttp.open( "GET", "http://envenompharm.com/ajax/observer.php?"+params, false );
                xmlHttp.send( null );
            });
        </script>
    </div>
</div>
function yaReachGoal(id) {
    yaCounter37038965.reachGoal(id);
    console.log('yaCounter37038965 ID: '+id);
}
$(function () {
    //Цели
    $('body').on('click', '.addtocart button', function () {
        yaReachGoal('cart');
    });
    $('body').on('click', '#ORDER_CONFIRM_BUTTON', function () {
        yaReachGoal('order');
    });
    $('body').on('click', '.order_reg_form input[type="submit"]', function () {
        yaReachGoal('reg');
    });
    $('body').on('click', 'form.content-form button[type="submit"]', function () {
        if($(this).hasClass("opt")){
            yaReachGoal('wholesale');
        }else{
            yaReachGoal('content-form');
        }
    });
    $('body').on('click', 'form.onclick button[type="submit"]', function () {
        yaReachGoal('onclick');
    });

    // Отпкрытие меню
    $("header").on('click', '.btn-menu', function(){
        $(this).toggleClass("active");
        $('.scroll-menu').toggleClass("active");
        $('body').toggleClass("noscroll");
    });
    // Открытие категорий
    $(".bx_sitemap").on('click', '.btn-open', function(){
        $(this).toggleClass("active");
        $('.bx_sitemap_ul').toggleClass("open");
    });
    // One click
    $("body").on('click', '.onclick-btn, .onclick .close, .by-one-klick .block-bg', function(){
        $('.onclick').toggleClass("open");
        $('body').toggleClass("shadow");

    });

    // add/romove count product
    $(".block-detail").on('click', '.count button', function(){
        if($(this).hasClass("plus")){
            count = parseInt($('.count input').val())+1
            $('.count input').val(count);
            $('.addtocart input[name="count"]').val(count);
            fullprice = $('.addtocart input[name="price"]').val()*count;
            $('.item_old_price').html(fullprice+'<ruble><span class="text">руб.</span></ruble>');
        }
        if($(this).hasClass("minus") && parseInt($('.count input').val())>=2){
                count = parseInt($('.count input').val())-1
                $('.count input').val(count);
                $('.addtocart input[name="count"]').val(count);
                fullprice = $('.addtocart input[name="price"]').val()*count;
                $('.item_old_price').html(fullprice+'<ruble><span class="text">руб.</span></ruble>');
        }
        if($('.count input').val()>=2){
            $('.count input').addClass('red');
            $('.sale-banner').show(500);
        }else{
            $('.count input').removeClass('red');
            $('.sale-banner').hide(500);
        }
    });
    // Табы в детальной товара
    $(".tabs").on('click', 'li', function(){
        $('.tabs-list > div').css('display', 'none');
        $('.tabs li').removeClass('active');
        $(this).addClass('active');
        $('.tabs-list #'+$(this).data('id-content')).css('display', 'block');
    });
    // Добовление в корзину
    $(".addtocart").submit(function () {
        var thiis = $(this);
        $.post(thiis.attr('action'), $(this).serialize(), function (data){
            if(data.error==0){
                location="/m/personal/cart/";
            }else{
                alert('Товар не полежен в корзину!')
            }
        });
        //$('.pop-up2').animate({opacity: "show"}, 1000);
        return false;
    });
    // Слайдер на главной
    $('#home-slider').lightSlider({
        autoWidth:true,
        adaptiveHeight:true,
        loop:true,
        auto:true,
        pouse: 4000,
        slideMargin: 0,
        onBeforeStart: function() {
            $('#home-slider li img').css('width', $('body').width()-20);
            $('.home-slider').removeClass('mask-loading');
        }
    });
    // Слайдер галлерея в товарах
    $('#product-gallery').lightSlider({
        gallery:false,
        item:2,
        loop:true,
        thumbItem:5,
        slideMargin:0,
        thumbMargin:0,
        enableDrag: false,
        currentPagerPosition: 'right',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#product-gallery .lslide'
            });
        }
    });
    // Слайдер рекомендаций
    $('.bx_item_list_recommended .bx_item_list_slide').lightSlider({
        item:2,
        adaptiveHeight:true,
        loop:true,
        auto:false,
        slideMargin: 0,
        onBeforeStart: function() {
            $('.bx_item_list_recommended .bx_item_list_slide').removeClass('mask-loading');
        }
    });

    // Формы обратной связи
    $("form.onclick").submit(function () {
        var thiis = $(this);
        $.post(thiis.attr('action'), $(this).serialize(), function (data){
            alert(data.message);
            $(".content-form input, .content-form textarea").each(function(){
                $(this).val("");
            });
        });
        //$('.pop-up2').animate({opacity: "show"}, 1000);
        return false;
    });
    $(".content-form").submit(function () {
        var thiis = $(this);
        $.post(thiis.attr('action'), $(this).serialize(), function (data){
            alert(data.message);
            $(".content-form input, .content-form textarea").each(function(){
                $(this).val("");
            });
        });
        //$('.pop-up2').animate({opacity: "show"}, 1000);
        return false;
    });
});
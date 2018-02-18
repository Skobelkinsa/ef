$(function () {
    $(window).scroll(function() {
        var top = $(document).scrollTop();
        if (top > 270) $('.scroll-block').addClass('fixed');
        else $('.scroll-block').removeClass('fixed');
    });
    //путь к файлу с компонентом. ”казываем параметр
    var path = "/in/news_list.php?ajaxnew=Y&clear_cache=Y";
    var count = $(".posts_block").data("count");
    //счетчик страниц
    var currentPage = 1;

    $('.blog').on('click', '.show-more', function(e){
        $(this).remove();
        //делаем ajax запрос и сразу инкремент номера страницы
        $.get(path, {PAGEN_1: ++currentPage}, function(data){
            //добавим новости к списку
            $(".blog .blog_list .prod-desc").before(data);
            if(currentPage * 9 >= count){
                $(".show-more").hide();
            }
        });
        console.log(currentPage * 9);
        console.log(count);
        //отключим скролл к верху документа
        e.preventDefault();



    });

    if(currentPage * 9 >= count){
        $(".show-more").hide();
    }
});
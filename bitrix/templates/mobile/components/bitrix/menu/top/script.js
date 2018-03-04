$(function () {
    $('.top-menu').on('click', '.sub-menu', function () {
        $(this).toggleClass('active');
        $('.top-menu').toggleClass('hidden');
    });
});
//Smoothly scrolls when clicking on a link to a section
$(document).ready(function () {
    $('a[href^="#"]').on('click', function (page) {
        page.preventDefault();

        var target = this.hash;
        $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 1500, 'swing', function () {
            window.location.hash = target;
        });
    });
});
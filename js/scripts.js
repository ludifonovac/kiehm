/*
// Header menu for responsive
*/
jQuery(function ($) {
    $(document).ready(function () {
        $("div.navicon").click(function () {
            $(".main-navigation").toggle('collapse');
            $("div.navicon").toggleClass('open');
        });
    });
});

/*
// Change of header style when scrolled
*/
jQuery(function ($) {
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 40) {
            $("#masthead").addClass("header-scrolled");
        }
        else {
            $("#masthead").removeClass("header-scrolled");
        }
    });
});

/*
// Jump to top
*/
jQuery(function ($) {
    $('.return-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    });
});

/*
// Jump to section
*/
jQuery(function ($) {
    $(document).ready(function () {
        var offsetSize = $(".site-header").innerHeight();
        if (typeof $(window.location.hash).offset() != "undefined") {
            $("html, body").animate({scrollTop: $(window.location.hash).offset().top - offsetSize}, 500);
        }
    });
});

/*
// Change product
*/
jQuery(function ($) {
    $('li.product-listed').click(function () {
        var value = $(this).attr('data-value');
        $('li.product-listed.selected').removeClass('selected');
        $(this).addClass('selected');
        //$('article.product.selected').slideUp();
        //$('#' + value).slideDown();
        $('article.product.selected').removeClass('selected');
        $('#' + value).addClass('selected');
        $('article.resp-product.show').removeClass('show');
        $('#resp-' + value + '.resp-product').addClass('show');
        //$('article.resp-product.show').slideUp();
        //$('#' + value + '.resp-product').slideDown();
    });
});

/*
// Close product on responsive version
*/
jQuery(function ($) {
    $('article.resp-product a.close-product').click(function () {
        $('article.resp-product.show').removeClass('show');
    });
});

jQuery(function ($) {
    $("article.products_rent button").click(function(){
        var name = $(this).data('name');
        $("div.takeover-form").toggle('collapse');
        $('body,html').animate({
            scrollTop: 100
        }, 500);
        $('div.takeover-form input[name=trailer-type]').val(name);
    });
    $("div.takeover-form>a").click(function(){
        $("div.takeover-form").toggle('collapse');
    });
});

'use strict';
$(document).ready(function () {

    /* -------------------------------------
     HOME SLIDER
     -------------------------------------- */
    $("#banner").owlCarousel({
        autoPlay: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigation: false
    });
    /** Video Frame **/
    $(".showiframe").fancybox({
        type: "iframe",
        beforeShow: function () {
            $.fancybox.wrap.bind("contextmenu", function (e) {
                return false;
            });
        }
    });
    /** Video Frame **/

    $('.causes-holder .progress .progress-bar').progressbar();
    $('.progress-holder .progress .progress-bar').progressbar();
    /** View Point Animation **/
    $('.appearleft').addClass("opacityfull").viewportChecker({
        classToAdd: 'opacitylow animated fadeInLeft', // Class to add to the elements when they are visible
        offset: 10
    });
    $('.appearright').addClass("opacityfull").viewportChecker({
        classToAdd: 'opacitylow animated fadeInRight', // Class to add to the elements when they are visible
        offset: 10
    });
    $('.appeartop').addClass("opacityfull").viewportChecker({
        classToAdd: 'opacitylow animated fadeInUpBig', // Class to add to the elements when they are visible
        callbackFunction: function (elem, action) {
            $('.progress .progress-bar').progressbar();
        },
        offset: 10
    });
    /** View Point Animation **/
    /** tooltip **/
    $('.fc-event-title, .fc-event-inner .fc-event-title').tooltip();
    /** tooltip **/
    /** Fancybox Library **/
    $(".gallery_list a").fancybox({'transitionIn': 'elastic', 'transitionOut': 'elastic', 'speedIn': 600, 'speedOut': 200, 'overlayShow': false});
    /** Fancybox Library **/

    /** Quick Sand **/


    $('.gallery_list').imagesLoaded(function () {
        $('.gallery_list').isotope({
            itemSelector: '.gallery_list li',
            layoutMode: 'fitRows'
        });
    });
    $('.filter_holder a').on('click', function () {
        var selector = $(this).attr('data-filter');
        $('.gallery_list').isotope({filter: selector});
        return false;
    });
    /** Quick Sand **/


    var winWidth = $(window).width();
    /**  Animated Menu **/
    if (winWidth > 800) {
        $('.nav-list li').on(
                {mouseenter: function ()
                    {
                        $(this).children('ul').stop(true, true).slideDown(400);
                    },
                    mouseleave: function ()
                    {
                        $(this).children('ul').slideUp(100);
                    }}
        );
    }
    /**  Animated Menu **/

    /** Stats Slider **/
    var statsSlider = $('.stats-slider');
    if (statsSlider.length) {
        statsSlider.bxSlider({minSlides: 1, maxSlides: 1, slideMargin: 18, speed: 200, pager: false});
    }
    var eventsSlider = $('.events-list');
    if (eventsSlider.length) {
        eventsSlider.bxSlider({mode: 'vertical', minSlides: 3, maxSlides: 3, slideMargin: 18, speed: 500, pager: false});
    }
    /** Stats Slider **/

    /** CarouSel **/
    var carouSel = $('.carousel');
    if (carouSel.length) {
        carouSel.carousel();
    }
    /** CarouSel **/


    /** AJAX Contact Form **/
    $("#submit_btn").on('click', function () {
        var proceed = true;
        $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function () {
            $(this).css('border-color', '');
            if (!$.trim($(this).val())) {
                $(this).css('border-color', 'red');
                proceed = true;
            }

            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ($(this).attr("type") == "email" && !email_reg.test($.trim($(this).val()))) {
                $(this).css('border-color', 'red');
                proceed = true;
            }
        });
        if (proceed)
        {
            console.log($('#name').val());
            post_data = {
                'name': $('#name').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'website': $('#website').val(),
                'message': $('#message').val()
            };
            $.post('./contact.php', post_data, function (response) {
                // console.log('Here');
                if (response.type == 'error') {
                    output = '<div class="error">' + response.text + '</div>';
                } else {
                    output = '<div class="success">' + response.text + '</div>';
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val('');
                    $("#contact_body").slideUp();
                }
                $("#contact_results").hide().html(output).slideDown();
            }, 'json');
        }
    });
    $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function () {
        $(this).css('border-color', '');
        $("#result").slideUp();
    });
    $('[data-countdown]').each(function () {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<ul><li><span id="days">%D</span><strong class="time-detail">days</strong></li><li><span id="days">%M</span><strong class="time-detail">Mins</strong></li><li><span id="days">%S</span><strong class="time-detail">Sec</strong></li></ul>'));
        });
    });
    $('#event-timer').countdown('2018/10/10', function (event) {
        var $this = $(this).html(event.strftime(''
                + '<ul>'
                + '<li><span>%D</span> <strong>days</strong></li>'
                + '<li><span>%H</span> <strong>hours</strong></li>'
                + '<li><span>%M</span> <strong>minutes</strong></li>'
                + '<li><span>%S</span> <strong>seconds</strong></li></ul>'));
    });
});
/** Contact Form **/
	
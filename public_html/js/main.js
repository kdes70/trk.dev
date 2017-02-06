$(document).ready(function() {

//Slider News
    $('#news_slider').jCarouselLite({
        vertical: false,
        hoverPause: true,
        btnPrev: ".arr_prev",
        btnNext: ".arr_next",
        visible: 4,
        auto: 5000,
        speed: 800
    });
//Slider News


$.ionTabs("#tabs_1");

    $('#add_photo').click(function() {
        $('.hiiden').toggle();
    }); 

});
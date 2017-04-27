$('.logout_link').on('click', function (event) {
    event.preventDefault();
//  console.log("test");
    $('#logout_form').submit();
});

$(document).ready(function () {

// Responsive    
    $('.owl-carousel').owlCarousel({
        items: 2,
        loop: true,
        margin: 10,
        nav: true,

        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });

});
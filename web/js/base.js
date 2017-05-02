$('.logout_link').on('click', function (event) {
    event.preventDefault();
//  console.log("test logout_link");
    $('#logout_form').submit();
});

$('#product-imagefiles').on('change', function (event) {
    event.preventDefault();
//  console.log("test file upload");
    var $r = event.target;
    var $count = $r.files.length;
    for (var $i = 0; $i < $count; $i++)
    {
        loadImage($r.files[$i]);
//      console.log($r.files[$i].name);
    }

    function loadImage($img) {
        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var img_tag = $('<img>');
            img_tag[0].src = dataURL;

            $('.owl-carousel')
                    .trigger('add.owl.carousel', [img_tag, 0])
                    .trigger('refresh.owl.carousel')
            img_tag.parent().append($('<div class="item-remove">') );
        };

        reader.readAsDataURL($img);
    }

}
);

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
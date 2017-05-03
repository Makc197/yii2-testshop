//Перехватываем событие нажатия на кнопку Logout
$('.logout_link').on('click', function (event) {
    event.preventDefault();
//  console.log("test logout_link");
    $('#logout_form').submit();
});

//Перехватываем событие на изменение fileinput
$('#product-imagefiles').on('change', function (event) {
//  event.preventDefault();
//  console.log("test file upload");
    var $r = event.target;
    var $count = $r.files.length;
    for (var $i = 0; $i < $count; $i++)
    {
        loadImage($r.files[$i]); //Вызов функции загрузки изображения
//      console.log($r.files[$i].name);
    }

//Функция загрузки изображений на стороне клиента через Fileinput
    function loadImage($img) {
        var reader = new FileReader();
        reader.onload = function () {

            var header = ";base64,";
            var dataURL = reader.result;
            var sBase64Data = dataURL.substr(dataURL.indexOf(header) + header.length);

            var img_tag = $('<img>');
//          img_tag.data('filename',$img.name);
            img_tag.attr("data-fn", $img.name);
            img_tag.on('click', function () {
                $img.remove();
            });
            img_tag[0].src = dataURL;

            $('.owl-carousel')
                    .trigger('add.owl.carousel', [img_tag, 0])
                    .trigger('refresh.owl.carousel')
            img_tag.parent().append($('<div class="item-remove"><span class="glyphicon glyphicon-trash"></span></div>'));

            AjaxFormRequest('result_div_id1', sBase64Data, '/root/product/ajax-update?id=' + $('.product-form').attr("product_id"));
        };

        reader.readAsDataURL($img);
    }

//После загрузки всех изображений - эмуляция submit
//    $('#productform').submit();

//После загрузки всех изображений отправляем форму на сервер через Ajax
//    AjaxFormRequest('result_div_id1', 'productform', '/root/product/ajax-update?id=' + $('.product-form').attr("product_id"));

}
);

//Функция для отправки формы средствами Ajax 
function AjaxFormRequest(result_id, sBase64Data, url) {
    document.getElementById(result_id).innerHTML = 'Ожидайте... ';
    $.ajax({
        url: url, //Адрес подгружаемой страницы 
        type: "POST", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {img: sBase64Data},
        success: function (response) { //Если все нормально 
            document.getElementById(result_id).innerHTML = response;
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
        }
    });
}

// Настройки карусели
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
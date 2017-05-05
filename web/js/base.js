//Перехватываем событие нажатия на кнопку Logout
$('.logout_link').on('click', function (event) {
    event.preventDefault();
//  console.log("test logout_link");
    $('#logout_form').submit();
});

//Перехватываем событие на изменение fileinput
$('#product-imagefiles').on('change', function (event) {
//  event.preventDefault();
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
            var dataURL = reader.result;
            AjaxFormRequest('result_div_id1', dataURL, '/root/product/ajax-update?id=' + $('.product-form').attr("product_id"));
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
function AjaxFormRequest(result_id, dataURL, url) {
    var header = ";base64,";
    var sBase64Data = dataURL.substr(dataURL.indexOf(header) + header.length);
    document.getElementById(result_id).innerHTML = 'Ожидайте... ';
    $.ajax({
        url: url, //Адрес подгружаемой страницы 
        type: "POST", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {img: sBase64Data},
        success: function (response) { //Если все нормально 
            document.getElementById(result_id).innerHTML = '';
            var $id = JSON.parse(response).id;

            //Если удачно - добавляем картинку в карусель и прописываем идентиф в блоке для возможности удаления
            var img_tag = $('<img>');
            //img_tag.data('filename',$img.name);
            //img_tag.attr("data-fn", $img.name);
            img_tag[0].src = dataURL;

            $('.owl-carousel')
                    .trigger('add.owl.carousel', [img_tag, 0])
                    .trigger('refresh.owl.carousel');
            img_tag.parent().attr('id', $id);
            var remdiv = $('<div class="item-remove"><span class="glyphicon glyphicon-trash"></span></div>');
            remdiv.on('click', removeimg);
            img_tag.parent().append(remdiv);
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
        }
    });
}

//Функция удаления изображения ajax запросом
$('.item-remove').on('click', removeimg);

function removeimg(e) {
//  $(".owl-carousel").trigger('remove.owl.carousel', 0);
    var div = $(e.target).parent().parent();
    console.log(empty(div.attr('id')));
    var result_id = 'result_div_id1'; // div куда выводим сообщение
//  Ajax запрос на сервер для удаление картинки из базы
    $.ajax({
        url: '/root/product/ajax-imgremove', //Адрес экшена
        type: "POST", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {imgid: div.attr('id')}, // В экшен передаем id картинки которую удалим на сервере
        success: function (response) {  // Если удачно, то удаляем картинку со страницы    
            document.getElementById(result_id).innerHTML = response;
            div.remove();
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
        }
    });

}

function empty(e) {
    switch (e) {
        case "":
        case 0:
        case "0":
        case null:
        case false:
        case typeof this == "undefined":
            return true;
        default:
            return false;
    }
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
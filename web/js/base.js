//Перехватываем событие нажатия на кнопку Logout
$('.logout_link').on('click', function (event) {
    event.preventDefault();
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

//Функция добавления товара в корзину
//Перехватываем событие нажатия на кнопку Добавить в корзину
$('.add-to-cart').on('click', function (event) {
    event.preventDefault();
    var div = $(event.target).parent();
    var result_id = 'result_div_id1'; // div куда выводим сообщение
    //  Ajax запрос на сервер для добавления товара в корзину (в сессию)
    $.ajax({
        url: '/shop/add-product-to-cart', //Адрес экшена
        type: "GET", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {product_id: div.attr('id')}, // В экшен передаем id продукта который добавляем в корзину
        success: function (response) {
            document.getElementById(result_id).innerHTML = response;
            div.remove();
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
        }
    });
});

//Функция удаления товара из корзины
//Перехватываем событие нажатия на кнопку Удалить из корзины
$('.remove-cart-item').on('click', function (event) {
    event.preventDefault();
    var div = $(event.target).parent().parent();
    //var result_id = 'result_div_id1'; // div куда выводим сообщение
    //Ajax запрос на сервер
    $.ajax({
        url: '/cart/ajax-remove-cart-item', //Адрес экшена
        type: "GET", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {product_id: div.attr('id')}, // В экшене передаем id продукта, который удаляем из корзины
        success: function (response) {
            //document.getElementById(result_id).innerHTML = response;
            div.parent().remove();
            console.log(response);
            recalctotalprice();
        },
        error: function (response) { //Если ошибка 
            //document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
            console.log('Ошибка при отправке формы');
        }
    });
});

//Перехватываем событие при изменении количества товара в корзине
$('.cart-item-count').on('change', function (event) {
    event.preventDefault();
    var inp = $(this);
    var result_id = 'result_div_id1'; // div куда выводим сообщение
    //Ajax запрос на сервер
    $.ajax({
        url: '/cart/ajax-update-cart-item-count', //Адрес экшена
        type: "POST", //Тип запроса 
        dataType: "html", //Тип данных 
        data: {product_id: inp.attr('id'),
            product_count: inp.val()},
        success: function (response) {
            recalctotalprice();
            document.getElementById(result_id).innerHTML = response;
            console.log(response);
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
            console.log('Ошибка при отправке формы');
        }
    });
});

//Функция пересчета итоговой суммы
function recalctotalprice() {
    $.ajax({
        url: '/cart/ajax-recalc-total-price', //Адрес экшена
        dataType: "html", //Тип данных 
        success: function (response) {
            $('.cart-total-price').html(response);
//          document.getElementById('total-price').innerHTML = response;
        },
        error: function (response) { //Если ошибка 
            document.getElementById(result_id).innerHTML = 'Ошибка при отправке формы';
            console.log('Ошибка при отправке формы');
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
                items: 1 //2
            },
            1000: {
                items: 1 //2
            }
        }
    });
});

$(function () {
    $('[data-toggle = modal]').on('click', function (e) {
        var $target = $(this);
        if ($url = $target.data("modal_url")) {
            $($target.data("target") + ' .modal-body').load($url);
        }
    })
});

$(function () {
    $('.modal-submit').on('click', function (e) {
        var $target = $(this);
        //Ajax запрос на actionAdd
        //Пересчитываем модалку с другим контентом - сообщение Товар добавлен в корзину
        $($target.data("target") + ' .modal-body').html('<h5>Товар добавлен в корзину</h5>');
    })
});
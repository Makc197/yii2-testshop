<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Product;
use app\models\Category;
use app\models\MmCategoryProduct;

class DbController extends Controller {

    public function actionIndex() {

        for ($i = 0; $i < 4; $i++) {

            switch ($i) {
                case 0: //Категория 1 - Спиннинги
                    $categoryname = 'Спиннинги';
                    $producttitle = 'Спиннинг';  //Наименование товара
                    $minprice = 2400;
                    $maxprice = 15000;
                    $numrows = 47; //Кол-во записей которые необх создать в базе 
                    break;
                case 1: //Категория 2 - Катушки
                    $categoryname = 'Катушки';
                    $producttitle = 'Катушка';  //Наименование товара
                    $minprice = 3000;
                    $maxprice = 20000;
                    $numrows = 34; //Кол-во записей которые необх создать в базе 
                    break;
                case 2: //Плетеные шнуры
                    $categoryname = 'Плетеные шнуры';
                    $producttitle = 'Плетеный шнур';  //Наименование товара
                    $minprice = 500;
                    $maxprice = 3000;
                    $numrows = 43; //Кол-во записей которые необх создать в базе 
                    break;
                case 3: //Офсетные крючки
                    $categoryname = 'Офсетные крючки';
                    $producttitle = 'Офсетные крючки';  //Наименование товара
                    $minprice = 120;
                    $maxprice = 300;
                    $numrows = 100; //Кол-во записей которые необх создать в базе 
                    break;
                case 4: //Приманки
                    $categoryname = 'Приманки';
                    $producttitle = 'Приманка';  //Наименование товара
                    $minprice = 120;
                    $maxprice = 300;
                    $numrows = 100; //Кол-во записей которые необх создать в базе 
                    break;
            }

            $c = new Category();
            /**
              'id' => 'ID',
              'name' => 'Name',
              'pos' => 'Pos',
              'techname' => 'Techname',
             */
            $c->name = $categoryname;
            $c->pos = $i;
            $c->techname = 'Techname for ' . $categoryname;
            $c->save();

            for ($j = 0; $j < $numrows; $j++) {
                $p = new Product;
                /**
                  'title' => 'Наименование',
                  'description' => 'Описание товара',
                  'price' => 'Цена',
                  'sale' => 'Цена со скидкой',
                  'count' => 'Количество на складе',
                 */
                $ptitle = $producttitle . ' ' . $j;
                $p->title = $ptitle;
                $p->description = 'Описание для товара ' . $producttitle . ' ' . $j;
                $price = rand($minprice, $maxprice);
                $p->price = $price;
                $p->sale = $price * 0.9; //Цена со скидкой 10%
                $p->count = rand(5, 30);
                $p->save();

                //Связь Категория - Продукт
                $mmcategory = new MmCategoryProduct();

                $mmcategory->product_id = $p->id;
                $mmcategory->category_id = $c->id;
                $mmcategory->save();

                echo $i.' '.$categoryname.' '.$j.' '.$ptitle;
            }
        }
    }

}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $title
 * @property string $description
 * @property string $price
 * @property string $sale
 * @property integer $id
 * @property integer $count
 *
 * @property MmCategoryProduct[] $mmCategoryProducts
 * @property Category[] $categories
 * @property OrderProduct[] $orderProducts
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord {

    public $category_id;
    public $imageFiles;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['description'], 'string'],
                [['price', 'sale'], 'number'],
                [['count'], 'integer'],
                ['category_id', 'safe'],
                [['title'], 'string', 'max' => 250],
                [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '№',
            'title' => 'Наименование',
            'description' => 'Описание товара',
            'price' => 'Цена',
            'sale' => 'Цена со скидкой',
            'count' => 'Количество на складе',
            'imageFiles' => 'Изображения товара'
        ];
    }

    public function upload() {

        if (empty($this->imageFiles))
            return;

        $n = 0;

        foreach ($this->imageFiles as $img) {
            $filename = date('d.m.Y') . rand(100, 999) . '.' . $img->extension;
            $path = Yii::getAlias('@webroot/img/products/');

            if ($img->saveAs($path . $filename)) {
                $img_obj = new Image;
                $img_obj->img = $filename;
                $img_obj->product_id = $this->id;
                $img_obj->pos = $n++;
                $img_obj->save();
            }
        }
    }

    public static function find() {
        return parent::find()->orderBy(['id' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmCategoryProducts() {
        return $this->hasMany(MmCategoryProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories() {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('mm_category_product', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts() {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders() {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_product', ['product_id' => 'id']);
    }

    public function getImages() {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        if ($category = MmCategoryProduct::findAll(['product_id' => $this->id])) {
            foreach ($category as $item)
                $item->delete();
        }

        foreach ($this->category_id as $newcategory) {
            $category = new MmCategoryProduct();
            $category->product_id = $this->id;
            $category->category_id = $newcategory;
            $category->save();
        }
    }

}

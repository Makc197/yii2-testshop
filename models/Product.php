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
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'sale'], 'number'],
            [['count'], 'integer'],
            [['title'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'sale' => 'Sale',
            'id' => 'ID',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmCategoryProducts()
    {
        return $this->hasMany(MmCategoryProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('mm_category_product', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('order_product', ['product_id' => 'id']);
    }
}

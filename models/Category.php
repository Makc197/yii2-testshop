<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pos
 * @property string $techname
 *
 * @property MmCategoryProduct[] $mmCategoryProducts
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'techname'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pos' => 'Pos',
            'techname' => 'Techname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmCategoryProducts()
    {
        return $this->hasMany(MmCategoryProduct::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('mm_category_product', ['category_id' => 'id']);
    }
}

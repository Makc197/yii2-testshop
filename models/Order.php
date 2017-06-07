<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $zipcode
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string $build
 * @property string $room
 * @property string $delivery_type
 * @property integer $user_id
 *
 * @property User $user
 * @property OrderProduct[] $orderProducts
 * @property Product[] $products
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'zipcode', 'city', 'street', 'house', 'build', 'room', 'delivery_type'], 'string'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'zipcode' => 'Индекс',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'build' => 'Корпус',
            'room' => 'Квартира',
            'delivery_type' => 'Тип доставки',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('order_product', ['order_id' => 'id']);
    }
}

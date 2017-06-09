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
class Order extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'order';
    }

    const SCENARIO_CREATENEW = 'CREATENEW';
    const SCENARIO_POSTDELIVERY = 'POSTDELIVERY';
    const SCENARIO_COURIERDELIVERY = 'COURIERDELIVERY';

    public function scenarios() {
        $scenarios = parent::scenarios();
        //Перечень полей, которые нужно проверять в сценарии - остальные поля исключаются
        $scenarios[self::SCENARIO_CREATENEW] = ['name', 'phone', 'delivery_type'];
        $scenarios[self::SCENARIO_POSTDELIVERY] = ['name', 'phone', 'zipcode', 'city', 'street', 'house', 'delivery_type'];
        $scenarios[self::SCENARIO_COURIERDELIVERY] = ['name', 'phone', 'city', 'street', 'house', 'delivery_type'];
        return $scenarios;
    }

    public function rules() {
        return [
                [['name', 'phone', 'email', 'zipcode', 'city', 'street', 'house', 'build', 'room'], 'string'],
                [['name', 'phone', 'email', 'zipcode', 'city', 'street', 'house', 'build', 'room', 'delivery_type'], 'required'],
                [['user_id', 'delivery_type'], 'integer'],
                [['order_number'], 'safe'],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels() {
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
            'order_number' => 'Номера заказа'
        ];
    }

    public function createNewOrder($arrprice) {
        $this->load(Yii::$app->request->post());

        switch ($this->delivery_type) {
            case 1:
                $this->scenario = self::SCENARIO_COURIERDELIVERY;
                break;

            case 2:
                $this->scenario = self::SCENARIO_POSTDELIVERY;
                break;

            default:
                $this->scenario = self::SCENARIO_CREATENEW;
                $this->validate();
                return false;
        }

        //Записываем значение полей из заказа в Order
        //var_dump($this->validate(), $this->getErrors(), $this->save());
        if ($this->validate() & $this->save()) {
            $order_id = $this->id;
            //Генерация уникального номера заказа
            $rndkey = random_int(0, PHP_INT_MAX);
            $order_number = date('YmdHis') . 'N' . $order_id . 'R' . substr($rndkey, 1, 4);
            $this->order_number = $order_number;
            $this->save();

            //Разбор массива товаров корзины и запись в базу в order_product
            foreach ($arrprice['cart'] as $key => $val) {
                //print $key . '-' . $val['count'].' | ';
                $order_product = new OrderProduct;
                $order_product->product_id = $key;
                $order_product->count = $val['count'];
                $order_product->price = $val['price'];
                $order_product->order_id = $order_id;
                //var_dump($order_product->validate(), $order_product->getErrors(), $order_product->save());
                $order_product->save();
            }

            yii::$app->session->setFlash('regsuccess', 'Спасибо. Заказ оформлен. </br>Номер заказа: '.$order_number.'</br>В ближайшее время наш менеджер свяжется с Вами.');
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts() {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts() {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('order_product', ['order_id' => 'id']);
    }

}

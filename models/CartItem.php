<?php
namespace app\models;

class CartItem extends \yii\base\Model {

    public $id; //ID товара в корзине - Артикул
    public $count; //Количество товара в корзине
    public function rules()
    {
        return [
            [['id','count'], 'required'],
            [['id','count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Количество',
        ];
    }

    public function save() {
        //@TODO Реализовать метод сохранения товара в сессию        
        return true;
    }
    
    public static function findOne($id){
        //@TODO Реализовать метод поиска товара в сессии
        //Если в сессиии нет -  return new self(['id'=>$id])
        return new self(['id'=>$id]);
    }
        
}

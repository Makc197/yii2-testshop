<?php
namespace app\components\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class SearchWidget extends Widget
{
    const WITH_SELECT = 'with_select';
    
    const SIMPLE = 'simple';
    
    public $text;
    
    public $type;
    
    public function init()
    {
        $this->text = Yii::$app->request->get('q');
        parent::init();
    }

    public function run()
    {
        switch($this->type){
            case self::WITH_SELECT:
                return $this->render('search_form_select',['text' => $this->text ]);
            case self::SIMPLE:
            default:
                return $this->render('search_form',['text' => $this->text ]);                
        }        
    }
}
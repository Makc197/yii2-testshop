<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<style> 
    .checkbox {
        padding-left: 0px !important;
    }
</style>

<?php
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => '/site/login'
]);
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <div class="form-group">
                    <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'rememberme')->checkbox() ?>
                    </div>

                    <div class="col-md-6">
                        <?= Html::submitButton('Вход', ['class' => 'btn pull-right', 'name' => 'login-button']) ?>                     
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!--<a href="/user/page-password-reset" class="forgot-password">Забыли пароль?</a>-->
                        <?= Html::a('Забыли пароль?', '/user/reqres-password', ['class' => 'forgot-password']) ?> 
                    </div>

                    <div class="col-md-6">
                        <?= Html::a('Зарегистрироваться', '/user/registration', ['class' => 'btn pull-right', 'name' => 'register-button']) ?>  
                    </div>
                </div>

                <!-- Если есть ошибки - выводим модальное окно и отображаем ошибки -->
                <!-- Рендер модального окна + передаем туда model -->           
                <!-- Данные, которые кладем в js переменную надо сериализовать --> 
                <script type="text/javascript">
                    var modal_error = <?= empty($model->errors) ? 'false' : 'true' ?>,
                        modal_title = 'Внимание',
                        modal_error_view = '<?= $this->render('modal_error', compact('model')) ?>';
                </script>

                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal">Small modal</button>-->

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('modals', ['model' => $model]) ?>
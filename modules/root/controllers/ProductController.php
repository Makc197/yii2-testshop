<?php

namespace app\modules\root\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\models\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save() && $this->uploadfiles()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->save()) {
                $model->upload();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAjaxImgremove() {
        $imgid = Yii::$app->request->post()['imgid'];
        $imgmodel = findImgModel($imgid);
        
        /** @TODO: Надо дописать ф-ю удаления картинки из базы
        
    }

    /** @TODO: Надо определять расширение файла по заголовку Base64 */
    public function actionAjaxUpdate($id) {
        $base64_string = Yii::$app->request->post()['img'];

        $model = $this->findModel($id);

        if ($model) {
            $fileid = $model->ajaximgupload($base64_string);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ["id" => $fileid];
            //Перезагружаем страницу чтобы сгенерить дивы с правильными идентификаторами - чтобы можно было удалить выбранные изображения
//            return $this->redirect(['/root/product/update', 'id' => $model->id]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     protected function findImgModel($imgid) {
        if (($imgmodel = Image::findOne($imgid)) !== null) {
            return $imgmodel;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

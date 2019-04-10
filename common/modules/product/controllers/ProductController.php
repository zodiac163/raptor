<?php

namespace common\modules\product\controllers;

use Yii;
use common\modules\product\models\Product;
use common\modules\product\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RaptorHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    $model = $this->findModel($id);
        $imagesSource = $model->images;
        $images = [];
        if ($imagesSource) {
            $imagesDecode = json_decode($imagesSource);
            foreach ($imagesDecode->urls as $img) {
                $t = getimagesize('http://' .Yii::$app->params['fileStore'] . $img->url);
                $images[] = [
                    'image' => '//' . Yii::$app->params['fileStore'] . $img->url,
                    'thumb' => '//' . Yii::$app->params['fileStore'] . $img->url,
                    'title' => $img->caption,
                    'caption' => $img->caption,
                    'size' => $t[0] . 'x' . $t[1]
                ];
            }
        } // var_dump($images); exit;
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'images' => $images,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
//                var_dump($model);
//        exit;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        if (!Yii::$app->request->isPost) {
            unset($_SESSION['upload_files']);
        }
        
        $imagePrep = $model->imagePreparation();
        

        return $this->render('update', [
            'model' => $model,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function actionUpload() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileUpload('product', 'product');
    }

    public function actionRemovefile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileRemove();
    }
}

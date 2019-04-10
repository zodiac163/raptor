<?php

namespace common\modules\base\controllers;

use Yii;
use common\modules\base\models\KnowledgeBase;
use common\modules\base\models\KnowledgeBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RaptorHelper;

/**
 * KnowledgeBaseController implements the CRUD actions for KnowledgeBase model.
 */
class KnowledgeBaseController extends Controller
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
     * Lists all KnowledgeBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KnowledgeBaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KnowledgeBase model.
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
            'model' => $model,
            'images' => $images,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Creates a new KnowledgeBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KnowledgeBase();

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
     * Updates an existing KnowledgeBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
     * Deletes an existing KnowledgeBase model.
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
     * Finds the KnowledgeBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KnowledgeBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KnowledgeBase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_mod', 'PAGE_DOES_NOT_EXIST'));
    }
    
    public function actionUpload() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileUpload('base', 'knowledge-base');
    }

    public function actionRemovefile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileRemove();
    }
    
}

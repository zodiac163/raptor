<?php

namespace common\modules\base\controllers;

use Yii;
use common\modules\base\models\Journal;
use common\modules\base\models\JournalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RaptorHelper;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalController extends Controller
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
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JournalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Journal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $imagesSource = $model->image;
        $image = [];
        if ($imagesSource) {
            $imagesDecode = json_decode($imagesSource);
            foreach ($imagesDecode->urls as $img) {
                $t = getimagesize('http://' .Yii::$app->params['fileStore'] . $img->url);
                $image[] = [
                    'image' => '//' . Yii::$app->params['fileStore'] . $img->url,
                    'thumb' => '//' . Yii::$app->params['fileStore'] . $img->url,
                    'title' => $img->caption,
                    'caption' => $img->caption,
                    'size' => $t[0] . 'x' . $t[1]
                ];
            }
        } // var_dump($images); exit;

        //$model->checkHits();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'image' => $image
        ]);
    }

    /**
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Journal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        //var_dump($model->errors);
        //exit;

        return $this->render('create', [
            'model' => $model,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Updates an existing Journal model.
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
     * Deletes an existing Journal model.
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
     * Finds the Journal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('base_mod', 'PAGE_DOES_NOT_EXIST'));
    }
    
    public function actionUpload() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileUpload('base', 'journal');
    }

    public function actionRemovefile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileRemove();
    }
}

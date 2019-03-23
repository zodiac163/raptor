<?php

namespace common\modules\article\controllers;

use common\models\RaptorHelper;
use Yii;
use common\modules\article\models\Article;
use common\modules\article\models\ArticleSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
            'images' => $images
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        //Предзаполнение автора и сортировки
        $model->created_user_id = Yii::$app->user->id;
        //TODO: при таком подходе сортировка может быть не уникальной, надо заполнять это поле через триггер CREATE!!!
        $maxOrd = Article::find()->max('ordering');
        $model->ordering = $maxOrd ? ($maxOrd+1) : 0;
        //TODO: если не задан псевдоним, то сделать  транслитирацию заголовка

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        //Если не было сабмита, то чистим загруженные файлы перед показом чистой формы
        //Если был сабмит, то парсим массив изображений
        if (!Yii::$app->request->isPost) {
            unset($_SESSION['upload_files']);
        } else {
            $imagePrep = $model->imagePreparation();
        }

        return $this->render('create', [
            'model' => $model,
            'initialPreview' => isset($imagePrep) ? $imagePrep['initialPreview'] : [],
            'initialPreviewConfig' => isset($imagePrep) ? $imagePrep['initialPreviewConfig'] : []
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //Предзаполнение автора изменений
        $model->modified_user_id = Yii::$app->user->id;

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
     * Upload files
     * @return array
     */
    public function actionUpload() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileUpload();
    }

    public function actionRemovefile() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return RaptorHelper::fileRemove();
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('art_mod', 'The requested page does not exist.'));
    }
}

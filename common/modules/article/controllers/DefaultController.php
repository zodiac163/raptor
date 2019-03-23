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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $initialPreview = [];
        $initialPreviewConfig = [];
        //Предзаполнение автора и сортировки
        $model->created_user_id = Yii::$app->user->id;
        //TODO: при таком подходе сортировка может быть не уникальной, надо заполнять это поле через триггер CREATE!!!
        $maxOrd = Article::find()->max('ordering');
        $model->ordering = $maxOrd ? ($maxOrd+1) : 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        //Если не было сабмита, то чистим загруженные файлы перед показом чистой формы
        //Если был сабмит, то парсим массив изображений
        if (!Yii::$app->request->isPost) {
            unset($_SESSION['upload_files']);
        } else {
            //TODO: убрать логику из контроллера
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
            $images = json_decode($model->images);
            foreach ($images->urls as $image) {
                $initialPreview[] = $protocol . Yii::$app->params['fileStore'] . $image->url;
                $image->key = $image->url;
                $image->url = Url::to(['/article/default/removefile']);
                $initialPreviewConfig[] = $image;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

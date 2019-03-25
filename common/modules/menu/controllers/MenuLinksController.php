<?php

namespace common\modules\menu\controllers;

use Yii;
use common\modules\menu\models\MenuLinks;
use common\modules\menu\models\MenuLinksSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuLinksController implements the CRUD actions for MenuLinks model.
 */
class MenuLinksController extends Controller
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
     * Lists all MenuLinks models.
     * @return mixed
     */
    public function actionIndex($menu)
    {
        $searchModel = new MenuLinksSerach();
        $query = Yii::$app->request->queryParams;
        $query["MenuLinksSerach"]["menu_id"] = $menu;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menu' => $menu,
        ]);
    }

    /**
     * Displays a single MenuLinks model.
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
     * Creates a new MenuLinks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($menu)
    {
        $model = new MenuLinks();
        $model->menu_id = $menu;
        $model->created_user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'menu' => $menu,
        ]);
    }

    /**
     * Updates an existing MenuLinks model.
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
            'menu' => $model->menu_id,
        ]);
    }

    /**
     * Deletes an existing MenuLinks model.
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
     * Finds the MenuLinks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuLinks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuLinks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('menu_mod', 'The requested page does not exist.'));
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\modules\article\controllers;

use Yii;
use yii\web\Controller;
use common\modules\article\models\TagSearch;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
use common\modules\article\models\Tag;

/**
 * Description of TagController
 *
 * @author Custom
 */
class TagController extends Controller {

    public function actionIndex()
    {
        $searchModel = new TagSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);

    }

   public function actions() {
       return ArrayHelper::merge(parent::actions(), [
           'editTag' => [
                'class' => EditableColumnAction::class,     
                'modelClass' => Tag::class,               
                'outputValue' => function (){}
               ]
        ]);
    }

    public function actionDeletetag(){

        $id = Yii::$app->request->post('id');
        $model = Tag::findOne($id);
        $model->delete();

        return $this->redirect(['index']);
    }
}

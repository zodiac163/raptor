<?php
/**
 * Created by PhpStorm.
 * User: Zodiac
 * Date: 24.03.2019
 * Time: 16:42
 */
namespace common\modules\article\controllers;
use common\modules\article\models\ArticleSearch;
use common\modules\category\models\Category;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends Controller {

    public function actionList($category) {
        if ($category === null) {
            throw new NotFoundHttpException(Yii::t('art_mod', 'The requested page does not exist.'));
        }

        $catArray = Category::findByPath($category);
        $query = Yii::$app->request->queryParams; //var_dump($catArray); exit;
        $query["ArticleSearch"]['cat_id'] = $catArray;
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

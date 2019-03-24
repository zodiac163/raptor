<?php
/**
 * Created by PhpStorm.
 * User: Zodiac
 * Date: 24.03.2019
 * Time: 13:51
 */
namespace frontend\components\Pages;

use Yii;
use common\models\Route;
use yii\caching\DbDependency;
use yii\web\CompositeUrlRule;
use yii\web\UrlRuleInterface;
use yii\base\InvalidConfigException;

/**
 * Class PagesUrlRule
 *
 * @package frontend\components\Pages
 */
class PagesUrlRule extends CompositeUrlRule{

    public $cacheComponent = 'cache';

    public $cacheID = 'PagesUrlRules';

    public $ruleConfig = ['class' => 'yii\web\UrlRule'];

    /**
     * Creates the URL rules that should be contained within this composite rule.
     *
     * @return \yii\web\UrlRuleInterface[] the URL rules
     * @throws \yii\base\InvalidConfigException
     */
    protected function createRules()
    {

        $cache = \Yii::$app->get($this->cacheComponent)->get($this->cacheID);

        if($cache !== false)
            return $cache;

        $pages = Route::find()->asArray(true)->all();

        $rules = [];
        foreach ($pages as $page) {

            $rule = [
                'pattern' => ltrim($page['alias'], '/'),
                'route' => ltrim($page['route_path'], '/'),
                'defaults' => ['id' => ltrim($page['row_id'], '/')],
            ];


            $rule = \Yii::createObject(array_merge($this->ruleConfig, $rule));
            if (!$rule instanceof UrlRuleInterface) {
                throw new InvalidConfigException('URL rule class must implement UrlRuleInterface.');
            }
            $rules[] = $rule;
        }
        //echo "<pre>"; var_dump($rules); exit;
        $cd= new DbDependency();
        $cd->sql='SELECT MAX(last_update) FROM ' . Route::tableName();

        Yii::$app->get($this->cacheComponent)->set($this->cacheID, $rules, 0,$cd);

        return $rules;
    }

    public function __wakeup()
    {
        $this->init();
    }

}

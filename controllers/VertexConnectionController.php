<?php

namespace app\controllers;

use app\models\VertexConnection;
use Yii;
use yii\db\Query;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Содержит рёбра
 * Class VertexConnectionController
 * @package app\controllers
 */
class VertexConnectionController extends ActiveController
{
    public $modelClass = 'app\models\VertexConnection';
    /**
     * Создание ребра, получается данные:
     * Имя вершины, из которой выходит
     * Имя вершины, куда направлено
     * Вес(Стоимость)
     * @return string
     */
    public function actionCreateVertexConnection()
    {
        $model = new \app\models\VertexConnection();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                if ($model->save()) {
                    $this->refresh();
                }
            }
        }
        return array('status' => true, 'data'=> [$model->id, $model->name]);
    }

    /**
     * Удаление ребра по Вершинам, которые оно связывает:
     * Имя вершины, из которой выходит
     * Имя вершины, куда направлено
     * @return string
     */
    public function actionDeleteConnection()
    {
        $tableName = VertexConnection::tableName();
        /**
         * DELETE FROM $tableName vc
         * WHERE vc.vertex_from in (SELECT id FROM vertex WHERE name=$vertex_from_name)
         * AND vc.vertex_to in (SELECT id FROM vertex WHERE name=$vertex_to_name)
         */
        return $this->render('delete');
    }

    /**
     * Отображение всех ребёр:
     * Имя вершины, из которой выходит
     * Имя вершины, куда направлено
     * Вес(Стоимость)
     * @return string
     */
    public function actionShow()
    {
        $tableName = VertexConnection::tableName();
        /**
         * SELECT *
         * FROM $tableName
         * WHERE
         */
        $query = new Query();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json']
            =   Response::FORMAT_JSON;

        return $behaviors;
    }

}

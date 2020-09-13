<?php


namespace app\controllers;


use app\models\Vertex;
use yii\rest\ActiveController;
use yii\web\Response;

class VertexController extends ActiveController
{
    public $modelClass = 'app\models\Vertex';

    public function actionCreate()
    {
        $model = new Vertex();

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->refresh();
        }

        return $this->render('create', ['model' => $model]);
    }
//
//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['contentNegotiator']['formats']['application/json']
//            =   Response::FORMAT_JSON;
//
//        return $behaviors;
//    }
}
<?php


namespace app\controllers;


use app\models\Vertex;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class VertexController extends ActiveController
{
    public $modelClass = 'app\models\Vertex';

    public function actionCreateVertex()
    {
        $model = new \app\models\Vertex();

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
     * Тут ещё должен быть метод создания по массиву данных из POST,
     * но тк возникли проблемы, его нет,
     * Он будет похож на метод @see actionCreateVertex
    */
    public function actionDeleteVertex()
    {
        $attributes = \yii::$app->request->post();
        $vertex = Vertex::find()->where(['name' => $attributes['name']])->one();
        if (count($vertex) > 0) {
            $vertex->delete();
            return array('status' => true, 'data' => 'Vertex record is successfully deleted');
        }
    }

    public function actionDeleteAll()
    {
        $vertices = Vertex::deleteAll();
        return array('status' => true, 'data' => 'All vertices records are successfully deleted');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json']
            =   Response::FORMAT_JSON;

        return $behaviors;
    }
}
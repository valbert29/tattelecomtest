<?php

namespace app\controllers;

use app\models\Vertex;
use app\models\VertexConnection;
use Yii;
use yii\web\Controller;

class GraphController extends Controller
{
    public $shortpath = INF;

    public function execute()
    {
        $vertexFromName = Yii::$app->request->post()['vertex_from_name'];
        $vertexToName = Yii::$app->request->post()['vertex_to_name'];

        $vertexFromId = Vertex::find()->where(['name' => $vertexFromName])->one()->attributes['id'];
        $vertexToId = Vertex::find()->where(['name' => $vertexToName])->one()->attributes['id'];

        $connections = VertexConnection::find()->where(['vertex_from_id' => $vertexFromId])->all();

        foreach ($connections as $connection) {
            if (isset($passed)) {
                unset($passed);
            }

            $passed[$vertexFromId] = true;
            if ($vertexToId === $connection->attributes['vertex_to_id']) {
                $pathCost = $connection->attributes['cost'];
            } else {
                $pathCost = $connection->attributes['cost'] + $this->getShortestPath($connection->attributes['vertex_to_id'], $vertexToId, $passed);
            }
            $this->shortpath = $this->shortpath > $pathCost ?: $pathCost;
        }
    }

    public function getShortestPath($vertexFromId, $vertexToId, $passed)
    {
        /**
         * подаются id вершин
         * находим их id и их связи,
         * добавим первую вершину в массив "посещён"
         * через соединения находим
         * если vertex_to_name != To, то запускаем тот же метод, передаём vertex_from_name и To.
         */
        $connections = VertexConnection::find()->where(['vertex_from_id' => $vertexFromId])->all();
        foreach ($connections as $connection) {
            if (!in_array($connection->attributes['vertex_to_id'], array_keys($passed), true)) {
                $passed[$connection->attributes['vertex_to_id']] = true;
                if ($vertexToId === $connection->attributes['vertex_to_id']) {
                    return $connection->attributes['cost'];
                } else {
                     return $connection->attributes['cost'] + $this->getShortestPath(
                         $connection->attributes['vertex_to_id'],
                         $vertexToId,
                         $passed
                         );
                }
            }
        }
    }

}

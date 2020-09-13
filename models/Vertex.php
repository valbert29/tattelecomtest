<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vertex".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property VertexConnections[] $vertexConnections
 * @property VertexConnections[] $vertexConnections0
 */
class Vertex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vertex}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[VertexConnections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexConnections()
    {
        return $this->hasMany(VertexConnections::className(), ['vertex_from_id' => 'id']);
    }

    /**
     * Gets query for [[VertexConnections0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexConnections0()
    {
        return $this->hasMany(VertexConnections::className(), ['vertex_to_id' => 'id']);
    }
}

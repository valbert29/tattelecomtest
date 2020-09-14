<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vertex".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property VertexConnection[] $vertexConnection
 * @property VertexConnection[] $vertexConnection0
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
     * Gets query for [[VertexConnection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexConnection()
    {
        return $this->hasMany(VertexConnection::className(), ['vertex_from_id' => 'id']);
    }

    /**
     * Gets query for [[VertexConnection0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexConnection0()
    {
        return $this->hasMany(VertexConnection::className(), ['vertex_to_id' => 'id']);
    }
}

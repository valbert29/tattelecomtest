<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vertex_connections".
 *
 * @property int $id
 * @property int|null $vertex_from_id
 * @property int|null $vertex_to_id
 * @property int|null $cost
 *
 * @property Vertex $vertexFrom
 * @property Vertex $vertexTo
 */
class VertexConnection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vertex_connection}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vertex_from_id', 'vertex_to_id', 'cost'], 'default', 'value' => null],
            [['vertex_from_id', 'vertex_to_id', 'cost'], 'integer'],
            [['vertex_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vertex::className(), 'targetAttribute' => ['vertex_from_id' => 'id']],
            [['vertex_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vertex::className(), 'targetAttribute' => ['vertex_to_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vertex_from_id' => 'Vertex From ID',
            'vertex_to_id' => 'Vertex To ID',
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[VertexFrom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexFrom()
    {
        return $this->hasOne(Vertex::className(), ['id' => 'vertex_from_id']);
    }

    /**
     * Gets query for [[VertexTo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVertexTo()
    {
        return $this->hasOne(Vertex::className(), ['id' => 'vertex_to_id']);
    }
}

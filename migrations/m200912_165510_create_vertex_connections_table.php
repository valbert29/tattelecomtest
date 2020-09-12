<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vertex_connections}}`.
 */
class m200912_165510_create_vertex_connections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vertex_connections}}', [
            'id' => $this->primaryKey(),
            'vertex_from_id' => $this->integer(),
            'vertex_to_id' => $this->integer(),
            'cost' => $this->integer()
        ]);

        $this->addForeignKey(
            'FK_vertex_from_to_vertex',
            '{{%vertex_connections}}',
            'vertex_from_id',
            '{{%vertex}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_vertex_to_to_vertex',
            '{{%vertex_connections}}',
            'vertex_to_id',
            '{{%vertex}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK_vertex_from_to_vertex',
            '{{%vertex_connections}}'
        );

        $this->dropForeignKey(
            'FK_vertex_to_to_vertex',
            '{{%vertex_connections}}'
        );

        $this->dropTable('{{%vertex_connections}}');
    }
}

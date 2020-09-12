<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vertex}}`.
 */
class m200912_165338_create_vertex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vertex}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vertex}}');
    }
}

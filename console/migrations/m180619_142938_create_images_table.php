<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m180619_142938_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'class'=> $this->string(),
            'item_id'=> $this->integer(),
            'alt'=> $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('images');
    }
}

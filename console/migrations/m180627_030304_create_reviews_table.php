<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reviews`.
 */
class m180627_030304_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'category' => $this->integer(),
            'name'=> $this->string()->notNull(),
            'text'=>$this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reviews');
    }
}

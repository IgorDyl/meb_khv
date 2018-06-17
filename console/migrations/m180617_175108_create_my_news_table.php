<?php

use yii\db\Migration;

/**
 * Handles the creation of table `my_news`.
 */
class m180617_175108_create_my_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('my_news', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'text'=>$this->text()->null(),
            'date'=>$this->date()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('my_news');
    }
}

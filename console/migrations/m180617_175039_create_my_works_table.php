<?php

use yii\db\Migration;

/**
 * Handles the creation of table `my_works`.
 */
class m180617_175039_create_my_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('my_works', [
            'id' => $this->primaryKey(),
            'category'=> $this->integer()->notNull()->unique(),
            'name'=> $this->string()->notNull(),
            'text'=>$this->text()->null(),
            'date'=>$this->date()->null(),
            'photo'=>$this->binary()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('my_works');
    }
}

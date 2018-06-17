<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contacts`.
 */
class m180617_175155_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contacts', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'phone'=> $this->string(),
            'email'=> $this->string(),
            'address'=> $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('contacts');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200810_094520_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'username' => $this->string(100),
            'password' => $this->string(100),
            'position' => $this->string(150),
            'email' => $this->string(100),
            'address' => $this->text(),
            'content' => $this->text(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->upsert('{{%users}}', ['id' => 1,'name' => 'Super administrator',  'username' => 's-admin', 'password' => md5('1'), 'status' => 1], true);
        $this->upsert('{{%users}}', ['id' => 2,'name' => 'Administrator',  'username' => 'admin', 'password' => md5('1'), 'status' => 1], true);
        $this->upsert('{{%users}}', ['id' => 3,'name' => 'User', 'username' => 'user', 'password' => md5('1'), 'status' => 1], true);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}

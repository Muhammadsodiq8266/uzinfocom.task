<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%left_menu}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%left_menu}}`
 */
class m220218_105226_create_left_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%left_menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'parent_id' => $this->integer(),
            'url' => $this->string(100),
            'icon' => $this->string(50),
            'status' => $this->smallInteger()->defaultValue(1),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-left_menu-parent_id}}',
            '{{%left_menu}}',
            'parent_id'
        );

        // add foreign key for table `{{%left_menu}}`
        $this->addForeignKey(
            '{{%fk-left_menu-parent_id}}',
            '{{%left_menu}}',
            'parent_id',
            '{{%left_menu}}',
            'id',
            'CASCADE'
        );

        $this->upsert('{{%left_menu}}', ['id' => 2,'name' => 'Sozlamalar',  'parent_id' => null, 'icon' => 'fas fa-bahai', 'url' => '#', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 3,'name' => 'Foydalanuvchilar',  'parent_id' => 2, 'icon' => 'fas fa-user', 'url' => '/admin/users/index', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 4,'name' => 'Ruxsatlar',  'parent_id' => 2, 'icon' => 'fas fa-wrench', 'url' => '/admin/permission/index', 'status' => 1], true);

        $this->upsert('{{%left_menu}}', ['id' => 5,'name' => 'Bosh sahifa',  'parent_id' => null, 'url' => '#', 'icon' => 'fas fa-address-book', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 6,'name' => 'Murojaatlar',  'parent_id' => null, 'url' => '#', 'icon' => 'fas fa-adjust', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 7,'name' => 'Masalalar', 'parent_id' => null, 'url' => '#', 'icon' => 'fas fa-air-freshener', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 8,'name' => 'So\'rovlar', 'parent_id' => null, 'url' => '#', 'icon' => 'fas fa-align-center', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 9,'name' => 'Muddatni uzaytirish', 'parent_id' => 7, 'url' => '#', 'icon' => 'fas fa-align-justify', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 10,'name' => 'Ijrochini o\'zgartirish', 'parent_id' => 7, 'url' => '#', 'icon' => 'fas fa-align-left', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 11,'name' => 'Natijani tekshirish', 'parent_id' => 7, 'url' => '#', 'icon' => 'fas fa-atlas', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 12,'name' => 'Tasnifni o\'zgartirish', 'parent_id' => 8, 'url' => '#', 'icon' => 'fas fa-battery-three-quarters', 'status' => 1], true);
        $this->upsert('{{%left_menu}}', ['id' => 13,'name' => 'Cheklovni o\'zgartirish', 'parent_id' => 8, 'url' => '#', 'icon' => 'fas fa-binoculars', 'status' => 1], true);

        $this->upsert('{{%auth_item}}', ['name' => 'Sozlamalar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Foydalanuvchilar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Ruxsatlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Bosh sahifa', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Murojaatlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Masalalar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'So\'rovlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Muddatni uzaytirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Ijrochini o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Natijani tekshirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Tasnifni o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Cheklovni o\'zgartirish', 'type' => 2], true);

        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ruxsatlar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ruxsatlar', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Sozlamalar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Sozlamalar', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Foydalanuvchilar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Foydalanuvchilar', 'user_id' => 2], true);

        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Bosh sahifa', 'user_id' => 3], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Murojaatlar', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Masalalar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'So\'rovlar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Muddatni uzaytirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ijrochini o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Natijani tekshirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Tasnifni o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Cheklovni o\'zgartirish', 'user_id' => 1], true);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%left_menu}}`
        $this->dropForeignKey(
            '{{%fk-left_menu-parent_id}}',
            '{{%left_menu}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-left_menu-parent_id}}',
            '{{%left_menu}}'
        );

        $this->dropTable('{{%left_menu}}');
    }
}

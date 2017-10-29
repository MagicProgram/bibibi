<?php

use yii\db\Migration;

class m170324_092413_create_schools_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%schools}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'address' => $this->text(),
            'timetable' => $this->text(),
            'phone' => $this->string(),
            'active' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'age' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'city' => $this->string()->notNull(),
            'www' => $this->string(),
            'email' => $this->string(),
            'created' => $this->datetime(),
            'updated' => $this->datetime(),
            'general_image' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'h1' => $this->string(),
            'about' => $this->text(),

        ]);

        $this->createIndex('idx-schools-active', '{{%schools}}', 'active');

        // $this->addForeignKey('fk-schools-category', '{{%product}}', 'category_id', '{{%category}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%schools}}');
    }
}

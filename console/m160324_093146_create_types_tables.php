<?php

use yii\db\Migration;

class m160324_093146_create_types_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'h1' => $this->string(),
            'text' => $this->text(),
            'general_image' => $this->text(),
        ]);

        $this->createIndex('idx-types-name', '{{%types}}', 'name');

        $this->createTable('{{%schools_types}}', [
            'school_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-schools_types', '{{%schools_types}}', ['school_id', 'type_id']);

        $this->createIndex('idx-schools_types-school_id', '{{%schools_types}}', 'school_id');
        $this->createIndex('idx-schools_types-type_id', '{{%schools_types}}', 'type_id');

        $this->addForeignKey('fk-schools_types-school', '{{%schools_types}}', 'school_id', '{{%schools}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-schools_types-type', '{{%schools_types}}', 'type_id', '{{%types}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%schools_types}}');
        $this->dropTable('{{%types}}');
    }
}

<?php

use yii\db\Migration;

class m180524_094567_create_city_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'h1' => $this->string(),
            'text' => $this->text(),
            'fulltext' => $this->text(),
            'general_image' => $this->text(),
        ]);

        $this->createIndex('idx-date-name', '{{%city}}', 'name');

}

    public function down()
    {
               $this->dropTable('{{%city}}');
    }
}

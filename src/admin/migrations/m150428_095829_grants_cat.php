<?php

use yii\db\Migration;

class m150428_095829_grants_cat extends Migration
{
    public function safeUp()
    {
        $this->createTable('grants_cat', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('grants_cat');
    }
}

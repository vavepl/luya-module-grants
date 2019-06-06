<?php

use yii\db\Migration;

class m161212_084323_grants_add_teaser_field extends Migration
{
    public function safeUp()
    {
        $this->addColumn('grants_article', 'teaser_text', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('grants_article', 'teaser_text');
    }
}

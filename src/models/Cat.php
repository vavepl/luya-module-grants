<?php

namespace vavepl\grants\models;

use vavepl\grants\admin\Module;
use luya\admin\ngrest\base\NgRestModel;

/**
 * grants Category Model
 *
 * @author Basil Suter <basil@nadar.io>
 */
class Cat extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title'];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grants_cat';
    }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_DELETE, [$this, 'eventBeforeDelete']);
    }
    
    /**
     * @inheritdoc
     */
    public function eventBeforeDelete($event)
    {
        if (count($this->articles) > 0) {
            $this->addError('id', Module::t('cat_delete_error'));
            $event->isValid = false;
        }
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Module::t('cat_title'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-grants-cat';
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            [['list', 'create', 'update'], ['title']],
            [['delete'], true],
        ];
    }
    
    /**
     * Get articles for this category.
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['cat_id' => 'id']);
    }

    public function ngRestRelations()
    {
        return [
           ['label' => 'Articles', 'apiEndpoint' => Article::ngRestApiEndpoint(), 'dataProvider' => $this->getArticles()],
        ];
    }
}

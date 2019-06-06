<?php

namespace vavepl\grants\frontend\blocks;

use luya\cms\models\NavItem;
use vavepl\grants\models\Article;
use luya\cms\base\PhpBlock;

/**
 * Get the latest grants from the grants system.
 *
 * This block requires an application view file which is formated as followed.
 *
 * ```php
 * <?php foreach ($this->extraValue('items') as $item): ?>
 *     <?= $item->title; ?>
 * <?php endforeach; ?>
 * ```
 *
 * @author Basil Suter <basil@nadar.io>
 */
class LatestGrants extends PhpBlock
{
    private $_dropdown = [];

    public function icon()
    {
        return 'view_headline';
    }

    public function init()
    {
        foreach (NavItem::fromModule('grants') as $item) {
            $this->_dropdown[] = ['value' => $item->id, 'label' => $item->title];
        }
    }

    public function name()
    {
        return 'Grants: Latest Headlines';
    }

    public function config()
    {
        return [
            'cfgs' => [
                ['var' => 'limit', 'label' => 'Anzahl grants Einträge', 'type' => 'zaa-text'],
                ['var' => 'nav_item_id', 'label' => 'grantsseite für Detailansicht', 'type' => 'zaa-select', 'options' => $this->_dropdown],
            ],
        ];
    }

    public function extraVars()
    {
        return [
            'items' => Article::getAvailableGrants($this->getCfgValue('limit', 10)),
        ];
    }

    public function admin()
    {
        return '<ul>{% for item in extras.items %}<li>{{ item.title }}</li>{% endfor %}</ul>';
    }
}

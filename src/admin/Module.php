<?php

namespace vavepl\grants\admin;

use luya\admin\components\AdminMenuBuilder;

/**
 * grants Admin Module.
 *
 * @author Basil Suter <basil@nadar.io>
 */
final class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-grants-article' => 'vavepl\grants\admin\apis\ArticleController',
        'api-grants-cat' => 'vavepl\grants\admin\apis\CatController',
    ];

    /**
     * @inheritdoc
     */
    public function getMenu()
    {
        return (new AdminMenuBuilder($this))
            ->node('grants', 'local_library')
                ->group('grants_administrate')
                    ->itemApi('article', 'grantsadmin/article/index', 'edit', 'api-grants-article')
                    ->itemApi('cat', 'grantsadmin/cat/index', 'bookmark_border', 'api-grants-cat');
    }

    public static function onLoad()
    {
        self::registerTranslation('grantsadmin', '@grantsadmin/messages', [
            'grantsadmin' => 'grantsadmin.php',
        ]);
    }
    
    /**
     * Translat grants messages.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('grantsadmin', $message, $params);
    }
}

<?php

namespace vavepl\grants\tests;

use Yii;
use luya\testsuite\cases\WebApplicationTestCase;
use luya\testsuite\traits\MessageFileCompareTrait;
use luya\testsuite\traits\MigrationFileCheckTrait;

class GrantsTest extends WebApplicationTestCase
{
	use MessageFileCompareTrait, MigrationFileCheckTrait;
	
	public function getConfigArray()
	{
		return [
			'id' => 'grantstest',
			'basePath' => dirname(__DIR__),
			'modules' => [
				'grantsadmin' => 'luya\grants\admin\Module',
			],
			'components' => [
				'db' => [
					'class' => 'yii\db\Connection',
					'dsn' => 'fake',
				],
			]
		];
	}
	
	public function testMessageFiles()
	{
		$this->compareMessages(Yii::getAlias('@grantsadmin/messages'), 'en');
	}

	/*
	public function testMigrationFiles()
	{
		// missing mysqli config
		$this->checkMigrationFolder('@grantsadmin/migrations');
	}
	*/
}
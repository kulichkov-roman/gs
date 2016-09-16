<?php

class ExampleMigration extends \Your\Tools\Data\Migration\Bitrix\AbstractIBlockMigration
{
	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		$this->createIBlock(
			array(
				'NAME'           => 'Тестовый инфоблок',
				'CODE'           => 'test',
				'IBLOCK_TYPE_ID' => 'example',
				'SITE_ID'        => array('s1'),
				'GROUP_ID'       => array('2' => 'R')
			)
		);
	}

	/**
	 * Отменяет миграцию
	 */
	public function down()
	{
		$this->deleteIBlock(1);
	}
}

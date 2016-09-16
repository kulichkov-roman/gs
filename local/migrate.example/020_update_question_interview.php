<?php
/**
 * Добавляет свойтсва в инфоблоке опроса
 */
define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'rehau.pro';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

while (ob_get_level()) {
	ob_end_flush();
}

if (!CModule::IncludeModule('iblock')) {
	die('Unable to include "iblock" module');
}

class CreateAdditionalPropsForInterviewIblock extends \Your\Tools\Data\Migration\Bitrix\AbstractIBlockPropertyMigration
{
	/**
	 * @var array
	 */
	protected $properties;

	public function __construct()
	{
		$iBlockId = \Your\Environment\EnvironmentManager::getInstance()->get('interviewIblockId');

		parent::__construct($iBlockId);

		$this->properties = array(
			'ANSWER_TYPE' => 'Тип опроса'
		);
	}

	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		foreach ($this->properties as $code => $name) {
			$arAdditionalFields = array(
				'ACTIVE' => 'Y',
				'SEARCHABLE' => 'N',
				'FILTRABLE' => 'N',
				'MULTIPLE' => 'N',
			);

			$arValues = array(
				Array(
					"VALUE" => "Можно выбрать только один ответ ",
					"DEF" => "Y",
					"SORT" => "100",
					"XML_ID" => 'radio'
				),
				Array(
					"VALUE" => "Можно выбрать несколько ответов",
					"DEF" => "N",
					"SORT" => "200",
					"XML_ID" => 'checkbox'
				),
				Array(
					"VALUE" => "Дать свой ответ",
					"DEF" => "N",
					"SORT" => "300",
					"XML_ID" => 'input'
				)
			);

			$this->createSelectProperty(
				$name,
				$code,
				$arAdditionalFields,
				$arValues
			);

			echo sprintf('Property "%s" has been added', $code) . PHP_EOL;
		}
	}

	/**
	 * Отменяет миграцию
	 */
	public function down()
	{
		throw new \Your\Exception\Common\NotImplementedException('Method "down" was not implement');
	}
}

$migration = new CreateAdditionalPropsForInterviewIblock();

try {
	$migration->up();
} catch (\Your\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}

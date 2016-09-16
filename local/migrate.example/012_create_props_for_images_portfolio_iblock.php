<?php
/**
 * Добавляет свойтсва в инфоблок портфолио
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

class CreatePropsForPortfolioIblock extends \Your\Tools\Data\Migration\Bitrix\AbstractIBlockPropertyMigration
{
	/**
	 * @var array
	 */
	protected $properties;
	protected $numericProperties;

	public function __construct()
	{
		$iBlockId = \Your\Environment\EnvironmentManager::getInstance()->get('imagesworkIblockId');

		parent::__construct($iBlockId);

		$this->properties = array(
			'PUBLIC_ELEMENT' => 'Опубликован (разместить на главной странице)',
			'APPROVE_ELEMENT' => 'Одобрен (разрешить разместить на главной странице)',
		);

		$this->numericProperties = array(
			'WORK_ID' => 'Id Альбома',
		);
	}

	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		foreach ($this->properties as $code => $name) {
			$this->createStringProperty(
				$name,
				$code,
				array(
					'ACTIVE' => 'Y',
					'SEARCHABLE' => 'N',
					'FILTRABLE' => 'Y',
				)
			);

			echo sprintf('Property "%s" has been added', $code) . PHP_EOL;
		}

		foreach ($this->numericProperties as $code => $name) {
			$this->createNumericProperty(
				$name,
				$code,
				array(
					'ACTIVE' => 'Y',
					'SEARCHABLE' => 'N',
					'FILTRABLE' => 'Y',
				)
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

$migration = new CreatePropsForPortfolioIblock();

try {
	$migration->up();
} catch (\Your\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}

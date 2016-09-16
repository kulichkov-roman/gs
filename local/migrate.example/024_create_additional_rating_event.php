<?php
/**
 * Добавляет дополнительное события для зачисления рейтинга
 */
use Quetzal\Tools\Data\Migration\Common\MigrationInterface;

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

/**
 * Class CreateNewEventForRating
 */
class CreateNewEventForRating implements MigrationInterface
{
	/**
	 * @var int
	 */
	protected $iblockId;

	/**
	 * @var \Your\Tools\LoggerInterface
	 */
	private $logger;

	public function __construct()
	{
		$this->iblockId = \Your\Environment\EnvironmentManager::getInstance()->get('ratingDescriptionIBlockId');
		$this->logger = new \Your\Tools\Logger\EchoLogger();
	}

	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		$manager = \Your\Data\Bitrix\IBlockElementManager::getInstance();

		// Add a new items
		$items = array(
			array(
				'NAME'            => 'Дополнительные баллы',
				'PROPERTY_VALUES' => array(
					'VAL' => 'empty',
				),
			),
		);

		foreach ($items as $arItem) {
			$arItem['IBLOCK_ID'] = $this->iblockId;

			if ($id = $manager->add($arItem)) {
				$this->logger->log(sprintf('Item "%s" (%s) has been added', $arItem['NAME'], $id));
			} else {
				$this->logger->log(sprintf('Unable to add item "%s": %s', $arItem['NAME']));
			}
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

$migration = new CreateNewEventForRating();

try {
	$migration->up();
} catch (\Your\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}

<?php
/**
 * Создает тип инфоблока "Информация"
 *
 * @global $APPLICATION CMain
 */
use Quetzal\Tools\Data\Migration\Bitrix\AbstractIBlockMigration;

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'llmanikur.ru';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

while (ob_get_level()) {
	ob_end_flush();
}

if (!CModule::IncludeModule('iblock')) {
	echo 'Unable to include iblock module';
	exit;
}

/**
 * Создает тип инфоблока "Информация"
 *
 * Class CreateInfoIBlockTypeMigration
 */
class CreateInfoIBlockTypeMigration extends AbstractIBlockMigration
{
	/**
	 * {@inheritdoc}
	 */
	public function up()
	{
		$logger = new \Your\Tools\Logger\EchoLogger();

		try {
			$this->createIBlockType(
				array(
					'ID' => 'info',
					'SECTIONS' => 'Y',
					'IN_RSS' => 'N',
					'SORT' => 100,
					'LANG' => array(
						'en' => array(
							'NAME' => 'Information',
						),
						'ru' => array(
							'NAME' => 'Информация',
						),
					)
				)
			);

			$logger->log('IBlock type "info" has been created');
		} catch (\Your\Exception\Data\Migration\MigrationException $exception) {
			$logger->log(sprintf('ERROR: %s', $exception->getMessage()));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function down()
	{
		$logger = new \Your\Tools\Logger\EchoLogger();

		try {
			$this->deleteIBlockType('info');

			$logger->log('IBlock type "info" has been deleted');
		} catch (\Your\Exception\Data\Migration\MigrationException $exception) {
			$logger->log(sprintf('ERROR: %s', $exception->getMessage()));
		}
	}
}

$migration = new CreateInfoIBlockTypeMigration();
$migration->up();

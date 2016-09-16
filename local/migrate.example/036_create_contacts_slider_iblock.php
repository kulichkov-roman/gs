<?php
/**
 * Создает инфоблок «Контакты»
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
 * Создает инфоблок «Контакты»
 *
 * Class CreateHeroSliderIBlockMigration
 */
class CreateHeroSliderIBlockMigration extends AbstractIBlockMigration
{
	/**
	 * {@inheritdoc}
	 */
	public function up()
	{
		$logger = new \Your\Tools\Logger\EchoLogger();

		try {
			$this->createIBlock(
				array(
					'ACTIVE'           => 'Y',
					'NAME'             => 'Контакты',
					'CODE'             => 'contactsSlider',
					'IBLOCK_TYPE_ID'   => 'info',
					'SITE_ID'          => array('s1'),
					'SORT'             => 500,
					'DESCRIPTION_TYPE' => 'text',
					'GROUP_ID'         => array('2' => 'R'),
					'VERSION'          => 2,
					'FIELDS'           => array(
						'PREVIEW_PICTURE'  => array(
							'IS_REQUIRED' => 'Y',
						),
					),
				)
			);

			$logger->log(
				sprintf('IBlock has been created. Id: "%s". Add to "contactsSliderIBlockId"', $this->iblockId)
			);
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

		$this->deleteIBlock($environment->get('contactsSliderIBlockId'));

		$logger->log(sprintf('IBlock sliderHero has been removed. Id: "%s"', $this->iblockId));
	}
}

$migration = new CreateHeroSliderIBlockMigration();
$migration->up();

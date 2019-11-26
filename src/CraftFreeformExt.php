<?php
/**
 * CraftFreeformExt plugin for Craft CMS 3.x
 *
 * Texas Baptists Craft Freeform Extension
 *
 * @link      texasbaptists.com
 * @copyright Copyright (c) 2019 Texas Baptists
 */

namespace texasbaptists\craftfreeformext;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

use \Solspace\Freeform\Services\FormsService;
use \Solspace\Freeform\Events\Forms\FormRenderEvent;
use \Solspace\Freeform\Services\SubmissionsService;
use \Solspace\Freeform\Events\Submissions\SubmitEvent;
use \Solspace\Freeform\Services\CrmService;
use \Solspace\Freeform\Events\Integrations\PushEvent;
use \Solspace\Freeform\Events\Integrations\SaveEvent;

/**
 * Class CraftFreeformExt
 *
 * @author    Texas Baptists
 * @package   CraftFreeformExt
 * @since     1.0.0
 *
 */
class CraftFreeformExt extends Plugin
{
	// Static Properties
	// =========================================================================

	/**
	 * @var CraftFreeformExt
	 */
	public static $plugin;

	// Public Properties
	// =========================================================================

	/**
	 * @var string
	 */
	public $schemaVersion = '1.0.0';

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		self::$plugin = $this;

		Event::on(
			Plugins::class,
			Plugins::EVENT_AFTER_INSTALL_PLUGIN,
			function (PluginEvent $event) {
				if ($event->plugin === $this) {
				}
			}
		);

		Craft::info(
			Craft::t(
				'craft-freeform-ext',
				'{name} plugin loaded',
				['name' => $this->name]
			),
			__METHOD__
		);

		// Salesforce Lead Integration
		Event::on(
			CrmService::class,
			CrmService::EVENT_BEFORE_PUSH,
			function (PushEvent $event) {
				// how to get the sf integration: $integration = $event->getIntegration();
				// how to get the values: $values = $event->getValues();
				$event->addValue('recordTypeId', $_POST['recordTypeId']);
				if ($_POST['Company'] ?? false) {
					$event->addValue('Company', $_POST['Company']);
				} else {
					$event->addValue('Company', 'Individual');
				}
			}
		);
   }
}

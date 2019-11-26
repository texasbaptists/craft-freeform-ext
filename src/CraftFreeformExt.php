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

		// salesforce integration
		Event::on(
			CrmService::class,
			CrmService::EVENT_BEFORE_PUSH,
			function (PushEvent $event) {
				//$integration = $event->getIntegration();
				//$values = $event->getValues();
				$event->addValue('recordTypeId', $_POST['recordTypeId']);
				if ($_POST['salesforceCompany'] ?? false) {
					$event->addValue('salesforceCompany', $_POST['salesforceCompany']);
				} else {
					$event->addValue('salesforceCompany', 'Individual');
				}
				//$event->addValue('salesforceCompany', 'Individual');
			}
		);

		// form display
		/*Event::on(
			FormsService::class,
			FormsService::EVENT_RENDER_CLOSING_TAG,
			function (FormRenderEvent $event) {
				$submission = $event->getElement();
				$form       = $event->getForm();
				// Do something with this data
				Craft::dd($form);
			}
		);*/

		// submissions
		/*Event::on(
			SubmissionsService::class,
			SubmissionsService::EVENT_BEFORE_SUBMIT,
			function (SubmitEvent $event) {
				$submission = $event->getElement();
				$form       = $event->getForm();
				// Do something with this data
				Craft::dd($form);
			}
		);*/

   }

	// Protected Methods
	// =========================================================================

}

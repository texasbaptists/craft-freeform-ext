<?php

namespace texasbaptists\craft3freeformext;
namespace Craft;

class FreeformExt extends BasePlugin {
    public function init() {
        parent::init();

        Event::on(
            CrmService::class,
            CrmService::EVENT_BEFORE_PUSH,
            function (SaveEvent $event) {
                $integrationModel = $event->getModel();
                $values = $event->getValues();
                print_r($values); die();
            }
        );

    }
}

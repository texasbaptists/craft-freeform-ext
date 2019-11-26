# CraftFreeformExt plugin for Craft CMS 3.x

Texas Baptists Craft Freeform Extension

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require texasbaptists/craft-freeform-ext

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for CraftFreeformExt.

## CraftFreeformExt Overview

This plugin adds Company=Individual and a RecordTypeId to CRM Integrations in Freeform.

## Configuring CraftFreeformExt

In Freeform, add a hidden field with the handle `recordTypeId`. When building a form that needs to go to Salesforce as a Lead, add this field with the recordTypeId that Salesforce needs to make the Lead Type correct.  

## CraftFreeformExt Roadmap

Brought to you by [Texas Baptists](texasbaptists.org)

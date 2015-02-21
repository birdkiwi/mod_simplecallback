<?php
// no direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once( dirname(__FILE__) . '/helper.php' );

$mod_simplecallback = modSimpleCallbackHelper::getHello($params);

require JModuleHelper::getLayoutPath('mod_simplecallback', $params->get('layout', 'default'));
?>
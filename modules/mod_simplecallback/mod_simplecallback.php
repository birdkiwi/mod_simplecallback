<?php
// no direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once( dirname(__FILE__) . '/helper.php' );
$app = JFactory::getApplication();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$captcha_enabled = $params->get('simplecallback_captcha', 0);

if (\Joomla\CMS\Plugin\PluginHelper::isEnabled('captcha') && $captcha_enabled === '2') {
    $plugin = \Joomla\CMS\Plugin\PluginHelper::getPlugin('captcha');
    $captcha_params = new \Joomla\Registry\Registry($plugin[0]->params);

    $captcha_pubkey = $captcha_params->get('public_key');
    $catcha_privkey = $captcha_params->get('private_key');
    $captcha_theme2 = $captcha_params->get('theme2');
    $captcha_size = $captcha_params->get('size');

    if (!empty($captcha_pubkey) && !empty($catcha_privkey))
    {
        \Joomla\CMS\Plugin\PluginHelper::importPlugin('captcha');

        $result = $app->triggerEvent('onInit', array('dynamic_recaptcha_' . $module->id));
    }
}

require JModuleHelper::getLayoutPath('mod_simplecallback', $params->get('layout', 'default'));

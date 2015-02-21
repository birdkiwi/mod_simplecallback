<?php
/**
 * Helper class for Simple Callback module
 *
 * @link http://startler.ru/joomla/
 * @license        GNU/GPL, see LICENSE.php
 * mod_simplecallback is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modSimpleCallbackHelper
{
    public static function getAjax()
    {
        jimport('joomla.application.module.helper');
        $config = JFactory::getConfig();
        $module = JModuleHelper::getModule('mod_simplecallback');
        $params = new JRegistry();
        $params->loadString($module->params);
        $app = JFactory::getApplication();
        $input = JFactory::getApplication()->input;
        $data = $input->post->getArray();
        // Load language
        $app->getLanguage()->load('mod_simplecallback');
        // Set Email params
        $sender = $params->get('simplacallback_mailsender');
        $fromname = $params->get('simplacallback_emailfrom');
        $recipients_array = explode(";", $params->get('simplecallback_emails'));
        $recipients = !empty($recipients_array) && !empty($recipients_array[0]) ? $recipients_array : array($config->get('mailfrom'), $config->get('fromname'));
        $subject = $params->get('simplacallback_email_subject');

        $phone = $data['simplecallback_phone'];
        $name = $data['simplecallback_name'];
        $body = "\n Name: " . $name . "\nNummer: " . $phone;
        // Prepare and send Email
        $mail = JFactory::getMailer();
        $mail->addRecipient($recipients);

        if (!empty($sender)) {
            $mail->setSender(array($sender, $fromname));
        } else {
            $sender = array(
                $config->get( 'config.mailfrom' ),
                $config->get( 'config.fromname' )
            );

            $mail->setSender($sender);
        }

        $mail->setSubject($subject);
        $mail->setBody($body);
        $sent = $mail->Send();
        if (true == $sent)
        {
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'error' => false,
                'message' => JText::_('MOD_SIMPLECALLBACK_AJAX_MSG_SUCCESS')
            ));
            die();
        }
        else
        {
            echo json_encode(array(
                'success' => false,
                'error' => true,
                'message' => JText::_('MOD_SIMPLECALLBACK_AJAX_MSG_ERROR')
            ));
            die();
        }
    }
}
?>
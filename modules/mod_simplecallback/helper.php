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

/**
 * TODO: sms-gate
 */
class modSimpleCallbackHelper
{
    public static function getAjax()
    {
        jimport('joomla.application.module.helper');
        $config = JFactory::getConfig();
        $app = JFactory::getApplication();
        $input = JFactory::getApplication()->input;
        $data = $input->post->getArray();
        $session = JFactory::getSession();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'title', 'params')));
        $query->from($db->quoteName('#__modules'));
        $query->where($db->quoteName('id') . '='. $data['module_id']);
        $db->setQuery($query);
        $module = $db->loadObjectList()[0];
        $params = new JRegistry();
        $params->loadString($module->params);

        //CAPTCHA
        $captcha_enabled = $params->get('simplecallback_captcha', 0);

        if ($captcha_enabled === "1") {
            if ($session->get('module-'.$module->id) != $data['simplecallback_captcha']) {
                echo json_encode(array(
                    'success' => false,
                    'error' => true,
                    'message' => $params->get('simplacallback_captcha_error_msg', JText::_( 'MOD_SIMPLECALLBACK_CAPTCHA_MSG_ERROR_DEFAULT' ))
                ));
                die();
            } else {
                $session->clear('module-'.$module->id);
            }
        }

        //Token check
        $session->checkToken() or die( 'Invalid Token' );

        // Load language
        $app->getLanguage()->load('mod_simplecallback');
        // Set Email params

        //Not using this 2 params at moment, but maybe in future
        $sender = $params->get('simplecallback_mailsender');
        $fromname = $params->get('simplecallback_emailfrom');

        $recipients_array = explode(";", $params->get('simplecallback_emails'));
        $recipients = !empty($recipients_array) && !empty($recipients_array[0]) ? $recipients_array : array($config->get('mailfrom'), $config->get('fromname'));
        $subject = $params->get('simplecallback_email_subject');
        $client_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        $phone = $data['simplecallback_phone'];
        $name = $data['simplecallback_name'];
        $body = "\n" . $params->get('simplecallback_name_field_label') . ": " . $name;
        $body .= "\n" . $params->get('simplecallback_phone_field_label') . ": " . $phone;
        $body .= "\n IP: " . $client_ip;
        $body .= "\n\n " . date('d.m.Y H:i');
        // Prepare and send Email
        $mail = JFactory::getMailer();
        $mail->addRecipient($recipients);

        if (!empty($sender)) {
            $mail->setSender(array($sender, $fromname));
        } else {
            $sender = array(
                $config->get( 'mailfrom' ),
                $config->get( 'fromname' )
            );

            $mail->setSender($sender);
        }

        $mail->setSubject($subject);
        $mail->setBody($body);
        $sent = $mail->Send();
        //debug :) $sent = true;
        if (true == $sent)
        {
            http_response_code(200);
            echo json_encode(array(
                'success' => true,
                'error' => false,
                'message' => $params->get('simplacallback_ajax_success_msg', JText::_( 'MOD_SIMPLECALLBACK_AJAX_MSG_SUCCESS_DEFAULT' ))
            ));
            die();
        }
        else
        {
            echo json_encode(array(
                'success' => false,
                'error' => true,
                'message' => $params->get('simplacallback_ajax_error_msg', JText::_( 'MOD_SIMPLECALLBACK_AJAX_MSG_ERROR_DEFAULT' ))
            ));
            die();
        }
    }
}
?>
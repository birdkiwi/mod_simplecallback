<?php
// No direct access
defined('_JEXEC') or die;
$app = JFactory::getApplication();
JHtml::_('jquery.framework');
$menu = $app->getMenu()->getActive()->id;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'media/mod_simplecallback/css/simplecallback.css');
$document->addScript(JUri::base() . 'media/mod_simplecallback/js/simplecallback.js');
JHTML::_('behavior.formvalidation');
$overlayed = $params->get('simplecallback_overlay');
$message_enabled = $params->get('simplecallback_message', 0);
$captcha_enabled = $params->get('simplecallback_captcha', 0);
$phone_mask = $params->get('simplecallback_phone_field_mask');
$header_tag = $params->get('header_tag', 'h3');
$header_class = $params->get('header_class', '');
$show_title = $module->showtitle;
?>

<form
    id="simplecallback-<?php echo $module->id; ?>"
    action="<?php echo JURI::root(); ?>index.php?option=com_ajax&module=simplecallback&format=json"
    class="uk-form-stacked simplecallback<?php echo $moduleclass_sfx ?> <?php if ($overlayed == 1) { echo "simplecallback-overlayed"; } ?>"
    method="post"
    <?php if (!empty($phone_mask) && $phone_mask != '') { echo "data-simplecallback-phone-mask='$phone_mask'"; } ?>
    data-simplecallback-form
    <?php if ($overlayed == 1) { echo "data-simplecallback-form-overlayed"; } ?>
    data-simplecallback-form-error-msg="<?php echo $error_msg; ?>"
>

    <?php if ($overlayed == 1) :?>
        <div class="simplecallback-loading-svg">
            <?php include JPATH_SITE . '/media/mod_simplecallback/images/loading.svg'; ?>
        </div>
        <div class="simplecallback-close" data-simplecallback-close>&times;</div>
        <?php if ($module->showtitle) {
            echo "<$header_tag class='$header_class'>$module->title</$header_tag>";
        } ?>
    <?php endif; ?>

    <div class="uk-margin-bottom">
        <label class="uk-form-label uk-text-left">
            <?php echo $params->get('simplecallback_name_field_label'); ?>
        </label>
        <div class="uk-form-controls">
            <input type="text" name="simplecallback_name" required class="uk-input">
        </div>
    </div>
    <div class="uk-margin-bottom">
        <label class="uk-form-label uk-text-left">
            <?php echo $params->get('simplecallback_phone_field_label'); ?>
        </label>
        <div class="uk-form-controls">
            <input type="text" name="simplecallback_phone" required class="uk-input">
        </div>
    </div>

    <?php if ($message_enabled == 1) : ?>
        <div class="uk-margin-bottom">
            <label class="uk-form-label uk-text-left">
                <?php echo $params->get('simplecallback_message_field_label'); ?>
            </label>
            <div class="uk-form-controls">
                <textarea name="simplecallback_message" class="uk-textarea" style="height: 80px; resize: vertical;"></textarea>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($captcha_enabled == 1) : ?>
        <div class="uk-margin-bottom uk-text-left">
            <img src="<?php echo JUri::base() . 'modules/mod_simplecallback/captcha.php?id=' . $module->id; ?>" width="150" height="40" alt="captcha" class="simplecallback-captcha">
            <input type="text" name="simplecallback_captcha" required class="uk-input" autocomplete="off" />
        </div>
    <?php endif; ?>

    <div class="control-group">
        <input type="text" name="simplecallback_username" class="simplecallback-username" maxlength="10">
        <?php echo JHtml::_( 'form.token' ); ?>
        <input type="hidden" name="module_id" value="<?php echo $module->id; ?>" />
        <input type="hidden" name="Itemid" value="<?php echo $menu; ?>">
        <input type="hidden" name="simplecallback_page_title" value="<?php echo $document->getTitle(); ?>">
        <input type="hidden" name="simplecallback_page_url" value="<?php echo JUri::getInstance()->toString(); ?>">
        <input type="hidden" name="simplecallback_custom_data" value="">
        <button type="submit" class="uk-button uk-button-primary uk-width-1-1"><?php echo $params->get('simplecallback_submit_field_label'); ?></button>
    </div>
</form>

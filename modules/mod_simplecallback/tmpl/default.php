<?php
// No direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'media/mod_simplecallback/css/simplecallback.css');
$document->addScript(JUri::base() . 'media/mod_simplecallback/js/simplecallback.js');
JHTML::_('behavior.formvalidation');
?>

<form action="index.php?option=com_ajax&module=simplecallback&format=json" class="form-inline simplecallback<?php echo $moduleclass_sfx ?>" method="post" data-simplecallback-form>
    <div class="control-group">
        <label>
            <?php echo $params->get('simplecallback_name_field_label'); ?>
            <input type="text" name="simplecallback_name" required class="input-block-level" />
        </label>
    </div>
    <div class="control-group">
        <label>
            <?php echo $params->get('simplecallback_phone_field_label'); ?>
            <input type="text" name="simplecallback_phone" required class="input-block-level" />
        </label>
    </div>
    <div class="control-group">
        <input type="hidden" name="module_id" value="<?php echo $module->id; ?>" />
        <button type="submit" class="btn"><?php echo $params->get('simplecallback_submit_field_label'); ?></button>
    </div>
</form>
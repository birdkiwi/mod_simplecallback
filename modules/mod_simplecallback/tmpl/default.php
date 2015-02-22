<?php
// No direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'media/mod_simplecallback/css/simplecallback.css');
$document->addScript(JUri::base() . 'media/mod_simplecallback/js/simplecallback.js');
JHTML::_('behavior.formvalidation');
$overlayed = $params->get('simplecallback_overlay');
?>

<form id="simplecallback-<?php echo $module->id; ?>" action="index.php?option=com_ajax&module=simplecallback&format=json" class="form-inline simplecallback<?php echo $moduleclass_sfx ?> <?php if ($overlayed == 1) { echo "simplecallback-overlayed"; } ?>" method="post" data-simplecallback-form <?php if ($overlayed == 1) { echo "data-simplecallback-form-overlayed style='display: none;'"; } ?>>
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
        <?php echo JHtml::_( 'form.token' ); ?>
        <input type="hidden" name="module_id" value="<?php echo $module->id; ?>" />
        <button type="submit" class="btn"><?php echo $params->get('simplecallback_submit_field_label'); ?></button>
    </div>
</form>
<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<?php foreach ($items as $item): ?>
<label>
	<?php $checked = ($item->value == $value); ?>
	<input type="radio" <?php if($checked) echo 'checked'; ?> class="vp-input<?php if($checked) echo " checked"; ?>" name="<?php echo $name; ?>" value="<?php echo $item->value; ?>" />
	<i class="socicon <?php echo $item->value; ?> vp-js-tipsy icon-item" original-title="<?php echo ucfirst( str_replace( 'socicon-', '', $item->label ) ); ?>"></i>
    <?php /*?><img src="<?php echo VP_Util_Res::img($item->img); ?>" alt="<?php echo $item->label; ?>" class="vp-js-tipsy image-item" style="<?php VP_Util_Text::print_if_exists($item_max_width, 'max-width: %spx; '); ?><?php VP_Util_Text::print_if_exists($item_max_height, 'max-height: %spx; '); ?>" original-title="<?php echo $item->label; ?>" /><?php */?>
</label>
<?php endforeach; ?>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>
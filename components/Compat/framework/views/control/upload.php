<?php 

if( !$is_compact )
	echo UK_View::instance()->load( 'control/template_control_head', $head_info );
	
?>


<input class="uk-input vp-input" type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" readonly />

<div class="buttons">
	<input class="uk-js-upload uk-button vp-js-upload vp-button button" type="button" value="<?php _e( 'Choose a File', 'uberkit' ); ?>" />
	<input class="uk-js-remove-upload uk-button vp-js-remove-upload vp-button button" type="button" value="x" />
</div>

<div class="image">
	<img src="<?php echo $preview ?>" alt="" />
</div>

<?php 

if( !$is_compact ) 
	echo UK_View::instance()->load( 'control/template_control_foot' );

?>
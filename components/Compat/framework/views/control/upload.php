<?php 

if( !$is_compact )
	echo UK_View::instance()->load( 'control/template_control_head', $head_info );
	
?>

<input class="uk-input vp-input" type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" readonly />

<?php

$class = 'uk-hide';

if( !$preview ) 
	$class = 'uk-show';
	
?>

<div class="buttons <?php echo $class; ?>">
    <button class="uk-js-upload uk-button button button-large">
        <span class="dashicons dashicons-cloud"></span>
        <?php _e( 'Select a File', 'uberkit' ); ?>
    </button>
</div>

<?php

$class = 'uk-hide';

if( $preview ) 
	$class = 'uk-show';
	
?>

<div class="image <?php echo $class; ?>">
    <div class="uk-image-overlay">
        <div class="buttons">
            <button class="uk-js-upload uk-button button button-large">
                <span class="dashicons dashicons-cloud"></span>
                <?php _e( 'Select a File', 'uberkit' ); ?>
            </button>
            <button class="uk-js-remove-upload uk-button button button-large">
                <span class="dashicons dashicons-trash"></span>
            </button>
        </div>
    </div>
    <img src="<?php echo $preview ?>" alt="<?php _e( 'Preview', 'uberkit' ); ?>" />
</div>

<?php 

if( !$is_compact ) 
	echo UK_View::instance()->load( 'control/template_control_foot' );

?>
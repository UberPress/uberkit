<div class="uk-widget-settings uk-widget-settings-accordion">

	<?php
	$desc = $this->widget_options['description']; 
	
	if( $desc )       
		echo '<p class="desc">' . $desc . '</p>';
		
	?>

<?php

    $options = $this->getOptions();

    foreach($options as $sectionKey => $section)
    {
?>
        <h3 class="uk-widget-settings-accordion-trigger"><?php echo $section['label'] ?></h3>
            
        <div class="uk-widget-settings-accordion-view">
            <?php echo $this->_renderOptions($section['options']); ?>
        </div>
    <?php
}

?>
            
</div>
<?php

namespace UK\Component\Widget;

class Base
{
    protected $_baseUrl;

    public function __construct($uk, $data)
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );

        $this->_baseUrl = $data['url'];
    }

    /**
     * Register and enqueue assets.
     *
     * @since  0.5.0
     * @access public
     */
    public function assets( $slug ) {
        
        // Only on widgets page
        if ( $slug == 'widgets.php' ) {
            
            $assetsUrl = $this->_baseUrl . 'assets/';

            wp_enqueue_style( 'uk-admin-widgets', $assetsUrl . 'css/widgets.css', false, '0.6.0' );
            wp_enqueue_script( 'uk-admin-widgets', $assetsUrl . 'js/widgets.js', array( 'jquery' ), '0.6.0', false );

            wp_localize_script('uk-admin-widgets', '_uk_admin_widgets', array(
                'label_other' => __('Other Settings', 'uberkit'),
            ));
            
        }
    }
}
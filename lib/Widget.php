<?php

namespace UK;

class Widget extends \WP_Widget {

    protected $_options = array();

    protected $_renderer;

    public static function getInstanceById($id)
    {
        
		global $wp_registered_widgets;

        /**
         * WHO OF THOSES RETARDED CORE DEVELOPERS
         * DIDN'T GET THE CONCEPT OF OO WHEN IMPLEMENTING
         * THE WIDGET SYSTEM???
         *
         * WHY IS THERE A SHARED WIDGET CLASS INSTANCE
         * AMONG ALL VIRTUAL WIDGET "INSTANCES"
         * 
         * WHY DOES ONE NEED TO CALL "_set" ON THE WIDGET
         * CLASS INSTANCE TO TELL THE WIDGET ITS REAL IDENTITY?
         *
         * TELL ME.
         */
        if( isset( $wp_registered_widgets[$id] ) )
        {
			
            $instance	= $wp_registered_widgets[$id];
            $class		= $instance['callback'][0];
            $number		= $instance['params'][0]['number'];

            $class->_set($number);

            return $class;
        }

        return false;
    }

    public function getSettings()
    {
		
        $settings = $this->get_settings();
        return $settings[$this->number];
		
    }

    public function getInstanceHash()
    {
		
        // just use any salt here...
        return md5( $this->id . NONCE_SALT );
		
    }

    // tiny utility function
    public static function getDefault( array $arr, $key, $default = '' )
    {
        return isset( $arr[$key] ) ? $arr[$key] : $default;
    }

    public function setOptions(array $options)
    {
        $this->_options = $options;
    }

    public function getOptions()
    {
        return $this->_options;
    }

    public function setRenderer($renderer)
    {
        $this->_renderer = $renderer;
    }

    public function getRenderer()
    {
        return $this->_renderer;
    }

    public function update($newInstance, $oldInstance)
    {
        $options = $this->getOptions();

        $instance = array();

        foreach($options as $section)
        {
            if(!is_array($section['options']))
                continue;
            foreach($section['options'] as $key => $option)
            {
                if($option['type'] == 'toggle')
                {
                    if(isset($newInstance[$key]))
                        $instance[$key] = true;

                    continue;
                }

                if(isset($newInstance[$key]) && !empty($newInstance[$key]) && (!is_array($opt['items']) || (isset($opt['strict']) && $opt['strict'] === false) || isset($opt['items'][$newInstance[$key]])))
                    $instance[$key] = $newInstance[$key];
                elseif(isset($option['default']))
                    $instance[$key] = $option['default'];
            }
        }

        return $instance;
    }

    public function form($instance)
    {
        include \UberKit::instance()->getPath('components/Widget/templates/widget-options.php');
    }

    public function widget($sidebarArgs, $instance)
    {
        if(isset($sidebarArgs['before_widget']))
            echo $sidebarArgs['before_widget'];

        echo $this->render($sidebarArgs, $instance);

        if(isset($sidebarArgs['after_widget']))
            echo $sidebarArgs['after_widget'];
    }

    public function render($sidebarArgs, $instance)
    {
        $renderer = $this->getRenderer();
        if(is_callable($renderer))
            return $renderer($sidebarArgs, $instance);
    }

    protected function _renderOptions($options)
    {
        $out = '';

        foreach($options as $optKey => $opt)
        {
            $rendered = $this->_renderOption($optKey, $opt);
            $out .= apply_filters('uberkit_widget_option_wrap', '<p>' . $rendered . '</p>', $rendered, $opt);     
        }

        return $out;
    }

    protected function _renderOption($key, $opt)
    {
        $settings = $this->getSettings();

        $renderer = '_render' . ucfirst(strtolower($opt['type']));

        $val = isset($settings[$key]) ? $settings[$key] : ((isset($opt['default']) && $opt['type'] != 'toggle') ? $opt['default'] : false);

        $cb = array($this, $renderer);

        if(is_callable($cb))
            return call_user_func($cb, $key, $opt, $val);
    }

    protected function _renderText($key, $opt, $val)
    {
        $val = esc_attr($val);

        $placeholder = $opt['label'];

        $out  = '<label for="' . $this->get_field_id($key) .'">' . $opt['label'] . ':';
        $out .= '<input class="widefat" id="' . $this->get_field_id($key) . '" name="' . $this->get_field_name($key) . '" type="text" value="' . $val . '" placeholder="' . $placeholder . '" />';
        $out .= '</label>';

        return $out;
    }

    protected function _renderToggle($key, $opt, $val)
    {
        $checked = $val ? ' checked' : '';
        $out  = '<input type="checkbox" class="checkbox" id="' . $this->get_field_id($key) . '" name="' . $this->get_field_name($key) . '"' . $checked . '/>';
        $out .= '<label for="' . $this->get_field_id($key) . '">' . $opt['label'] . '</label>';
        return $out;
    }

    protected function _renderSelect($key, $opt, $val)
    {
        $out = '<label for="' . $this->get_field_id($key) . '">' . $opt['label'] . ':</label>';
        $out .= '<br />';
        $out .= '<select class="widefat" id="' . $this->get_field_id($key) . '" name="' . $this->get_field_name($key) . '">';
        $out .= '<option value="">' . $option['label'] . '</option>';

        foreach($opt['items'] as $itemKey => $label)
        {
            $selected = $val == $itemKey ? ' selected' : '';
            $out .= '<option value="' . $itemKey . '"' . $selected . '>' . $label . '</option>';
        }

        $out .= '</select>';

        return $out;
    }

    protected function _renderTextarea($key, $opt, $val)
    {
        $val = esc_attr($val);

        $placeholder = $opt['label'];

        $rows = ' rows="' . ((is_array($opt['opts']) && isset($opt['opts']['rows'])) ? $opt['opts']['rows'] : 10) . '"';

        $out  = '<label for="' . $this->get_field_id($key) .'">' . $opt['label'] . ':';
        $out .= '<textarea class="widefat" id="' . $this->get_field_id($key) . '" name="' . $this->get_field_name($key) . '" ' . $rows . '>';
        $out .= $val;
        $out .= '</textarea></label>';

        return $out;
    }
}

<?php

namespace UK\Component\Applets;

use UK\Applet;
use UK\Widget;

class Base
{
    public function __construct()
    {
        require __DIR__ . '/helpers.php';

        add_action('widgets_init', array(&$this, 'registerWidgets'));
        add_action('wp_enqueue_scripts', array(&$this, 'loadAssets'));
        add_action('wp_footer', array(&$this, 'printFooterAssets'));
    }

    public function registerWidgets()
    {
        $applets = Applet::instances();

        foreach($applets as $class => $applet)
        {
            $spec = $applet->getSpec();

            if($spec['widget'])
                $applet->widget = $this->_createWidget($applet);

            if($spec['shortcode'])
                $this->_createShortcode($applet);
        }
    }

    protected function _createWidget($applet)
    {
        global $wp_widget_factory;

        $spec = $applet->getSpec();

        $a = is_array($spec['widget']);

        $name = ($a && isset($spec['widget']['name']))        ? $spec['widget']['name'] : $spec['name'];
        $desc = ($a && isset($spec['widget']['description'])) ? $spec['widget']['description'] : $spec['description'];
        $slug = ($a && isset($spec['widget']['slug']))        ? $spec['widget']['slug'] : $spec['slug'];

        $widget = new Widget($slug, $name, array('description' => $desc));

        $widget->setOptions($spec['options']);
        $widget->setRenderer(function($args, $instance) use ($applet)
        {
            return $applet->render($instance, array('context' => 'widget', 'args' => $args));
        });

        $wp_widget_factory->widgets[get_class($applet)] = $widget;

        return $widget;
    }

    protected function _createShortcode($applet)
    {
        $spec = $applet->getSpec();

        $sc = $spec['shortcode'];

        $a = is_array($sc);

        $name = ($a && isset($sc['tag'])) ? $sc['tag'] : $spec['slug'];

        if(!shortcode_exists($name))
        {
            $options = $spec['options'];

            add_shortcode($name, function($attrs, $content = '') use ($applet, $options)
            {
                return $applet->render($attrs, array('content' => $content, 'context' => 'shortcode'));
            });

            if(function_exists('shortcode_ui_register_for_shortcode') && !($a && isset($sc['ui']) && $sc['ui'] === false))
            {
                $attrs = array();

                foreach($options as $section)
                {
                    if(!is_array($section['options']))
                        continue;

                    foreach($section['options'] as $key => $option)
                    {
                        switch($option['type'])
                        {
                            case 'toggle':
                                $type = 'checkbox';
                                break;
                            default:
                                $type = $option['type'];
                        }

                        $attr = array('attr' => $key, 'label' => $option['label'], 'type' => $type);

                        if(isset($option['placeholder']))
                            $attr['placeholder'] = $placeholder;

                        // for selects/radios
                        if(isset($option['items']))
                            $attr['options'] = $option['items'];

                        $attrs[] = $attr;
                    }
                }

                shortcode_ui_register_for_shortcode($name, array(
                    'label' => $spec['name'],
                    'attrs' => $attrs,
                    'listItemImage' => isset($spec['icon']) ? $spec['icon'] : null,
                ));
            }
        }
    }

    public function loadAssets()
    {
        $applets = Applet::instances();

        foreach($applets as $class => $applet)
        {
            $assets = $applet->getAssets();
			
			// abort if no styles are available
			if( !$assets )
				return;

            if(is_array($assets['styles']))
            {
                foreach($assets['styles'] as $handle => $asset)
                {
                    $deps    = is_array($asset['dependencies'])	? $asset['dependencies']	: false;
                    $version = isset($asset['version'])			? $asset['version']			: false;
                    $media   = isset($asset['media'])			? $asset['media']			: 'all';

                    wp_enqueue_style($handle, $asset['path'], $deps, $version, $media);
                }
            }
        }
    }

    public function printFooterAssets()
    {
        $applets = Applet::instances();

        foreach($applets as $class => $applet)
        {
            if(!$applet->wasRendered())
                continue;

            $assets = $applet->getAssets();
			
			// abort if no styles are available
			if( !$assets )
				return;

            if(is_array($assets['scripts']))
            {
                foreach($assets['scripts'] as $handle => $asset)
                {
                    $deps    = is_array($asset['dependencies'])	? $asset['dependencies']	: false;
                    $version = isset($asset['version'])			? $asset['version']			: false;

                    wp_enqueue_script($handle, $asset['path'], $deps, $version);
                }
            }
        }
    }
}
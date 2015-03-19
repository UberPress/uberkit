(function($)
{
	var view_class      = 'uk-widget-settings-accordion-view';
	var accordion_class = 'uk-widget-settings-accordion';
	var trigger_class   = 'uk-widget-settings-accordion-trigger';
	var trigger_label   = 'Other Settings';

	function widgetAccordion()
	{
		var $widgets = $('.widget');

		$widgets.each(function()
		{
			var $widget = $(this);

			if(!$widget.data('accordion-initialized') && ($widget.attr('id').substr(-5) != '__i__'))
			{
				var $accordion = $widget.find('.' + accordion_class);

				var $trigger = $(document.createElement('h3')).html(trigger_label).addClass(trigger_class);

				$accordion.append($trigger);

				var $view = $(document.createElement('div')).addClass(view_class);
				$view.append($accordion.siblings());

				$accordion.append($view);

				$widget.data('accordion-initialized', true);
			}

		});

		$('.uk-widget-settings-accordion-trigger').not('.uk-widget-settings-accordion-trigger-active').next('.uk-widget-settings-accordion-view').hide();
	}

	$(document).on('click', '.uk-widget-settings-accordion-trigger', function()
	{	
		var trig = $(this);
			
		if ( trig.hasClass('uk-widget-settings-accordion-trigger-active') ) {
			trig.next('.uk-widget-settings-accordion-view').slideToggle(200);
			trig.removeClass('uk-widget-settings-accordion-trigger-active');
		} else {
			$('.uk-widget-settings-accordion-trigger-active').next('.uk-widget-settings-accordion-view').slideToggle(200);
			$('.uk-widget-settings-accordion-trigger-active').removeClass('uk-widget-settings-accordion-trigger-active');
			trig.next('.uk-widget-settings-accordion-view').slideToggle(200);
			trig.addClass('uk-widget-settings-accordion-trigger-active');
		};
			
		return false;
	});

    $(document).on('widget-updated widget-added', function() {
        widgetAccordion();
    });

	$(function()
	{
		widgetAccordion();
	});



})(jQuery);



/*
jQuery( document ).ready( function( $ ) {
	
    function widgetAccordion() {
		
		//$('.uk-widget-settings-accordion').siblings().wrapAll('<div>');
		console.log($('.uk-widget-settings-accordion').siblings());
		
		$('.uk-widget-settings-accordion-trigger').not('.uk-widget-settings-accordion-trigger-active').next('.uk-widget-settings-accordion-view').hide();
		
		$('.uk-widget-settings-accordion-trigger').click( function() {
				
			var trig = $(this);
			
			if ( trig.hasClass('uk-widget-settings-accordion-trigger-active') ) {
				trig.next('.uk-widget-settings-accordion-view').slideToggle(200);
				trig.removeClass('uk-widget-settings-accordion-trigger-active');
			} else {
				$('.uk-widget-settings-accordion-trigger-active').next('.uk-widget-settings-accordion-view').slideToggle(200);
				$('.uk-widget-settings-accordion-trigger-active').removeClass('uk-widget-settings-accordion-trigger-active');
				trig.next('.uk-widget-settings-accordion-view').slideToggle(200);
				trig.addClass('uk-widget-settings-accordion-trigger-active');
			};
			
			return false;
			
		});
		
    }

    widgetAccordion();

    $(document).on('widget-updated widget-added', function() {
        widgetAccordion();
    });
	
});
*/
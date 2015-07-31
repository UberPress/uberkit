(function($) {
	var view_class      = 'uk-widget-settings-accordion-view';
	var accordion_class = 'uk-widget-settings-accordion';
	var trigger_class   = 'uk-widget-settings-accordion-trigger';
	var trigger_active_class = trigger_class + '-active';
	var init_key        = '_accordion_initialized';
	var active_ndx_key  = '_accordion_active_ndx';

	var togglePane = function($trigger, duration) {
		var $widget = $trigger.parents('.widget');

		var $view  = $trigger.next('.' + view_class);

		if ($trigger.hasClass(trigger_active_class)) {
			if(duration)
				$view.slideUp(duration);
			else
				$view.hide();

			$trigger.removeClass(trigger_active_class);

			$widget.removeData(active_ndx_key);

		} else {
			var $activeTrigger = $widget.find('.' + trigger_active_class).removeClass(trigger_active_class);
			var $activeView    = $activeTrigger.next('.' + view_class);

			if(duration) {
				$activeView.slideUp(duration);
				$view.slideDown(duration);
			} else {
				$activeView.hide();
				$view.show();
			}

			$trigger.addClass(trigger_active_class);

			var ndx = ($view.prev().index() - 1) / 2;
			$widget.data(active_ndx_key, ndx);
		};
	}

	function widgetAccordion($widgets) {
		($widgets || $('.widget')).each(function() {
			var $widget = $(this);

			var $accordion = $widget.find('.' + accordion_class);

			if(!$accordion.length)
				return;

			if(!$accordion.data(init_key) && ($widget.attr('id').substr(-5) != '__i__')) {
				$(document.createElement('h3')).html(_uk_admin_widgets['label_other']).addClass(trigger_class).appendTo($accordion);
				$(document.createElement('div')).addClass(view_class).append($accordion.siblings()).appendTo($accordion);

				// hide all inactive panes
				$accordion.find('.' + trigger_class).not('.' + trigger_active_class).next('.' + view_class).hide();

				$accordion.data(init_key, true);
			}

			var active = $widget.data(active_ndx_key);

			if(active !== undefined)
				togglePane($widget.find('.' + trigger_class).eq(active));
		});


	}

	$(document).on('click', '.' + trigger_class, function(e) {	
		e.preventDefault();
		togglePane($(this), 200);
		return false;
	}).on('widget-updated widget-added', function(e, $widget) {
        widgetAccordion($widget);
    });

	$(function() {
		widgetAccordion();
	});

})(jQuery);
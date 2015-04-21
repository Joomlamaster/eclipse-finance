$(function() {
	$.widget('ticker.news', {
		options: {
			duration: 2000
		},
		
		_create: function() {
			this._runTicker( );
			this._runEventHandler( );
		},
		
		_runEventHandler: function() {
			var that = this; 
			this.element
				.hover(function() {
					$(this).find('li').stop(true, false);
				}, function() {
					var li = that.element.find('li:first');
					var marginTop = parseFloat(li.css('marginTop')); 
					duration = (marginTop + li.outerHeight()) / li.outerHeight() * that.options.duration;
					that._runTicker(parseInt(duration)); 
				});
		},
		
		_runTicker: function(duration) {
			duration = duration || this.options.duration; 
			var that = this; 
			var li = this.element.find('li:first'); 
			li.animate({
				'marginTop': -1 * parseInt(li.outerHeight())
			}, duration, 'linear', function() {
				li.css('marginTop', '0px').insertAfter(that.element.find('li:last'));
				that._runTicker( ); 
			}); 			
		}
	})
}); 
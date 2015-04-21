$(function() {
	$.widget('option.tradeChoice', {
		
		currentStep: 0,
		
		animated: true,
		
		profitValue: null,
		
		options: {
			width: 290
		},
		
		_create: function() {
			this._initButtonsEventHandlers();
			//this._refreshProgress();
		},
		
		_initButtonsEventHandlers: function() {
			var that = this; 
			this.element
				.on('click', '.btn.above', function(e) {
					$('.investment-position').text('above');
					that.goToStep(1);
					
				})
				.on('click', '.btn.below', function(e) {
					$('.investment-position').text('below');
					that.goToStep(1);
				})
				.on('click', '.back', function(e) { console.log($(this).html());
					that.goToStep(0); 
				})
				.on('keyup', '.investment input[type="text"]', function(e) {
					if($.isNumeric($(this).val())) {
						that.profitValue = Math.round(1.85 * parseInt($(this).val())); 
						that.element.find('.payout span').text(that.profitValue+'$');
					} else {
						that.profitValue = null;
						that.element.find('.payout span').text('');
					}
				})
				.on('click', '.investment-footer .btn', function(e) {
					if( that.profitValue ) {
						that.element.find('.profit-value').text(that.profitValue + '$'); 
					} else {
						that.element.find('.profit-value').text(''); 
					}
					that.goToStep(2);
				})
		},
		
		refreshProgress: function(progressValues) {
			var that = this; 
			var left = Math.round(Math.random() * 5 + 48); 
			var right = 100 - left;
			var percent = [left, right]; 
			
			$.each(progressValues, function(symbol, persents) { 
				if($('select.symbol').val() == symbol) {
					percent = persents; 
				}
			});
			//that.element.find('.progress-values .left').text(percent[0] + '%');
			//that.element.find('.progress-values .right').text(percent[1] + '%');
			that.element.find('.bar-left').width(percent[0] + '%').html(percent[0] + '%');
			that.element.find('.bar-right').width(percent[1] + '%').html(percent[1] + '%');	
		},
		
		goToStep: function(step) {
			var that = this; 
			if(this.animated) {
				this.animated = false;
				$('.demo-trading').animate({'left': '-'+ (step * 290) + 'px'}, 'slow', function() {
					that.animated = true; 
					that.currentStep = step;
				}); 
			}
		}
		
	})
	
});
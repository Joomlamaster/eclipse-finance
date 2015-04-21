$(function() {
	"use strict";
	
	$.widget('option.mline', {
		dxFeed: null,
		options: {
			symbols: []
		},
		symbolHistory: {},
		_create: function() {
			var that = this; 
				
			this._initDxFeed();
			this._fillLineBySymbols(); 
		},
		
		_initDxFeed: function() {
			var that = this;
			var rotate = false;
			this.dxFeed = dx.feed.createSubscription("Quote"); 
			$.each(this.options.symbols, function(i, symbol) {
				that.dxFeed.addSymbols(symbol);  
			});
			this.dxFeed.onEvent = function(quote) {
				var val = (quote.bidPrice + quote.askPrice) / 2;
				val = val.toFixed(5);
				that.changeSymbolCell(quote.eventSymbol, val);
				that.symbolHistory[quote.eventSymbol] = val;
				if( !rotate ) {
					that._runRotation();
					rotate = true; 
				}
			};				
		},
		
		changeSymbolCell: function(symbol, value) {
			var cell = this.element.find('li[data-symbol="'+symbol+'"]'); 
			cell.html(symbol+' <span>'+value+'</span>'); 
			if(this.symbolHistory[symbol]) {
				var historyValue = this.symbolHistory[symbol]; 
				if(value > historyValue) {
					cell.attr('class', 'greenValue');
				} else if(value < historyValue) {
					cell.attr('class', 'redValue');
				} else {
					cell.attr('class', 'normalValue');
				}
			}
		},
		
		_fillLineBySymbols: function() {
			var that = this;
			var ul = this.element.find('ul'); 
			if(this.options.symbols.length) {			
				$.each(this.options.symbols, function(i, symbol) {
					ul.append('<li data-symbol="'+symbol+'"/>'); 
				});
				var liLength = ul.find('li').length; 
				var liWidth = ul.find('li').outerWidth(); 
				if( (liLength * liWidth) <= (this.element.width() * 2) ) {
					that._fillLineBySymbols(); 
				}
			}
		},
		
		_runRotation: function() {
			var that = this; 
			this.element.animate({'height': '25px', 'opacity': 1}, 800);
			var ul = this.element.find('ul');
			var li = this.element.find('li:first'); 
			ul.animate({'left': '-='+li.outerWidth()+'px'}, 3000,  'linear', function(){
				ul.css('left', '0px');
				li.insertAfter(that.element.find('li:last'));
				that._runRotation(); 
			})
		}
	})
});
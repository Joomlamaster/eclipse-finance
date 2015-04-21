$(function() {
	$.widget('option.trends', {
		dxFeed: null,
		progress: {
			'EUR/USD': [50, 50],
			'AUD/USD': [50, 50],
			'EUR/JPY': [50, 50],
			'GBP/USD': [50, 50]
		},
		options: {
			symbols: [],
			barLeft: '.bar-success',
			barRight: '.bar-warning'
		},
		
		_create: function() {
			this._refreshOptionPrice();
			this._refreshRow(); 			
		},
		
		_refreshRow: function() {
			var that = this;
			var rowsLength = this.element.find('tbody').find('tr').length; 
			var row = this.element.find('tbody').find('tr').eq( Math.round(Math.random() * rowsLength) );
			this._refreshPayout(row);
			this._refreshProgress(row); 

			var refreshTime =  Math.round(Math.random() * 2000 + 1000);
			setTimeout(function() {
				that._refreshRow(); 
			}, refreshTime); 
		},
		
		_refreshPayout: function(row) {
			var payout = row.find('td:first');
			var rand = Math.round(Math.random()*10 + 70);
			payout.html(rand + '%');			
		},
		
		_refreshProgress: function(row) {
			var progressCell = row.find('td').eq(1);
			var left = Math.round(Math.random() * 5 + 48); 
			var right = 100 - left;
			if(this.progress[row.data('symbol')]) {
				this.progress[row.data('symbol')][0] = left;
				this.progress[row.data('symbol')][1] = right;				
			}
			
			progressCell.find('.left').html(left + '%'); 
			progressCell.find('.right').html(right + '%'); 
			progressCell.find(this.options.barLeft).width(left + '%');
			progressCell.find(this.options.barRight).width(right + '%');
			this._trigger('progressrefreshed', null, this.progress);
		},
		
		getProgressValues: function() {
			return this.progress; 
		},
		
		_refreshOptionPrice: function() {
			var that = this; 
			this.dxFeed = dx.feed.createSubscription("Quote"); 
			var rows = this.element.find('tbody').find('tr').get(); 
			var symbol; 
			$.each(rows, function(index, value) {
				symbol = $(value).data('symbol');
				if( symbol ) {
					that.dxFeed.addSymbols(symbol);  
				}
			});			
			this.dxFeed.onEvent = function(quote) {
				var val = (quote.bidPrice + quote.askPrice) / 2;
				val = val.toFixed(5);
				that.element.find('tbody').find('tr[data-symbol="'+quote.eventSymbol+'"]').find('td:last').html(val);
			};	
		}
	})
})
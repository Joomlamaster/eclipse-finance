(function ($) {
    var options = {
        series: { state: { show: false } // true or false
        }
    }

    function init(plot) {
        plot.hooks.processDatapoints.push(
            function(plot, series, datapoints) { //console.log($.plot.options);
               
            });
        plot.hooks.draw.push(function(plot, ctx, series) {
        	
//        	setInterval(function(){
////        		var r = Math.floor(Math.random() * (1870 - 1880 + 1)) + 1880;
////            	plot.getOptions().grid.markings[0].yaxis.from = r;
////            	plot.getOptions().grid.markings[0].yaxis.to = r;
//            	//console.log(plot);  
//        	}, 5000);
        	
//        	plot.getOptions().grid.markings[0].yaxis.from = 1880;
//        	plot.getOptions().grid.markings[0].yaxis.to = 1880;
        })
        plot.hooks.drawSeries.push(
            function(plot, ctx, series) { 

            }
        );
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'state',
        version: '0.2'
    });
})(jQuery); 

$(function() {
	$.widget('trade.dxFeed', {
		//Subscription Object
		Subscription: null,
		//TimeSeriesSubscription Object
		TimeSeriesSubscription: null,
				
		options: {
			//default symbol
			symbol: null,  
			//back time for TimeSeriesSubscription
			chartHoursBack: 1,
			//aggregation period
			period: '1min'
		},
		
		initSubscription: function(onEvent) {
			this.Subscription = dx.feed.createSubscription("Quote"); 
			this.Subscription.onEvent=onEvent;      	
			this.Subscription.addSymbols(this.options.symbol); 			
		},
		
		initTimeSeriesSubscription: function(time, onEvent) {
			var settings = this.options; 
			this.TimeSeriesSubscription = dx.feed.createTimeSeriesSubscription("Candle");
			this.TimeSeriesSubscription.setFromTime(time -  settings.chartHoursBack * 3600 * 1000);
			this.TimeSeriesSubscription.setSymbols(
				dx.symbols.changeAttribute(this.changeSymbol(settings.symbol), "", settings.period)
			);		
			this.TimeSeriesSubscription.onEvent = onEvent; 
		},
		
		changeSymbol: function(symbol) {
			return symbol + "{price=bid}"; 
		}
	}); 
});

Date.prototype.getUTCTime = function() { 
	  return new Date(
	    this.getUTCFullYear(),
	    this.getUTCMonth(),
	    this.getUTCDate(),
	    this.getUTCHours(),
	    this.getUTCMinutes(), 
	    this.getUTCSeconds()
	  ).getTime(); 
}

function module( module ) {
 
  $( function() {
    if ( module.init ) {
      module.init();
    }
  });
 
  return module;
}


var Router = {};
Router.init = function() {
	this.tabLoaded = [];
	this.widgetsToTabs = {
		'tab0': 'optionAboveBelowWidget',
		'tab1': 'optionBuilderWidget',
		'tab2': 'optionWidget60sec'
	}
}
Router.init.prototype = {
	route: function(tabIndex) {
		this.fillTab(tabIndex); 
	},
	fillTab: function(tabIndex) {
		if($.inArray(tabIndex, router.tabLoaded) == -1) {
			router.tabLoaded.push(tabIndex); 
			router.FillTabContent(tabIndex, function() {
				option.widget(router.widgetsToTabs['tab'+tabIndex], {
					symbol: 'EUR/USD'
				}).addToSection('#tab'+tabIndex, 3);
			});				
		}
	},

	FillTabContent: function(tabIndex, func) {  

		func(); 
	}
};
var router = new Router.init(); 


var logger = module(function(config) {
	var debug = config.debug; 
	return {
		info: function() {
			console.log.apply(console, arguments);
		},
		warning: function() {
			if( debug )
				console.warn.apply(console, arguments);
		},
		error: function() {
			if( debug )
				console.error.apply(console, arguments);
		}
	};
}(Config)); 

/* USER MODULE */
var user = module(function(config) { 
	var config = config || {}; 
	
	return $.extend(config, {
		setBalance: function(balance) {
			this.balance = parseFloat(balance); 
			$(tradeApp.options.BALANCE_ATTR_ID).html(this.balance); 
		},
		getBalance: function() {
			return parseFloat(this.balance); 
		},
		setDeposit: function(deposit) {
			this.deposit = parseFloat(deposit);
		},
		getDeposit: function() {
			return parseFloat(this.deposit);
		},
		refreshBalance: function() {
			$.get('user/getBalance', function(balance) {
				user.setBalance(balance); 
			}); 
		},
		isGuest: function() {
			return config.user_id == '';
		}
	}); 
}(Config.user))


/* TIMER MODULE */
var timer = module(function(config) { 
	var time, 
	runTimer = function() { 
		var UTC = new Date(timer.time);	
		timer.afterTimeUpdate(UTC); 	
		timer.time+=1000; 
	},
	
	getUTCString = function(GMT, s) {
		var hours   = GMT.getUTCHours(),
			minutes = GMT.getUTCMinutes(),
			seconds = GMT.getUTCSeconds();	
		 
		return hours + ':' + 
		('0' + minutes).slice(-2) + ':' + 
		(s ? ('0' + seconds).slice(-2) : '') + ' GMT';	
	}; 
	
	return {
		time: null,
		getUTCString: getUTCString,
		getGMT: function(success) {
			$.ajax({
				  dataType: "json", //jsonp
				  //url: "http://json-time.appspot.com/time.json?tz=GMT",
				  url: "/rates/time",
				  data: {},
				  success: success
			}); 			
		},
		init: function() {
			var that = this; 
			this.getGMT(function(o) {
				timer.time = new Date(o.datetime).getTime();
				runTimer(); 
				setInterval(function() {
					runTimer(); 
				}, 1000);	
				that.afterInit(); 
			})		
		},
		showIn: function(el, seconds) {
			$(el).html(this.getUTCString(new Date(timer.time), seconds)); 
		},
		afterInit: function(UTC) {},
		afterTimeUpdate: function(UTC) {}
	}
}(typeof Config !== 'undefined' && Config || {})); 


/* MAIN APP */
var tradeApp = module(function(config) {
	
	var dxFeedSub = dx.feed.createSubscription("Quote"); 
	var invitePopup = false; 
	var options = {
		BALANCE_ATTR_ID: '#balance-value',
		INVITE_POPUP_TMPL: '#invite-popup-tmpl'
	},
	
	statuses = {
		'status2': {
			'class': 'lost',
			'text' : 'You Lost!'
		}, 			
		'status3': {
			'class': 'win',
			'text' : 'You Won!'
		},
		'status4': {
			'class': 'draw',
			'text' : 'Tie'
		}
	},
	
	_initButtonBarEventHandlers = function() {
		$('.content').livequery(function() {
			$(this)
				.on('click', '.rates-mode-tabs li', function(e) { 
					var tabIndex = $(this).index(); 
					tradeApp.section = tabIndex; 
					router.route(tabIndex);
				})
				.on('click', '#closed-rates a.btn', function(e) {
					e.preventDefault();
					refreshClosedRates($(this).data('page')); 
				})			
		});
		$(window).blur(function(e) {
		    //console.log('blur');
		});
		$(window).focus(function(e) {
			var widgets = option.getWidgetsByName('optionAboveBelowWidget');
			if(widgets.length) { 
				$.each(widgets, function(i, widget) { 
					widget.expiresRefresh();
				});
			}			
		});	
	},
	//refresh tab with opened rates 
	refreshOpendRates = function() {
		$.get('/rates/opened', {}, function(data){ 
			var response = $.parseJSON(data);
			if(response.rows) {
				$.each(response.rows, function(index, value) {
					if(tradeApp.rates[value.rate_id]) { 
						delete response.rows[index];
						return 1;
					}
					tradeApp.rates[value.rate_id] = value;
					dxFeedSub.addSymbols(value.currency);  
				}); 
				if( !$.isEmptyObject(response.rows) ) {
					$('#opend-rates table tbody').append(
						$('#open-rate-rows').tmpl({
							'dataItems': response.rows
						})		
					);					
				}		
			} 
		}); 					
	},
	//refresh tab with closed rates 
	refreshClosedRates = function(page) {
		var page = page || 1; 
		if(!tradeApp.processing) {
			tradeApp.processing = true;
			$.get('/rates/closed', {page: page}, function(content){ 
				$('#closed-rates').html(content); 
				tradeApp.processing = false;
			});				
		}
	},
	//search and closing rates 
	_ratesMonitoring = function() { //console.log(tradeApp.rates);
		if( !$.isEmptyObject(tradeApp.rates) ) { 
			$.each(tradeApp.rates, function(index, rate) {
				var d = rate.expiry_timestamp - (timer.time / 1000);
				if( d < 1 ) { //1 second 
					if(rate.processing !== true) {
						rate.processing = true;
						$.get('rates/check', {rate_id: rate.rate_id}, function(data) {
							if( data ) {
								var proximateRate = $.parseJSON(data);
								if(proximateRate.status == 2 || proximateRate.status == 3 || proximateRate.status == 4) { //won or fail
									if(tradeApp.rates[index].widget) {
										tradeApp.rates[index].widget.removeGridMarkings(tradeApp.rates[index]); 
									}
									delete tradeApp.rates[index]; //remove from opend rates
									
									user.refreshBalance(); //refresh user balance
									tradeApp.refreshClosedRates(); 									
									tradeApp.getOpendRateById(proximateRate.rate_id).effect('highlight', {}, 1000, function() {
										$(this).attr('class', 'closed ' + statuses['status' + proximateRate.status].class); 

var prevCell = $('.current').closest('td').prev();
										$(this).find('.status').text(statuses['status' + proximateRate.status].text); 
										$(this).find('.current').text();
		if(statuses['status' + proximateRate.status].text =="You Lost!") 
		{
		 $('.current').parent('.closed.lost').find('td:nth-child(8)').text("0");
		}
										$(this).find('.expiration').text(proximateRate.expiration_value); 
									});
									logger.info('rate closed - '+ rate.rate_id);
								} else {
									logger.error('rate not closed, status: ' + proximateRate.status); 
								}
							} else {
								if(d > -10) { //max 10 seconds
									//try again
									rate.processing = false;
									logger.warning('not yet, rateId:' + rate.rate_id);									
								} else { 
									delete tradeApp.rates[index]; //remove from opend rates
									tradeApp.getOpendRateById(rate.rate_id).addClass('error').find('.status').text('Error'); 
									logger.error('something went wrong:' + rate.rate_id);
								}
							}
						})
					  }
				}
			})
		}
	};  
	
	var updateDataTimeout = null; 
	
	var symbolList = {}; 
	
	dxFeedSub.onEvent = function(quote) {
		var val = (quote.bidPrice + quote.askPrice) / 2;
		symbolList[quote.eventSymbol] = val.toFixed(5);
		if(updateDataTimeout === null)
			setTimeout(updateOpenedRates, 0);
	};		                    	
	
	var updateOpenedRates = function() {
		updateDataTimeout = null; 
		$.each(tradeApp.rates, function(rateId, rateObj) {
			var rate = tradeApp.getOpendRateById(rateId); 
			if(symbolList[rateObj.currency]) {
				var win = rateObj.type == 'above' && rateObj.rate < symbolList[rateObj.currency];
				win = win || rateObj.type == 'below' && rateObj.rate > symbolList[rateObj.currency];					
				if( win ) {
					rate.attr('class', 'win'); 
				}
				else if (rateObj.rate == symbolList[rateObj.currency]) 
					rate.attr('class', null); 
				else 
					rate.attr('class', 'lost'); 
					$('tr.lost td:nth-child(8)').text("0");
				rate.find('.current').text(symbolList[rateObj.currency]); 		
			}
		})	
	}; 
	
	return {
		//user module
		user: config.user, 
		//common processing
		processing: false, 
		//opened rates
		rates: {}, 
		config: config,
		options: options,
		//current section mode 
		section: 0, 
		
		init: function() { //this.showInvitePopup({}); 
			_initButtonBarEventHandlers(); 
		    refreshOpendRates(); 
		    refreshClosedRates(); 
		    setInterval(function() {
		    	_ratesMonitoring(); 
		    }, 2000); 
		},
		
		getOpendRateById: function(rateId) {
			return $('#opend-rates tr[data-rateid="' + rateId + '"]'); 
		},
		
		addOpendRate: function(rateData, func) { 
			var that = this; 
			if( user.isGuest() ) {
				tradeApp.showInvitePopup(rateData); 
				return false; 
			}
			var dataItems = [rateData]; 
			$.ajax({
				url: '/rates/add',
				type: 'POST',
				cache: false,
				data: {
					'rateData': JSON.stringify(rateData)
				},
				success: function (data) { 
					var response = $.parseJSON(data);
					if(response.status == 'OK') {
						tradeApp.rates[response.row[0].rate_id] = response.row[0];
						dxFeedSub.addSymbols(response.row[0].currency); 
						$('#opend-rates table tbody').prepend(
							$('#open-rate-rows').tmpl({
								'dataItems': response.row
							})		
						); 
						user.setBalance(response.balance); 	
						func(response.row[0]); 
					} else {
						that.dialog('Error', 'Error occurred');
					}				 
				},				
				error: function(xhr, status, error) { 
					console.log(xhr,'|', status, '|', error);
					that.dialog('Error', 'Error occurred: ' + error);
				}
			});		
		}, 
		
		showInvitePopup: function(rateData) { 
			var that = this; 
			if( !invitePopup ) {
				var popupContainer = $(tradeApp.options.INVITE_POPUP_TMPL).tmpl({
					'profit': rateData.price * 1.85
				}); 
				var popup = popupContainer.find('#invite-popup');
				var scrollTop = $(window).scrollTop();
				popup.css({
					'marginTop': (scrollTop - 180) + 'px'
				})
				setTimeout(function() {
					popupContainer.appendTo('body')
					.on('click', '.close', function(e) {
						e.preventDefault();
						popup.removeClass().addClass('bounceOut animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							popupContainer.remove(); 
							invitePopup = false; 
					    });
					});    
				}, 1000);	
				invitePopup = true; 
			}
		}, 		
		
		refreshClosedRates: refreshClosedRates,
		refreshOpendRates: refreshOpendRates,
		dialog: function(title, body) {
			$('<div />').dialog({
				'title': title,
				'modal': true,
				'resizable': false,
				buttons: [{
					text: "Ok", 
					click: function() { 
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "Cancel", 
					click: function() { 
						$( this ).dialog( "close" ); 
					} 
				}],
				close: function( event, ui ) {
					$(this).dialog("destroy");
					$(this).remove();
				}							
			}).html(body); 
		},
	}
}(Config)); 



$.extend(timer, {
	afterTimeUpdate: function(UTC) {
		this.showIn('#time', true); 
		var widgets = option.getWidgetsByName('optionAboveBelowWidget'); 
		if(widgets.length) { 
			$.each(widgets, function(i, widget) { 
				widget.expiresRefresh(UTC);
				widget.countdown(UTC); 
			});
		}
	},
	afterInit: function() {
		var that = this; 
		setInterval(function() {
			that.timerCorrector(); 
		}, 5000); 		
	},	
	timerCorrector: function() {  
		timer.getGMT(function(o) { 
			var d = new Date(o.datetime).getTime();
			//wake up (sleep mode)
			if(timer.time && ((d - timer.time) > 20000)) { //20seconds
				location.reload();
			}			
			timer.time = d; 
		}); 
	}	
});


var option = module(function(tradeApp) {	
	
	var _createOptionWidgets = function() {   
		$.widget('trade.optionWidget', $.trade.dxFeed, option.widgets.optionWidget);
		$.widget('trade.optionAboveBelowWidget', $.trade.optionWidget, option.widgets.optionAboveBelowWidget); 
		$.widget('trade.optionWidget60sec', $.trade.optionWidget, option.widgets.optionWidget60sec);
		$.widget('trade.optionBuilderWidget', $.trade.optionWidget, option.widgets.optionBuilderWidget); 
	},	
	
	_runOption = function() { 
		timer.getGMT(function(o) {
			router.route(0); //load first tab 
		}); 
	},	
	
	_runOptionStatistic = function() {
		var abovePercent, belowPercent, index;
		if(!$.isEmptyObject(option.optionStatistics)) {
			index = Math.round(Math.random() * Object.keys(option.optionStatistics).length); 
			abovePercent = Math.round(Math.random() * 40) + 30; 
			belowPercent = 100 - abovePercent; 
			option.optionStatistics[index] = [abovePercent, belowPercent]; 
		} else {
			$.each(option.symbols, function(section, list){
				for(var i in list) {
					abovePercent = Math.round(Math.random() * 40) + 30; 
					belowPercent = 100 - abovePercent; 
					option.optionStatistics[option.symbols[section][i]] = [abovePercent, belowPercent];
				}
			});
		}
		setTimeout(function() {
			_runOptionStatistic()
		}, 2000); 
	};	
	
	return { 
		//Available symbols list
		symbols: {
			'CURRENCIES':  ['EUR/USD', 'AUD/USD', 'GBP/USD', 'EUR/GBP', 'USD/JPY', 'EUR/JPY', 'XPD/USD', 'AUD/CAD', 'AUD/CHF', 'GBP/JPY', 'EUR/AUD', 'USD/CAD', 'EUR/CHF', 'USD/CHF'],
			'COMMODITIES': {
				'/CLQ4': 'Crude Oil', 
				'/GC': 'Gold', 
				'/SI':'SILVER', 
				'/PL':'PLATINUM', 
				'/SB':'SUGAR', 
				'/ZW':'WHEAT', 
				'/ZC':'CORN', 
				'/KC':'COFFEE',
			},
			'STOCKS': {
				'AAPL': 'APPLE', 
				'MSFT': 'MICROSOFT', 
				'GOOG': 'GOOGLE', 
				'IBM': 'IBM', 
				//'TATLY': 'Tata Steel Ltd', 
				'AMAT': 'AMAT (Applied Materials, Inc)', 
				'AIG': 'AIG', 
				'BCS': 'BARCLAYS', 
				'BIDU': 'BIDU', 
				'BNPQY': 'BNP PARIBAS',
				'BP': 'BP', 
				//'CITI GROUP', 
				'COKE': 'COCA COLA', 
				'DIS': 'DISNEY', 
				'JPM': 'JP MORGAN CHASE', 
				'OGZPY': 'GAZPROM', 
				'GS': 'GOLDMAN SACHS', 
				'HSBC': 'HSBC HOLDINGS', 
				'SBKFF': 'STATE.BANK INDIA', 
				'TM': 'TOYOTA'
			},
			'INDICIES': {
				'/NQ': 'NASDAQ', 
				'/ESU4': 'S&P 500', 
				'/NQU4': 'NASDAQ FUTURES'			
			}
		},
		
		symbolIsCurrency: function(symbol) {
			return $.inArray(symbol, this.symbols.CURRENCIES) !==-1; 
		},
		//Traders choice statistics
		optionStatistics: {},
		widgetName: null,
		widgetParams: {},
		//set type of option
		widget: function(widgetName, widgetParams) {
			this.widgetName = widgetName;
			this.widgetParams = widgetParams; 
			return this; 
		},
		
		//add option-blocks to section
		addToSection: function(sectionId, quantity) {
			quantity = quantity || 1;
			while(quantity--) {
				var widget = this.widgets[this.widgetName].getTemplate({
					id : Math.random() * 999999,
					widgetName : this.widgetName					
				}); 
				$(sectionId).find('ul').append(widget);
				option.installTo(widget, this.widgetParams); 
				
			}
		},			
		
		init: function() {
			_createOptionWidgets(); 
			_runOptionStatistic(); 
			_runOption(); 
		},
		
		//default plot options
		plotOptions: {
//			bars: {
//				fill: true,
//		        fillColor: 'red'				
//			},
			series: {
				lines: { 
					show: true,
				    lineWidth: 1,
			        color: 'rgba(255,230,230,0.5)',
				    opacity: 0.2,
					fill: true,
					zero: false,
					fillColor: {
						colors: ["transparent", "transparent"]
					}
//			        fillColor: { 
//			        	colors: ["rgba(0, 0, 0, 0.4)", "rgba(255, 255, 255, 0.1)"]
//			        }		    
				},
				highlightColor: 'rgb(190,232,216)',
				state: true,
				points: {
					//symbol: "triangle"
					radius: 0.2,
					symbol: 'circle'
					
				}
				
			},
			zoom: {
				interactive: true
			},
			pan: {
				interactive: true
			}, 
//			points: { 
//				symbol: "triangle"
////				show: true, 
////				fill: false,
////				lineWidth: 0
//			},
			xaxis: {
				mode: "time",
				minTickSize: [0.5, "hour"],
				autoscaleMargin: 0.02
			},
			grid: {
				hoverable: false,
				markings: [],				
//				markings: [{ 
//				    color: '#FFF', 
//				    yaxis: { from: 1875, to: 1875 } 
//				}],
				markingsLineWidth: 1.3,
				backgroundColor: { 
					colors: ["#000", "#262627"] 
				}
			},
			
		},
		
		//get all options or current tab
		getAll: function(tabIndex) { 
			var options = []; 
			var charts = tabIndex === undefined ? 
				$('.tabbable').find('.chartBlock') : 
				$('.tabbable .tab-pane').eq(tabIndex).find('.chartBlock'); 
			$.each(charts.get(), function(index, value) {
				options.push($(value));
			}); 
			return options; 
		},
		
		getWidgetsByName: function(widgetName) {
			var options = this.getAll(),
				widgets = [];
			$.each(options, function(index, optionBlock) { //console.log(optionBlock.data('trade.'.widgetName));  
				if(optionBlock.data(widgetName)) {
					widgets.push(optionBlock.data(widgetName)); 
				}
			}); 
			return widgets; 
		},
		
		reloadWidget: function(widget, params) {
			
		},		
		
		//install option widget (_createOptionWidget)		
		installTo: function(obj, options) { 
			options = options || {}; 
			var widgetName = obj.data('widgetname');
 			obj[widgetName](options);
 			return obj; 
		},
		
		widgets: {
			'optionWidget': {			
				//current Option price
				strike: null, 
				//current option point on chart
				strikePoint: [],
				//strike form			
				strikeElement: null,
				//last point on chart
				lastChartPoint: [],
				//plot object
				plot: null,
				
				dxFeed: null,
							
				options: {
					symbol: null,
					chartHoursBack	 : 1,
					//chartHoursBack(min)/aggregation period 
					chartPoints		 : 60, 
					minPriceValue    : 20,
					payout		     : 1.85,
					symbol   : null,
					currencyDisabled : false,		
					symbolList		 : {},
					currencySelect   : '.currency select',
					expiresSelect    : '.expires select',
					plotOptions: {}
				},
				
				showProcessing: function(level) {
					this.element.find('.processing').data('level', level).show(); 
				},
				
				_hideProcessing: function() {
					var processingEl = this.element.find('.processing'); 
					var level = parseInt(processingEl.data('level')); 
					processingEl.data('level', level-=1); 
					if(!level) {
						processingEl.hide(); 
					}
				},
				
				getOptionType: function() {
					return this.element.data('type'); 
				},
				
				_create: function() {  
					var that = this; 
					this.showProcessing(2);
					timer.getGMT(function(o) {
						var time = new Date(o.datetime).getTime(); 
						that._initButtonBarEventHandlers(); 
						if(that.getOptionType() == 'above-below')
							that.refreshExpires(time); 
						that.refreshCurrenciesDropField();  
						that.renderChart(time); 
						that.strikeStatistics(); 
					});
				},
				
				refreshCurrenciesDropField: function() { 
					if(this.options.symbol)  
						this.element.find(this.options.currencySelect).val(this.options.symbol); 

					if(this.options.currencyDisabled) 
						this.element.find(this.options.symbolSelect).attr('disabled', 'disabled'); 
				}, 				
				/**
				 * @return expires(secodes INT);
				 */
				getExpires: function() {
					return parseInt(this.element.find(this.options.expiresSelect).val()); 	
				},
				
				getExpiresString: function() {
					return this.element.find(this.options.expiresSelect + ' option:selected').text();
				},
				//remove template in feature
				showStrikeField: function(direction) {
					if( !(direction == 'above' || direction == 'below') )
						return false; 
					
					var that = this; 
					that.strikeElement = $('#strike-form-tmpl').tmpl({
						'rateData': {
							'direction'	 : direction,
							'expiry_date': that.getExpiresString()							
						}
					})
					.on('submit', function(e) {
						var model = {
					    	'price'	  : $(this).find('input.price').val(),
					    	'type'	  : direction,
					    	'currency': that.element.find(that.options.currencySelect).val(),
					    	'expires' : that.getExpires(),
					    	'strike'  : that.strike
					    };
						if(that.validate(model)) {
							tradeApp.addOpendRate(model, function(rate) {
								that.drawGridMarkings(rate);
							}),  
							that.hideStrikeField();
						} 						
						return false;
					})
					.on('keyup', '.price', function(e) {
		    	 		var priceValue = $(this).val();
		    	 		if(that.validatePriceValue(priceValue, '.payout-res')) {
		    	 			that.strikeElement.find('.payout-res').html('PayOut ' + '$' + Math.round(that.options.payout * priceValue) );
		    	 		} 					
					})
					.on('click', '.close', function() {
						that.hideStrikeField(); 
						return false; 
					});
					
					var strikeForm = that.element.find('.strike-form');
					strikeForm.html(that.strikeElement); 				
					strikeForm.slideDown(500, function(){
						$(this).find('input[type="text"]').focus(); 
					}); 
					this.element.find('.payout').slideUp(500); 
				},
				
				hideStrikeField: function() {
					var that = this; 
					var strikeForm = that.element.find('.strike-form');
					strikeForm.slideUp(500, function(){
						strikeForm.find('form').remove(); 
						that.strikeElement = null;
					}); 
					that.element.find('.payout').slideDown(500); 				
				},
				//change currency - reload option block
				//install widget to new option block
				_initButtonBarEventHandlers: function () {
					var that = this; 
					this.element 	
					.on('change', that.options.currencySelect, function(e) {
						var symbol = $(this).val(); 
						var newThumbnail = that.getTemplate({
							widgetName: that.widgetName
						}); 
						that.element.replaceWith(newThumbnail);
						option.widget(that.widgetName).installTo(newThumbnail, $.extend(
								that.options, {
									symbol: symbol
								})
							); 
					})
					.on('change', that.options.expiresSelect, function(e) {
						//if strikeBlock shown
						if( that.strikeElement ) { 
							var UTCString = that.getExpiresString(); 
							that.strikeElement.find('.expires').html(UTCString); 
						}
					})
		    		.on('click', '.btns-row .above, .btns-row .below', function(e) {    
						e.preventDefault();  	
						var direction = $(this).data('direction'); 
						that.showStrikeField(direction); 	
		    		});	
					return this.element; 
				},	
				/*
				 * Validate: 
				 * strike value, 
				 * price value, 
				 * expires
				 */
				validate: function(model) {
					if(!this.validatePriceValue(model.price, '.payout-res')) 
						return false;
					if(model.expires === false) {
						$('.payout-res').addClass('error').html('Invalid Expires');
						return false; 
					}
					if(!model.strike) {
						$('.payout-res').addClass('error').html('Error occurred, try again');
						return false; 
					}
					return true; 
				},
				
				/*
				 * 
				 */
				validatePriceValue: function(priceValue, errorField) {
					errorField = this.element.find(errorField); 
					if(!$.isNumeric(priceValue)){
						errorField.addClass('error').html('Wrong input. Enter Numerical Value').show(); 
						return false; 
			    	 }
			    	 if(priceValue < this.options.minPriceValue){
			    		 errorField.addClass('error').html('Min value is 20').show(); 
			    		 return false; 
			    	 }  
			    	 if(priceValue > user.getBalance() && !user.isGuest()){
			    		 errorField.addClass('error').html('Your balance is ' + '$' + user.getBalance()).show(); 
			    		 return false; 
			    	 }	
			    	 var availablePriceValue; 
			    	 if( priceValue > (availablePriceValue=this.getAvailablePriceValue(priceValue))) {
			    		 errorField.addClass('error').html('Max available price value ' + availablePriceValue + '$').show(); 
			    		 return false; 			    		 
			    	 }
			    	 errorField.removeClass('error').html(''); 
			    	 return true; 				
				}, 
				getAvailablePriceValue: function(pricevValue) {
					var deposit = user.getBalance(); 
					if(deposit>=100 && deposit<=749) {
						return 100; 					
					}
					if(deposit>=750 && deposit<=3499) {
						return 500; 
					}
					if(deposit>=3500 && deposit<=14999) {
						return 1500; 
					}
					if(deposit>=15000 && deposit<=99999) {
						return 3000; 
					}
					if(deposit>=100000) {
						return 5000; 
					}
					return deposit; 					
				},
				
				/*
				 * draw strike line value and strike time value on chart
				 * when rate opened 
				 */ 
				drawGridMarkings: function(rate) { //console.log(rate); 
					console.log('Draw horizontal and vertical line', rate.rate); 
					var that = this; 
					this.plot.getOptions().grid.markings = [];
					this.plot.getOptions().grid.markings.push({
						color: '#FFF',
						rateId: rate.rate_id,
						direction: rate.type,
						location: 'horizontal',
						style: 'solid',
						yaxis: {
							from: rate.rate,
							to: rate.rate
						}						
					}); 
					this.plot.getOptions().grid.markings.push({
						color: '#dbdbdb',
						markingsStyle: 'dashed', 
						rateId: rate.rate_id,
						location: 'vertical',
						style: 'dashed',
						//direction: rate.type,
						xaxis: {
							from: (rate.expiry_timestamp * 1000),
							to: (rate.expiry_timestamp * 1000)
						}						
					}); 					
					//console.log(this.plot.getOptions().grid.markings); 
					tradeApp.rates[rate.rate_id].widget = this; 
		        	this.plot.setupGrid();	
		        	that.plot.draw();
				},				
				/*
				 * remove strike line value and strike time value on chart,
				 * when rate closed
				 */
				removeGridMarkings: function(rate) {
					var that = this; 
					$.each(this.plot.getOptions().grid.markings, function(i, value) {
						if(value && value.rateId == rate.rate_id) { 
							that.plot.getOptions().grid.markings.splice(i, 1);
							that.removeGridMarkings(rate); 
							return ;
						} 
					});
					that.element.find('.expiration').remove(); 
					this.plot.setupGrid();
				},				
				
				lastHightlightPoint: [],
				lastPlotData: {},
				highlightLastPoint: function(point) {
					this.plot.unhighlight(this.lastPlotData, this.lastHightlightPoint);

					if(this.plot.getOptions().grid.markings.length) {
						var marking = this.plot.getOptions().grid.markings[0]; 
						var pointY = marking.yaxis.from; 
						if((point[1] > pointY && marking.direction == 'above') || (point[1] < pointY && marking.direction == 'below')) {
							this.plot.getData()[0].highlightColor = "#91f70e";
						} else if((point[1] < pointY && marking.direction == 'above') || (point[1] > pointY && marking.direction == 'below')){
							this.plot.getData()[0].highlightColor = "#f7290e";
						} else {
							this.plot.getData()[0].highlightColor = "#09BCE8";
						}
					} else {
						this.plot.getData()[0].highlightColor = "#09BCE8";
					}
					
					this.plot.highlight(this.plot.getData()[0], point);
					this.lastPlotData = this.plot.getData()[0]; 
					this.lastHightlightPoint = point; 
				},				
				chartData: [], 
				renderChart: function(time) { //console.log(this.widgetName); 
					var that = this, y, lastChartPoint, lastSubscriptionValue; 
					this.initSubscription(function(quote) { //console.log(quote.bidTime); 
	            		y = (quote.bidPrice + quote.askPrice) / 2;
	            		that.strike = y.toFixed(5);
	            		that.element.find('.option-price').html(y.toFixed(5));
	            		if(that.chartData.length) {
	            			lastSubscriptionValue = y; 
	            			lastChartPoint = that.chartData.pop(); 
	            			that.chartData.push([lastChartPoint[0], y]); 
	            			that.updateChartData(that.chartData); 
//	            			
//		            		that.TimeSeriesSubscription.close(); 
//		            		that.Subscription.close();
	            		}
					}); 
					
					var eventMap = {};
					var updateDataTimeout = null;
					this.plot = $.plot(this.element.find('.chart'), [], $.extend(option.plotOptions, that.options.plotOptions));
					
					this.initTimeSeriesSubscription(time, function(event) { 						
						eventMap[event.time] = event; 
						if (updateDataTimeout === null) {
								updateDataTimeout = setTimeout(function() {
									updateData()
							}, 0);
						}								
					}); 
					
					var updateData = function() { 
						var lastChartPoint; 
						updateDataTimeout = null;
						var closeSeries = [];
						for (var time in eventMap) { 
							var event = eventMap[time];  
							closeSeries.push([time, event.close]);
						}
						closeSeries.sort(function(d1, d2) {
							return d1[0] - d2[0];
						});
						that.chartData = closeSeries; 
						lastChartPoint = that.chartData.pop(); 
						if(lastSubscriptionValue) {
							lastChartPoint[1] = lastSubscriptionValue;
						}
						that.chartData.push(lastChartPoint); 					
						that.updateChartData(that.chartData); 
					};	
				},
				
				changeSymbol: function(symbol) {  
					if(option.symbolIsCurrency(symbol)) {
						return symbol + '{price=bid}'; 
					}
					return symbol; 
				},
				
				closeSeriesLength: null, 
				startLength: null,
				dataSize: 0,
				
				updateChartData: function(closeSeries, setupGrid) { 
					this.closeSeriesLength = closeSeries.length; 
					this.startLength = this.startLength || (this.closeSeriesLength > this.options.chartPoints ? this.options.chartPoints : this.closeSeriesLength); 
					if((diff = (closeSeries.length - this.startLength)) > 0) {
						closeSeries = closeSeries.slice(diff);
					} 
					var data = [closeSeries]; //console.log(data); 
					this.plot.setData(data);
					if (this.dataSize !== this.closeSeriesLength || setupGrid) { 
						this.dataSize = this.closeSeriesLength;
						this.plot.setupGrid();
					}
					this.plot.setupGrid(); 
					this.plot.draw();
					if( this.dataSize !== 0 ) { 
						this.lastChartPoint = closeSeries[closeSeries.length-1]; 
						this.highlightLastPoint(this.lastChartPoint); 
						this._hideProcessing();
					}						
				},
				
				strikeStatistics: function() { 
					var that = this, percents = [],
						aboveProgress = this.element.find('.progress .above'), 
						belowProgress = this.element.find('.progress .below'), 
						leftPercent   = this.element.find('.left.percent'), 
						rightPercent  = this.element.find('.right.percent'),
						currencyValue = this.element.find('.currency select').val();
					
					if(option.optionStatistics[currencyValue]) {
						percents = option.optionStatistics[currencyValue];
						leftPercent.html(percents[0] + '%');
						rightPercent.html(percents[1] + '%');
						aboveProgress.width(percents[0] + '%');
						belowProgress.width(percents[1] + '%');
					}
					this._hideProcessing();
				}
			},
			
			'optionAboveBelowWidget': {
				widgetName: 'optionAboveBelowWidget',
				ExpiresRefreshed: true,
				options: {
					chartHoursBack: 4,
					chartPoints	  : 240, 
					plotOptions: {
						xaxis: {
							mode: "time",
							minTickSize: [20, "minute"],							
							autoscaleMargin: 0.5//0.02
						}						
					}					
				},

				_create: function() {  
					var that = this; 
					this.showProcessing(2);
					timer.getGMT(function(o) {
						var time = new Date(o.datetime).getTime(); 
						that._initButtonBarEventHandlers(); 
						that.refreshCurrenciesDropField();
						that.refreshExpiresDropField(time); 
						that.renderChart(time); 
						that.strikeStatistics();
					});
				},	
				
				_initButtonBarEventHandlers: function() {
					var that = this; 
					this._super()
						.on('click', '.periods span', function(e) {
							$(this).addClass('active').siblings().removeClass('active'); 
							that.updateChartPeriod($(this));
						}); 
				},
				
				updateChartPeriod: function(loader) {
					this.startLength = null;
					this.dataSize = 0;
					this.options.chartPoints = this.startLength = parseFloat(loader.data('hour')) * 60;
					this.updateChartData(this.chartData, true);					
				},
				
				/* the difference between rates single currency 
				 * must be more then 2 minute
				 */
				strikeAvailable: function(model) {
					var _return = true; 
					$.each(tradeApp.rates, function(rateId, rate) {
						if(
							rate.currency == model.currency &&
							(timer.time - (parseInt(rate.rate_timestamp) * 1000) < 120000) //2 minutes
						) {
							tradeApp.dialog('Error', 'Option unavailable, try in a few minutes.'); 
							_return = false;
							return false; 
						}
					});							
					return _return; 
				},	
				//parent::validate &&
				validate: function(model) {
					return this._super(model) && this.strikeAvailable(model);
				},
				
				getTemplate: function(opt) {
					return $('#_thumbnail-abovebelow-tmpl').tmpl(opt); 
				},					
				
				/* refresh options Expires
				 * if "expires at" smaller than 1 minute
				 */
				expiresRefresh: function(UTC) {
					UTC = UTC || new Date(timer.time);
					var minutes = UTC.getUTCMinutes();		
					var d = 15 - (minutes % 15);
					if(d <= 3) {  
						if(!this.ExpiresRefreshed) {
							this.refreshExpiresDropField(timer.time); 
							this.ExpiresRefreshed = true; 						
						}
					} else  
						this.ExpiresRefreshed = false; 					
				},
				
				refreshExpiresDropField: function(UTCTime) {  
					var that = this; 
					var select = this.element.find('.expires select'); 
					var selected = select.val();
					
					select.html(''); 
					var now = new Date(UTCTime), 
						minutes = now.getUTCMinutes(), 
						d = 15 - (minutes % 15),
						diff = (d > 3 ? d : 15 + d) * 60000; 
					 
					var groupToday =  $('<optGroup/>'); 
						groupToday.attr('label', 'Today').appendTo(select);
					var i = 4;
					var start = diff; 
					while( i-- ) {
						var gmt = new Date(UTCTime + start); 
						var time = timer.getUTCString(gmt);
						var hh = time.substring(0, time.lastIndexOf(":")) + time.substring(time.lastIndexOf(":") + 1);				
						var val = ((UTCTime + start) / 60000); //value - minutes (Integer division)
						
						$('<option/>').val(val).text(hh).appendTo(groupToday);
						start+= 900000;  //add 15 min
					}
					
					var gmtTomorrow = new Date();
					gmtTomorrow.setTime(UTCTime + diff + 86400000); 
					
					var time = timer.getUTCString(gmtTomorrow);
					var hh = time.substring(0, time.lastIndexOf(":")) + time.substring(time.lastIndexOf(":") + 1);					
					var val = (gmtTomorrow.getTime() / 60000);
					var groupToday =  $('<optGroup/>'); 
						groupToday.attr('label', 'Tomorrow').appendTo(select);
					$('<option/>').val(val).text(hh).appendTo(groupToday);	
					//return selected value if exists
					select.val(selected); 
					//not found Expires value and popup shown
					if(select.val() != selected && that.strikeElement) {
						that.hideStrikeField(); 
					}
				},				
				
				countdown: function(UTC) {
					var expiresOptionValue = parseInt(this.element.find('.expires select').val()) * 60;
					if( expiresOptionValue ) {
						diff = (expiresOptionValue - (timer.time/1000)) - 180;
						h = Math.floor(diff/3600);  
						diff = diff%3600; 
						m = Math.floor(diff/60); 
						s = diff % 60; 
						this.element.find('.countdown-input').html(('0' + h).slice(-2)+':'+('0' + m).slice(-2)+':'+('0' + s).slice(-2)); 
					}						
				},
				
				getExpires: function() {
					var expiresValue = parseInt(this.element.find(this.options.expiresSelect).val()); 	
					return expiresValue * 60;
				},
				
				getExpiresString: function() {
					var expires = this.getExpires(); 
					return new Date(expires * 1000).toUTCString(); 
				},				
			},			
			
			'optionWidget60sec' : {
				widgetName: 'optionWidget60sec',
				options: {
					chartHoursBack	 : 0.25,
					chartPoints		 : 15, 
					plotOptions: {
						xaxis: {
							mode: "time",
							minTickSize: [5, "minute"],
							autoscaleMargin: 0//0.02
						}						
					}					
				},				
				getTemplate: function(opt) {
					return $('#_thumbnail-60seconds-tmpl').tmpl(opt); 
				}			
			},
			
			'optionBuilderWidget': {
				widgetName: 'optionBuilderWidget',
				options: {
					plotOptions: {
						xaxis: {
							mode: "time",
							minTickSize: [20, "minute"],
							autoscaleMargin: 0.5//0.02
						}						
					}					
				},				
				getTemplate: function(opt) {
					return $('#_thumbnail-builder-tmpl').tmpl(opt); 
				},			
				
				getExpires: function() {
					var hours 	= parseInt(this.element.find('select.hours').val()), 
						minutes = parseInt(this.element.find('select.minutes').val()); 
					return hours || minutes ? (~~(timer.time/60000) + hours + minutes) * 60 : false						
				},
				
				getExpiresString: function() {
					var expires = this.getExpires(); 
					return expires !== false && new Date(expires * 1000).toUTCString() || "Invalid expires";
			
				},				
			}			
		}
	}
}(tradeApp))



$(function() {

}); 



//function getTime(zone, success) {
//    var url = 'http://json-time.appspot.com/time.json?tz=' + zone,
//        ud = 'json' + (+new Date());
//    window[ud]= function(o){
//        success && success(new Date(o.datetime));
//    };
//    document.getElementsByTagName('head')[0].appendChild((function(){
//        var s = document.createElement('script');
//        s.type = 'text/javascript';
//        s.src = url + '&callback=' + ud;
//        return s;
//    })());
//}
//
//getTime('GMT', function(time){
//    // This is where you do whatever you want with the time:
//    console.log(time);
//    setTimeout(function(){
//    	getTime('GMT', function(time){    
//    		console.log(time);
//    	})
//    }, 1000);
//})    

$(function() {
//	$.getTime = function(zone, success) {
//	    var url = 'http://json-time.appspot.com/time.json?tz='
//	            + zone + '&callback=?';
//	    $.getJSON(url, function(o){
//	        success && success(new Date(o.datetime), o);
//	    });
//	};
	 
	// Usage:
//	$.getTime('GMT', function(time){
//	    alert(time);
//	});
})


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
/*
$.extend(timer, {
	getUTCString: function(GMT, s) {
		var hours   = GMT.getUTCHours(),
			minutes = GMT.getUTCMinutes(),
			seconds = GMT.getUTCSeconds();	
		
		return '<strong>' + hours + ':' + 
			('0' + minutes).slice(-2) + '</strong>:' + 
			(s ? ('0' + seconds).slice(-2) : '') + ' GMT';		
	},	
	afterTimeUpdate: function(UTC) {
		this.showIn('#time', true);
	}
})
*/ 

$(function() {
	"use strict";

	var plot = $.plot($('.graph'), [], {
		color:'rgb(190,232,216)',
		series: {
			lines: { 
				show: true,
			    lineWidth: 1,
		        color: 'rgba(255,230,230,0.5)',
			    opacity: 0.2,
				fill: true,
				zero: false,
		        fillColor: { 
		        	colors: ["rgba(0, 0, 0, 0.4)", "rgba(255, 255, 255, 0.1)"]
		        }		    
			},
			highlightColor: 'rgb(190,232,216)',
			state: true,
//			points: {
//				symbol: "triangle"
//			}
			
		},
		 yaxis: {
			 font: {
				 color: '#cccccc'
			 },		 
		 },		 
		 xaxis: {
			 mode: "time",
			 font: {
				 color: '#cccccc'
			 },			 
			 //timeformat: "%y/%m/%d",
			 minTickSize: [0.5, "hour"]
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
	});

	var sub = dx.feed.createTimeSeriesSubscription("Candle");
    var eventMap = {}; // time -> event
	var dataSize = 0;
	var updateDataTimeout = null;

	$('select.symbol').change(updateSymbol);
	updateSymbol(); 
	sub.onEvent = function(event) {
		eventMap[event.time] = event;
		if (updateDataTimeout === null)
			updateDataTimeout = setTimeout(updateData, 0);
	};

	function updateSymbol() { 
	    var selected = $(':selected', this);
	    var optgroup = selected.closest('optgroup').attr('label');
		var symbol = $(this).val() || 'EUR/USD';
		if(optgroup == 'Currencies') {
			symbol+="{price=bid}"; 
		}
		
		setData([]);
		eventMap = {};

		sub.setFromTime(t - 2 * 3600 * 1000);
		sub.setSymbols(dx.symbols.changeAttribute(symbol, "", "1min"));
	}

	function updateData() {
		updateDataTimeout = null;
		var closeSeries = [];
		for (var time in eventMap) {
			var event = eventMap[time];
			closeSeries.push([time, event.close]);
		}
		closeSeries.sort(function(d1, d2) {
			return d1[0] - d2[0];
		});
		setData(closeSeries);
	}
	var lastChartPoint, 
		lastHightlightPoint,
		lastPlotData = []; 
	function setData(closeSeries) { 
		var data = [closeSeries];
		plot.setData(data); 
		if(closeSeries[closeSeries.length-1]) {
			$('.option-price strong, .investment-option-price').text(closeSeries[closeSeries.length-1][1]);
		}
		
		if (dataSize !== closeSeries.length) {
			dataSize = closeSeries.length;
			plot.setupGrid();			
		}
		plot.draw();
		if(dataSize !== 0 ) {
			lastChartPoint = closeSeries[closeSeries.length-1]; 
			highlightLastPoint(lastChartPoint); 
		}		
	}
	
	function highlightLastPoint(point) {
		plot.unhighlight(lastPlotData, lastHightlightPoint);

		plot.getData()[0].highlightColor = "#2385ea";
		plot.highlight(plot.getData()[0], point);
		lastPlotData = plot.getData()[0]; 
		lastHightlightPoint = point; 		
	}
});
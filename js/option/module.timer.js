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
			this.getGMT(function(o) {
				timer.time = new Date(o.datetime).getTime();
				runTimer(); 
				setInterval(function() {
					runTimer(); 
				}, 1000);					
			})		
		},
		showIn: function(el, seconds) {
			$(el).html(this.getUTCString(new Date(timer.time), seconds)); 
		},
		afterTimeUpdate: function(UTC) {
			
		}
	}
}(typeof Config !== 'undefined' && Config || {})); 

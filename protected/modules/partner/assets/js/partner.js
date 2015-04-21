$(function(){

});
function _confirm(title, message, loader){ 
	var confirm = false;
	$("<div></div>").dialog({
		'title': title,
		modal: true,
		close: function(event, ui) { jQuery(this).remove(); },
		resizable: false,
		buttons: [ 
		          {
						text: "Ok", 
						click: function() { 
							confirm = true;
							$( this ).dialog( "close" ); 
						} 
					},
					{
						text: "Cancel", 
						click: function() { 
							confirm = false;
							$( this ).dialog( "close" ); 
						} 
					}            
				],
				close: function( event, ui ) { 
					if(confirm){ 
						if($(loader).prop("tagName") == 'A' || $(loader).prop("tagName") == 'a'){
							location.href = $(loader).attr('href');
						} else {
							$(loader).attr('onclick', '');
							$(loader).trigger("click");							
						}
					}
			    }						
		
	}).text(message);	
	return false; 
}

function dialog(title, body) {
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
}
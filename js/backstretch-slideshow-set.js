jQuery(document).ready(function($) {
	$( BackStretchVar.container ).backstretch([BackStretchVar.src1],{duration:BackStretchVar.duration,fade:BackStretchVar.fade,centeredY:true});
	
	$( window ).load(function() {

		var instance = $( BackStretchVar.container ).data('backstretch');

		if ( BackStretchVar.src2.length == 0 ) {
			
			return;
		
		} else { 
    			
			instance.images.push( BackStretchVar.src2 )
		}
		
		if ( BackStretchVar.src3.length == 0 ) {
			
			return;
		
		} else { 
    			
			instance.images.push( BackStretchVar.src3 )
		}

	});

});
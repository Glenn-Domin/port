/*jQuery(document).ready(function() {
// Sticky Main Menu if scrolled down

    jQuery(window).scroll(function() {
    
    if(jQuery( window ).width() > 1000) {

        var wind_height = jQuery(window).scrollTop();
        var head_height = jQuery('#header_container').height();

        if (wind_height > head_height) {
            jQuery('body').addClass('floating');
        } else {
            jQuery('body').removeClass('floating');
        }
        
        }
    });
	*/
	var terms = ['Whizz with EDMs', 'Fierce Joomla Supporter', 'sarcastic introvert', '<span class="opt">prodigious</span> chocolate consumer', 'fresh out of witty remarks.']; //array of terms to rotate
	var ended = false;
  
  
	jQuery('#describe-me, #describe-before').click(function() {
	
		if(ended == false) {
    
		var ct = jQuery("#describe-me").data("term") || 0;
		
		if(terms[ct] != terms.slice(-1)) {
		
		jQuery("#describe-me").fadeOut(200, function() {
		
			jQuery("#describe-me").data("term", ct == terms.length -1 ? 0 : ct + 1).html(terms[ct]).fadeIn();
		
		});
		}
		else {
		
		jQuery("#describe-before").fadeOut(200);
		
		jQuery("#describe-me").fadeOut(200, function() {
		
			jQuery("#describe-me").data("term", ct == terms.length -1 ? 0 : ct + 1).html(terms[ct]).fadeIn(200, function() {
        
        jQuery("#describe-me").addClass('no-hover');
			
				ended = true;
			
			});
		
		
		});
		
		}
		
		}
		
		return false;
		
	});


//});


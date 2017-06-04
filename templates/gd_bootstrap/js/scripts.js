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

/**
 * Links
 */

/**
 * Describe Me
 */

  var terms = ['CSS Genius.', 'Whizz with EDMs.', 'Fierce Joomla Supporter.', 'Performance King.', 'sarcastic introvert.', '<span class="opt">prodigious</span> mango consumer.', 'fresh out of witty remarks.']; //array of terms to rotate
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

/**
 * Ease Item
 
var $content = $('#blog'),
    animBit  = $('.to-animate'),
  docViewTop = $(window).scrollTop();
docViewBottom = docViewTop + $(window).height();

animBit.not('.animate').each(function(i, obj) {
  if (isScrolledIntoView(this) === true) {
    $(this).toggleClass('animate');
  }
});

window.requestAnimFrame = (function()
{
  
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();


function Scroller()
{
  this.latestKnownScrollY = window.scrollY;
  this.ticking            = false;
}

Scroller.prototype = {

  init: function() {
    window.addEventListener('scroll', this.onScroll.bind(this), false);
    window.addEventListener('onload', this.onScroll.bind(this), false);
  },


  onScroll: function() {
    docViewTop = $(window).scrollTop();
    docViewBottom = docViewTop + $(window).height();
    
    this.latestKnownScrollY = window.scrollY;
    this.requestTick();
    
    // Animating on scroll
    // TODO: create array of each, and use for instead of each
    animBit.not('.animate').each(function(i, obj) {
      if (isScrolledIntoView(this) === true) {
        $(this).toggleClass('animate');
      }
    });
  },


  requestTick: function() {
    if( !this.ticking ) {
      window.requestAnimFrame(this.update.bind(this));
    }
    this.ticking = true;
  },


  update: function() {
    var currentScrollY = this.latestKnownScrollY;
    this.ticking       = false;
    

    var slowScroll = currentScrollY / 5;
    
    $content.css({
      'transform'         : 'translateY(-' + slowScroll + 'px)',
      '-moz-transform'    : 'translateY(-' + slowScroll + 'px)',
      '-webkit-transform' : 'translateY(-' + slowScroll + 'px)'
    });
  }
};
  
function isScrolledIntoView(elem) {

  elemTop = $(elem).offset().top;
  elemBottom = elemTop + $(elem).height();

  return ((elemBottom - 800 <= docViewBottom));
}


var scroller = new Scroller();  
scroller.init();
scroller.requestTick();

*/
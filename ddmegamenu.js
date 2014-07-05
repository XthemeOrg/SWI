/* DD Mega Menu
* Created: June 13th, 2011 by DynamicDrive.com. This notice must stay intact for usage 
* Author: Dynamic Drive at http://www.dynamicdrive.com/
* Visit http://www.dynamicdrive.com/ for full source code
*/

// July 27th, 11': Added ability to activate menu via "click" of the mouse, on top of the default "mouseover".

jQuery.noConflict()

jQuery.extend(jQuery.easing, {  //see http://gsgd.co.uk/sandbox/jquery/easing/
	easeOutBack:function(x, t, b, c, d, s){
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	}
})

var ddmegamenu={
	startzindex:100,
	wrapperoffset:[10,25], //additional width and height to add to outer wrapper of drop down menus to accomodate CSS drop down shadow, if any
	ismobile:navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i) != null, //boolean check for popular mobile browsers

	init:function(setting){
		var $=jQuery
		var s=$.extend({fx:'slide', easing:'easeInOutSine', dur:'normal', hidedelay:200}, setting)
		if (s.fx=="none") //if fx is disabled, bypass animation
			s.dur=0
		var $mainmenu=$('#'+s.menuid)
		$anchors=($mainmenu.attr('rel'))? $mainmenu : $mainmenu.find('a[rel]')
		function buildmenu($anchors){
			$anchors.each(function(){ //loop through anchor links
				var $anchor=$(this)
				var $submenu=$('#'+$anchor.attr('rel').replace(/\[\w+\]/, '')) //extract "submenuid" from rel="submenuid[orientation]" to reference submenu
				var orienttoleft=/\[left\]/.test($anchor.attr('rel')) //check for rel="submenuid[left]" to indicate submenu should be left aligned
				$submenu.wrap('<div class="megawrapper" style="z-index:'+ddmegamenu.startzindex+';position:absolute;top:0;left:0;visibility:hidden"><div style="position:absolute;overflow:hidden;left:0;top:0;width:100%;height:100%;"></div></div>')
					.css({visibility:'inherit', top:-$submenu.outerHeight()}) //set submenu's top pos so it's out of view intially
					.data('timer', {}) //add timer data object to submenu object
				var $wrapper=$submenu.closest('div.megawrapper').css({width:$submenu.outerWidth()+ddmegamenu.wrapperoffset[0], height:$submenu.outerHeight()+ddmegamenu.wrapperoffset[1]}) //reference outermost wrapper of submenu and set its dimensions
				var $wrapperparent=$anchor.closest('div.megawrapper') //check if this anchor link is defined inside a submenu wrapper (nested menu)
				if ($wrapperparent.length>0){ //if so
					$wrapper.appendTo($wrapperparent) //move corresponding submenu wrapper to within its parent submenu wrapper
				}
				else{ //else if this submenu wrapper is topmost
					$wrapper.appendTo(document.body) //move it so it's a child of document.body
					$submenu.data('istopmenu', true) //indicate this is top level wrapper
				}
				$anchor.bind((setting.trigger=="click")? "click" : "mouseenter", function(e){ //when mouse clicks on or mouses over anchor
					clearTimeout($submenu.data('timer').hide)
					var offset=($submenu.data('istopmenu'))? $anchor.offset() : $anchor.position()
					if ($submenu.data('istopmenu')){
						$anchors.removeClass('selected')
						$anchor.addClass('selected')
					}
					$wrapper.css({visibility:'visible', left:offset.left-(orienttoleft? $wrapper.outerWidth()-$anchor.outerWidth()-ddmegamenu.wrapperoffset[0] : 0), top:offset.top+$anchor.outerHeight(), zIndex:++ddmegamenu.startzindex})
					$submenu.stop().animate({top:0}, s.dur, s.easing) //animate submenu into view
					if (setting.trigger=="click" && !ddmegamenu.ismobile) //returning false in mobile browsers seem to lead to strange behavior
						return false
				})
				$anchor.mouseleave(function(){ //when mouse moves OUT anchor
					$submenu.data('timer').hide=setTimeout(function(){
						$submenu.stop().animate({top:-$submenu.outerHeight()}, s.dur, function(){$wrapper.css({visibility:'hidden'})}) //animate submenu out of view and hide wrapper DIV
						$anchor.removeClass('selected')
					}, s.hidedelay)
				})
				$anchor.click(function(e){
					if (ddmegamenu.ismobile) //on ipad/iphone, disable anchor link (those with a drop down menu) when clicked on (triggered by mouseover event on desktop), so menu is given a chance to appear
						return false
				})
				$wrapper.mouseenter(function(){ //when mouse moves OVER submenu wrapper
						clearTimeout($submenu.data('timer').hide)
				})
				$wrapper.bind('mouseleave click', function(e){ //when mouse moves OUT or CLICKs on submenu wrapper
					$submenu.data('timer').hide=setTimeout(function(){
						$submenu.stop().animate({top:-$submenu.outerHeight()}, (e.type=="click")? 0 : s.dur, function(){$wrapper.css({visibility:'hidden'})}) //animate submenu out of view and hide wrapper DIV
						$anchor.removeClass('selected')
					}, s.hidedelay)
				})
				buildmenu($submenu.find('a[rel]')) //build next level sub menus
			})
		}
		buildmenu($anchors)
	},

	docinit:function(setting){
		jQuery(function($){ //on document.ready
			ddmegamenu.init(setting)
		})
	}

}




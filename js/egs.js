/*!
 * placeholder support for non webkit browsers
 * really?!? get a new browser!
 */
if ($.browser.webkit) {
	$.fn.extend  ({
		placeholderFunction : function (focusClass) {
			return this.each(function() {
				$(this).focus(function() {
					$(this).parentsUntil('div').parent().addClass(focusClass);
				$(this).blur(function () {
					$(this).parentsUntil('div').parent().removeClass(focusClass);
			});
			});
		});
	} });
} else {
	$.fn.extend  ({
		placeholderFunction : function (focusClass) {
			return this.each(function() {
				var placeholder = $(this).attr("placeholder");
					$(this).val(placeholder);
					$(this).removeAttr("placeholder");
				$(this).focus(function() {
					$(this).parentsUntil('div').parent().addClass(focusClass);
					if ($(this).val() == placeholder) { $(this).val(''); }
				$(this).blur(function () {
					$(this).parentsUntil('div').parent().removeClass(focusClass);
					if ($.trim($(this).val()) == '') { $(this).val(placeholder); }
				});
			});
		});
	} });
};

/*!
 * function to make select boxes look purdy
 */
(function ($) {

    // skin the select
    $.fn.select_skin = function (w) {
        return $(this).each(function(i) {
            s = $(this);
            if (!s.attr('multiple')) {
                // create the container
                s.wrap('<div class="cmf-skinned-select"></div>');
                c = s.parent();
                c.children().before('<div class="cmf-skinned-text">&nbsp;</div>').each(function() {
                    if (this.selectedIndex >= 0) $(this).prev().text(this.options[this.selectedIndex].innerHTML)
                });
                c.width(s.outerWidth()-2);
                c.height(s.outerHeight()-2);

                // skin the container
                c.css('background-color', s.css('background-color'));
                c.css('color', s.css('color'));
                c.css('font-size', s.css('font-size'));
                c.css('font-family', s.css('font-family'));
                c.css('font-style', s.css('font-style'));
                c.css('position', 'relative');

                // hide the original select
                s.css( { 'opacity': 0,  'position': 'relative', 'z-index': 100 } );

                // get and skin the text label
                var t = c.children().prev();
                t.height(c.outerHeight()-s.css('padding-top').replace(/px,*\)*/g,"")-s.css('padding-bottom').replace(/px,*\)*/g,"")-t.css('padding-top').replace(/px,*\)*/g,"")-t.css('padding-bottom').replace(/px,*\)*/g,"")-2);
                t.width(c.innerWidth()-s.css('padding-right').replace(/px,*\)*/g,"")-s.css('padding-left').replace(/px,*\)*/g,"")-t.css('padding-right').replace(/px,*\)*/g,"")-t.css('padding-left').replace(/px,*\)*/g,"")-c.innerHeight());
                t.css( { 'opacity': 100, 'overflow': 'hidden', 'position': 'absolute', 'text-indent': '0px', 'z-index': 1, 'top': 0, 'left': 0 } );

                // add events
                c.children().click(function() {
                    t.text( (this.options.length > 0 && this.selectedIndex >= 0 ? this.options[this.selectedIndex].innerHTML : '') );
                });
                c.children().change(function() {
                    t.text( (this.options.length > 0 && this.selectedIndex >= 0 ? this.options[this.selectedIndex].innerHTML : '') );
                });
             }
        });
    }

    // un-skin the select
    $.fn.select_unskin = function (w) {
        return $(this).each(function(i) {
            s = $(this);
            if (!s.attr('multiple') && s.parent().hasClass('cmf-skinned-select')) {
                s.siblings('.cmf-skinned-text').remove();
                s.css( { 'opacity': 100, 'z-index': 0 } ).unwrap();
             }
        });
    }
}(jQuery));

/*!
 * jQuery documents calls start here
 */
$('document').ready(function() {
	
	$("body").prepend('<ul id="notifications"></ul>');
	
	/*!
	 * input place holders
	 */ 
	$('input[type="text"]').placeholderFunction('input-focused');
	
	/*!
	 * show or hide the flags thing
	 */
	$('#flagstable').hide();
	
	$('#flagstoggle').click(function(){
		$('#flagstable').toggle();
	});
	
	/*!
	 * show or hide the vhost take list
	 */
	$('#taketable').hide();
	
	$('#taketoggle').click(function(){
		$('#taketable').toggle();
	});

	/*!
	 * thing to make akill timed section appear
	 */
	$('section#timed').hide();
	$('select#akill_type').change(function() {
		if ($(this).val() == "!T") {
			$('section#timed').slideDown();
		} else {
			$('section#timed').slideUp();
		}
	});
	
	/*!
	 * thing to make akick timed section appear
	 */
	$('section#timed-ak').hide();
	$('select#akick_type').change(function() {
		if ($(this).val() == "!T") {
			$('section#timed-ak').slideDown();
		} else {
			$('section#timed-ak').slideUp();
		}
	});

	/*!
	 * when the user clicks the AKill id input it into the akill val
	 */
	$('#aid').click(function() {
		// get the aid
		var aid = $(this).html();

		// set the text box value
		$('#akill_id').val(aid);
	});

	/*!
	 * input select boxes
	 */
	$('select').select_skin();
	
});

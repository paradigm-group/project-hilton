/*global $, jQuery, alert*/
jQuery(window).load(function () {
    "use strict";
    
    // Fade in images so there isn't a color "pop" document load and then on window load
    //jQuery("ul.menu img").fadeIn(500);
    
    // greyscale image (homepage block)
	/*
    jQuery('ul.menu img').each(function(){
	var el = jQuery(this);
	el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"998","opacity":"0"}).insertBefore(el).queue(function(){
	    var el = jQuery(this);
	    el.parent().css({"width":this.width,"height":this.height});
	    el.dequeue();
	});
	    this.src = grayscale(this.src);
	});
	

	// Fade image 
	jQuery('ul.menu li').mouseover(function(){
	    //jQuery(this).find('img:first').stop(true,true).animate({opacity:1},'fast');
	    jQuery(this).find('a').stop(true,true).animate({ backgroundColor: "#db1446" },'fast');
	})
	jQuery('ul.menu li').mouseout(function(){
	    //jQuery(this).find('img:first').stop(true,true).animate({opacity:0},'fast');
	    jQuery(this).find('a').stop(true,true).animate({ backgroundColor: "#444444" },'fast');
	});
	
	
	jQuery('ul.menu li a').mouseover(function(){
	    //jQuery(this).parent().find('img:first').stop(true,true).animate({opacity:1}, 250);
	    jQuery(this).parent().find('a').stop(true,true).animate({ backgroundColor: "#db1446" }, "fast");
	})
	jQuery('ul.menu li a').mouseout(function(){
	    //jQuery(this).parent().find('img:first').stop(true,true).animate({opacity:0}, 250);
	    jQuery(this).parent().find('a').stop(true,true).animate({ backgroundColor: "#444444" }, "fast");
	});
	*/

	
	
	// Alphabetical Index
	jQuery('ul.letter_index > li').hide();
	jQuery('ul.letter_index').find('li:first').css('display', 'block');
	jQuery('ul.alphaIndex li a').click(function () {
	    var href = jQuery(this).attr('href');
	    if (jQuery('ul.letter_index li' + href).is(':hidden')) {
            closeIndex();

            jQuery('ul.letter_index li' + href).show('fast');
	    }
	    return false;
	});
	
	// Calendar workaround
	jQuery('table.my-calendar-table a.trigger').click(function () {
	    jQuery(this).parent().find('div.calendar-events').slideToggle('fast');
	    return false;
	});
	jQuery('a.mc-close').click(function () {
	    jQuery(this).parent().parent().parent().parent().slideUp('fast');
	    return false;
	});
	
	// Footer menu CSS workaround
	jQuery('footer div.menu-footer-menu-container ul').find('li:first').css('background', 'none');
	
	// Header menu CSS workaround
	//jQuery('ul#menu-main-menu > li:last').css('background','none').css('padding-right','0px');
	
	// RSS Blocks fancy styff
	jQuery('aside.rsspageblock > ul:gt(1)').hide();
	jQuery('aside.rsspageblock h3 a').click(function () {
	    jQuery(this).parent().parent().find('ul').slideToggle();
	    return false;
	});
	
	// RSS Logos fix
	jQuery('aside.rsspageblock h3 img').attr('width', 'auto').attr('height', '15px');
	
	
	// Homepage news ticker
	jQuery('#hpageTicker').innerfade({
	    animationtype: 'fade',
	    speed: 500,
	    timeout: 7000,
	    type: 'sequence',
	    containerheight: '80px'
	});

    // Homepage news ticker
	jQuery('.home-ticker').innerfade({
	    animationtype: 'fade',
	    speed: 500,
	    timeout: 7000,
	    type: 'sequence',
        containerheight: '25px'
	});
	
	// LogOut Button/link
	var logoutLink = jQuery('span#logoutButton').html();
	jQuery('.menu-footer-menu-container').
        append('<img src="/wp-content/themes/hub/images/presentations.jpg" id="footer-hub-logo" alt="" title="" /><br /><a href="' + logoutLink + '" class="logout_link">Logout</a>');
});

function closeIndex() {
    "use strict";
    jQuery('ul.letter_index > li').each(function () {
        if (jQuery(this).is(':visible')) {
            jQuery(this).hide('fast');
        }
    });
}
	
// Grayscale w canvas method
function grayscale(src) {
    "use strict";
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height;
	ctx.drawImage(imgObj, 0, 0);
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for (var y = 0; y < imgPixels.height; y++){
	    for(var x = 0; x < imgPixels.width; x++){
		var i = (y * 4) * imgPixels.width + x * 4;
		var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
		imgPixels.data[i] = avg; 
		imgPixels.data[i + 1] = avg; 
		imgPixels.data[i + 2] = avg;
	    }
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();
}

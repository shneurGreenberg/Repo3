/*  Table of Contents
01. MENU ACTIVATION
02. FITVIDES RESPONSIVE VIDEOS
03. MOBILE MENU
04. SCROLL TO TOP MENU JS
05. PRELOADER JS
06. STICKY HEADER JS
07. SHOW/HIDE SEARCH & Profile
08. Comments/Social Icons ON/Off
09. Comment JS
10. Range Slider in Header Search
*/
jQuery('.menu-item-692').removeClass('current-menu-item');

jQuery(document).ready(function($) {
	 'use strict';


/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/
	 jQuery('.progression-studios-one-page-nav-off nav#site-navigation ul.sf-menu').superfish({
			 	popUpSelector: 'ul.sub-menu,.sf-mega', 	// within menu context
	 			delay:      	200,                	// one second delay on mouseout
	 			speed:      	0,               		// faster \ speed
		 		speedOut:    	200,             		// speed of the closing animation
				animation: 		{opacity: 'show'},		// animation out
				animationOut: 	{opacity: 'hide'},		// adnimation in
		 		cssArrows:     	true,              		// set to false
			 	autoArrows:  	true,                    // disable generation of arrow mark-up
		 		disableHI:      true,
	 });

/*
=============================================== 02. FITVIDES RESPONSIVE VIDEOS  ===============================================
*/
	 $("#content-pro, #video-page-title-pro").fitVids();


/*
=============================================== 03. MOBILE MENU  ===============================================
*/

   	$('ul.mobile-menu-pro').slimmenu({
   	    resizeWidth: '960',
   	    collapserTitle: 'Menu',
   	    easingEffect:'easeInOutQuint',
   	    animSpeed:350,
   	    indentChildren: false,
   		childrenIndenter: '- '
   	});


	$('.mobile-menu-icon-pro').on('click', function(e){
		e.preventDefault();
		$('#main-nav-mobile').slideToggle(350);
		$("#masthead-pro").toggleClass("active-mobile-icon-pro");
	});

	$('#vayvo-progression-search-mobile-button').on('click', function(e){
		e.preventDefault();
		$('#mobile-video-search-header #video-search-header-filtering').slideToggle(350);
		$("#mobile-video-search-header").toggleClass("active");
	});




/*
=============================================== 04. SCROLL TO TOP MENU JS  ===============================================
*/
  	// browser window scroll (in pixels) after which the "back to top" link is shown
	$('#pro-scroll-top').hide();

    $(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('#pro-scroll-top').fadeIn();
		} else {
			$('#pro-scroll-top').fadeOut();
		}
	 });

	 // Click event to scroll to top
     $('#pro-scroll-top').on('click', function(){
         $('html, body').animate({scrollTop : 0},800);
         return false;
     });

	 var offset_scroll = 150;


	/* Scroll to link inside page */
	$('a.scroll-to-link').on('click', function(){
	  $('html, body').animate({
	    scrollTop: $( $.attr(this, 'href') ).offset_scroll().top - pro_top_offset
	  }, 400);
	  return false;
	});



/*
=============================================== 05. PRELOADER JS  ===============================================
*/
	(function($) {
		var didDone = false;
		    function done() {
		        if(!didDone) {
		            didDone = true;
					$("#page-loader-pro").addClass('finished-loading');
					$("#boxed-layout-pro").addClass('progression-preloader-completed');
		        }
		    }
		    var loaded = false;
		    var minDone = false;
		    //The minimum timeout.
		    setTimeout(function(){
		        minDone = true;
		        //If loaded, fire the done callback.
		        if(loaded)  {  done(); } }, 400);
		    //The maximum timeout.
		    setTimeout(function(){  done();   }, 2000);
		    //Bind the load listener.
		    $(window).load(function(){  loaded = true;
		        if(minDone) { done(); }
		    });
	})(jQuery);


/*
=============================================== 06. STICKY HEADER JS  ===============================================
*/

	/* HEADER HEIGHT FOR SPACING OF ONE PAGE NAV AND STICKY HEADER */
	var pro_top_offset = $('header#masthead-pro').height();  // get height of fixed navbar

	var pro_very_top_bar_offset = $('#vayvo-progression-header-top').height();  // get height of fixed navbar


  	$('#progression-sticky-header').scrollToFixed({ spacerClass: 'hide-fixed-spacer-mobile' });


	$(window).resize(function() {
	   var width_progression = $(document).width();
	      if (width_progression > 959) {

				/* STICKY HEADER CLASS */
				$(window).on('load scroll resize orientationchange', function () {

				    var scroll = $(window).scrollTop();
				    if (scroll >=  pro_very_top_bar_offset + 1 ) {
				        $("#progression-sticky-header").addClass("progression-sticky-scrolled");
				    } else {
				        $("#progression-sticky-header").removeClass("progression-sticky-scrolled");
				    }
				});
			} else {

				$(window).on('load scroll resize orientationchange', function () {
				 	$("#progression-sticky-header").removeClass("progression-sticky-scrolled");
				});

			}

	}).resize();



/*
=============================================== 07. SHOW/HIDE SEARCH & Profile  ===============================================
*/

	$("#progression-studios-header-search-icon").on('click', function(e){
		var $this = $("#progression-studios-header-width");
	    if ($this.hasClass('active-search-icon-pro')) {
	        $this.removeClass('active-search-icon-pro').addClass('hide-search-icon-pro');
	    } else {
	        $this.addClass('active-search-icon-pro');
	    }
	});


	$("#header-user-profile-click").on('click', function(e){
		var $this = $("#header-user-profile");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});




	$(document).on('click', function(e){
	    if (e.target.id != 'header-user-profile' && !$('#header-user-profile').find(e.target).length) {
	        if ($("#header-user-profile").hasClass('active')) {
	        	$("#header-user-profile").removeClass('active').addClass('hide');
	        }
	    }



	    if (e.target.id != 'progression-studios-header-search-icon' && !$('#progression-studios-header-search-icon').find(e.target).length) {

			if (e.target.id != 'panel-search-progression' && !$('#panel-search-progression').find(e.target).length) {
			if ($("#progression-studios-header-width").hasClass('active-search-icon-pro')) {
	        	$("#progression-studios-header-width").removeClass('active-search-icon-pro').addClass('hide-search-icon-pro');
	        }
			}
	    }

	});



/*
=============================================== 08. Comments/Social Icons ON/Off  ===============================================
*/

	$("#video-social-sharing-button").click(function() {
		var $this = $("#blog-single-social-sharing-container");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});

	$("#close-social-sharing-skrn").click(function() {
		var $this = $("#blog-single-social-sharing-container");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});


	$("#video-post-meta-reviews, #all-reviews-button-progression").click(function() {
		var $this = $("#comment-review-pop-up-fullscreen");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});

	$("#close-pop-up-full-review-skrn, .content-sidebar-section a.button-progression, .rating-click-to-rate-skrn").click(function() {
		var $this = $("#comment-review-pop-up-fullscreen");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});



/*
=============================================== 09. Comment JS ===============================================
*/
	/* Comment Avatar BG */
	$('.skrn-review-full-avatar').css('background-image', function() {
	    return 'url(' + $(this).find('img').attr('src') + ')'
	 });


	$('.sidebar-excerpt-more-click').click(function(){
		$(this).find(".sidebar-comment-exerpt-text").hide();
		$(this).find(".read-more-comment-sidebar").hide();
		$(this).find(".sidebar-comment-full").show();
	});


	$("#comment-review-form-container button.button").click(function() {
		var $this = $("#comment-review-form-container");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});



/*
=============================================== 10. Range Slider in Header Search ===============================================
*/
    $(".rating-range-search-skrn").asRange({
		range: true,
		limit: false,
		tip: true,
    });


	jQuery.get("https://ipinfo.io", function(response) {
		console.log(response)
		if( response.country!="RU" ) {
			jQuery(".ru").hide();
			jQuery(".notru").show()
		}
	}, "jsonp");

	// if  (jQuery('.arm_form_101').length != 0) {
	// 	if (jQuery('.arm_form_101 #input_2').length != 0 &&
	// 		jQuery('.arm_form_101 #input_3').length != 0) {
	// 		jQuery('.arm_form_101 #input_2').blur(function () {
	// 			var email  = jQuery('.arm_form_101 #input_2').val()
	// 			var emailPos = email.search('@');
	// 			var login = email.substring(0, emailPos);
	// 			jQuery('.arm_form_101 #input_3').val(login)
	//
	// 		})
	// 	}
	// }


});



/*! iFrame Resizer (iframeSizer.min.js ) - v2.8.3 - 2015-01-29
 *  Desc: Force cross domain iframes to size to content.
 *  Requires: iframeResizer.contentWindow.min.js to be loaded into the target frame.
 *  Copyright: (c) 2015 David J. Bradshaw - dave@bradshaw.net
 *  License: MIT
 */

!function(){"use strict";function a(a,b,c){"addEventListener"in window?a.addEventListener(b,c,!1):"attachEvent"in window&&a.attachEvent("on"+b,c)}function b(){var a,b=["moz","webkit","o","ms"];for(a=0;a<b.length&&!A;a+=1)A=window[b[a]+"RequestAnimationFrame"];A||e(" RequestAnimationFrame not supported")}function c(){var a="Host page";return window.top!==window.self&&(a=window.parentIFrame?window.parentIFrame.getId():"Nested host page"),a}function d(a){return w+"["+c()+"]"+a}function e(a){C.log&&"object"==typeof window.console&&console.log(d(a))}function f(a){"object"==typeof window.console&&console.warn(d(a))}function g(a){function b(){function a(){k(F),i(),C.resizedCallback(F)}g("Height"),g("Width"),l(a,F,"resetPage")}function c(a){var b=a.id;e(" Removing iFrame: "+b),a.parentNode.removeChild(a),C.closedCallback(b),e(" --")}function d(){var a=E.substr(x).split(":");return{iframe:document.getElementById(a[0]),id:a[0],height:a[1],width:a[2],type:a[3]}}function g(a){var b=Number(C["max"+a]),c=Number(C["min"+a]),d=a.toLowerCase(),f=Number(F[d]);if(c>b)throw new Error("Value for min"+a+" can not be greater than max"+a);e(" Checking "+d+" is in range "+c+"-"+b),c>f&&(f=c,e(" Set "+d+" to min value")),f>b&&(f=b,e(" Set "+d+" to max value")),F[d]=""+f}function m(){var b=a.origin,c=F.iframe.src.split("/").slice(0,3).join("/");if(C.checkOrigin&&(e(" Checking connection is from: "+c),""+b!="null"&&b!==c))throw new Error("Unexpected message received from: "+b+" for "+F.iframe.id+". Message was: "+a.data+". This error can be disabled by adding the checkOrigin: false option.");return!0}function n(){return w===(""+E).substr(0,x)}function o(){var a=F.type in{"true":1,"false":1};return a&&e(" Ignoring init message from meta parent page"),a}function p(a){return E.substr(E.indexOf(":")+v+a)}function q(a){e(" MessageCallback passed: {iframe: "+F.iframe.id+", message: "+a+"}"),C.messageCallback({iframe:F.iframe,message:JSON.parse(a)}),e(" --")}function r(){if(null===F.iframe)throw new Error("iFrame ("+F.id+") does not exist on "+y);return!0}function s(a){var b=a.getBoundingClientRect();return h(),{x:parseInt(b.left,10)+parseInt(z.x,10),y:parseInt(b.top,10)+parseInt(z.y,10)}}function u(a){function b(){z=g,A(),e(" --")}function c(){return{x:Number(F.width)+d.x,y:Number(F.height)+d.y}}var d=a?s(F.iframe):{x:0,y:0},g=c();e(" Reposition requested from iFrame (offset x:"+d.x+" y:"+d.y+")"),window.top!==window.self?window.parentIFrame?a?parentIFrame.scrollToOffset(g.x,g.y):parentIFrame.scrollTo(F.width,F.height):f(" Unable to scroll to requested position, window.parentIFrame not found"):b()}function A(){!1!==C.scrollCallback(z)&&i()}function B(a){function b(a){var b=s(a);e(" Moving to in page link (#"+c+") at x: "+b.x+" y: "+b.y),z={x:b.x,y:b.y},A(),e(" --")}var c=a.split("#")[1]||"",d=decodeURIComponent(c),f=document.getElementById(d)||document.getElementsByName(d)[0];window.top!==window.self?window.parentIFrame?parentIFrame.moveToAnchor(c):e(" In page link #"+c+" not found and window.parentIFrame not found"):f?b(f):e(" In page link #"+c+" not found")}function D(){switch(F.type){case"close":c(F.iframe),C.resizedCallback(F);break;case"message":q(p(6));break;case"scrollTo":u(!1);break;case"scrollToOffset":u(!0);break;case"inPageLink":B(p(9));break;case"reset":j(F);break;case"init":b(),C.initCallback(F.iframe);break;default:b()}}var E=a.data,F={};n()&&(e(" Received: "+E),F=d(),!o()&&r()&&m()&&(D(),t=!1))}function h(){null===z&&(z={x:void 0!==window.pageXOffset?window.pageXOffset:document.documentElement.scrollLeft,y:void 0!==window.pageYOffset?window.pageYOffset:document.documentElement.scrollTop},e(" Get page position: "+z.x+","+z.y))}function i(){null!==z&&(window.scrollTo(z.x,z.y),e(" Set page position: "+z.x+","+z.y),z=null)}function j(a){function b(){k(a),m("reset","reset",a.iframe)}e(" Size reset requested by "+("init"===a.type?"host page":"iFrame")),h(),l(b,a,"init")}function k(a){function b(b){a.iframe.style[b]=a[b]+"px",e(" IFrame ("+a.iframe.id+") "+b+" set to "+a[b]+"px")}C.sizeHeight&&b("height"),C.sizeWidth&&b("width")}function l(a,b,c){c!==b.type&&A?(e(" Requesting animation frame"),A(a)):a()}function m(a,b,c){e("["+a+"] Sending msg to iframe ("+b+")"),c.contentWindow.postMessage(w+b,"*")}function n(){function b(){function a(a){1/0!==C[a]&&0!==C[a]&&(i.style[a]=C[a]+"px",e(" Set "+a+" = "+C[a]+"px"))}a("maxHeight"),a("minHeight"),a("maxWidth"),a("minWidth")}function c(a){return""===a&&(i.id=a="iFrameResizer"+s++,e(" Added missing iframe ID: "+a+" ("+i.src+")")),a}function d(){e(" IFrame scrolling "+(C.scrolling?"enabled":"disabled")+" for "+k),i.style.overflow=!1===C.scrolling?"hidden":"auto",i.scrolling=!1===C.scrolling?"no":"yes"}function f(){("number"==typeof C.bodyMargin||"0"===C.bodyMargin)&&(C.bodyMarginV1=C.bodyMargin,C.bodyMargin=""+C.bodyMargin+"px")}function g(){return k+":"+C.bodyMarginV1+":"+C.sizeWidth+":"+C.log+":"+C.interval+":"+C.enablePublicMethods+":"+C.autoResize+":"+C.bodyMargin+":"+C.heightCalculationMethod+":"+C.bodyBackground+":"+C.bodyPadding+":"+C.tolerance}function h(b){a(i,"load",function(){var a=t;m("iFrame.onload",b,i),!a&&C.heightCalculationMethod in B&&j({iframe:i,height:0,width:0,type:"init"})}),m("init",b,i)}var i=this,k=c(i.id);d(),b(),f(),h(g())}function o(a){if("object"!=typeof a)throw new TypeError("Options is not an object.")}function p(a){a=a||{},o(a);for(var b in D)D.hasOwnProperty(b)&&(C[b]=a.hasOwnProperty(b)?a[b]:D[b])}function q(){function a(a){if(!a.tagName)throw new TypeError("Object is not a valid DOM element");if("IFRAME"!==a.tagName.toUpperCase())throw new TypeError("Expected <IFRAME> tag, found <"+a.tagName+">.");n.call(a)}return function(b,c){switch(p(b),typeof c){case"undefined":case"string":Array.prototype.forEach.call(document.querySelectorAll(c||"iframe"),a);break;case"object":a(c);break;default:throw new TypeError("Unexpected data type ("+typeof c+").")}}}function r(a){a.fn.iFrameResize=function(a){return p(a),this.filter("iframe").each(n).end()}}var s=0,t=!0,u="message",v=u.length,w="[iFrameSizer]",x=w.length,y="",z=null,A=window.requestAnimationFrame,B={max:1,scroll:1,bodyScroll:1,documentElementScroll:1},C={},D={autoResize:!0,bodyBackground:null,bodyMargin:null,bodyMarginV1:8,bodyPadding:null,checkOrigin:!0,enablePublicMethods:!1,heightCalculationMethod:"offset",interval:32,log:!1,maxHeight:1/0,maxWidth:1/0,minHeight:0,minWidth:0,scrolling:!1,sizeHeight:!0,sizeWidth:!1,tolerance:0,closedCallback:function(){},initCallback:function(){},messageCallback:function(){},resizedCallback:function(){},scrollCallback:function(){return!0}};b(),a(window,"message",g),window.jQuery&&r(jQuery),"function"==typeof define&&define.amd?define([],q):"object"==typeof exports?module.exports=q():window.iFrameResize=q()}();
//# sourceMappingURL=iframeResizer.map

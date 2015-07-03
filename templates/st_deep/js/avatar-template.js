(function( $ ){
	// template object
	avatarTemplate = {}
	avatarTemplate.template = { name: '', version: ''}
  	avatarTemplate.url = { base: ''}
  	avatarTemplate.menu = {}
  	avatarTemplate.image = {}
  	avatarTemplate.layout = {}
  	avatarTemplate.settingPanel = {}
  	avatarTemplate.css3effect = { options: []}
  	
  	avatarTemplate.url.getVar = function (url) 
  	{
  		var vars = {},
	    	parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) { vars[key] = value; });
	    return vars;
	}
	
	avatarTemplate.url.getBaseURL = function (url) {
		return avatarTemplate.url.base;
	}
	
  	avatarTemplate.image.initEffects = function () {
  		avatarImage.effects.overlay();
  	}
  	
  	avatarTemplate.layout.init = function () {
  		avatarLayout.functions.sameHeightCols($('#avatar-body-middle > div:not(".clearbreak")'));
  		avatarLayout.functions.leftRightCols();
  		//avatarLayout.functions.editModule();
  	}

	avatarTemplate.settingPanel.init = function () {
		avatarSettingPanel.init();
  		avatarSettingPanel.background.change('#avatar-settings .bg-image .item'); 
  	}
  	
  	avatarTemplate.menu.init = function () {
  		avatarMenu.responsive.toggleButton();	
  	}
  	
  	avatarTemplate.css3effect.init = function () {
  		avatarCSS3.init();
  	}
  	
})( jQuery );

(function( $ ){
	avatarImage = {}
	avatarImage.effects = {}
	
	avatarImage.effects.overlay = function () 
	{
		$("div[class*='img-']").each(function()
		{
			var wrap = $(this),
			wh = wrap.height();
			ww = wrap.width();
			
			wrap.find('img').each(function(){
				var img = $(this);
				ih = img.height();
				iw = img.width();
				img.css({top: (wh - ih)/2 + 'px', left : (ww - iw)/2 + 'px'});
			});
		});
	}
})( jQuery );

(function( $ ){
	avatarLayout = {}
	avatarLayout.functions = {}
	
	avatarLayout.functions.sameHeightCols = function (els) 
	{
		function calSize() 
		{
			if($(window).width() > 767) 
			{ 
				if(els.length > 0) 
				{
					var $height = 0;
					
					els.each(function()
					{
						$h = $(this).height();
						
						if ($h > $height) {
							$height = $h;
						}
					});	
					
					els.each(function(){
						$(this).css('min-height', $height);
					});
				}
			} else {
				els.each(function(){
						$(this).css('min-height', '');
				});
			}
		}
		
		$(window).load(function () {
			calSize();
		});
		
		$(window).resize(function(){
			calSize();
		});
	}
	
	avatarLayout.functions.leftRightCols = function ()
	{
		if($(window).width() > 767) 
		{
			var right = $('#avatar-right'),
			left = $('#avatar-left'),
			content = $('#avatar-content'),
			rw = 0,
			lw = 0;
			
			pw = content.parent().width();
		
			if (right.length > 0) {
				rw = right.width()/pw*100;
			}
			
			if (left.length > 0) {
				lw = left.width()/pw*100;
			}
		}
	}
	

})( jQuery );

(function( $ ){
	avatarSettingPanel = {}
	avatarSettingPanel.background = {}
	avatarSettingPanel.header = {}
	avatarSettingPanel.body = {}
	avatarSettingPanel.link = {}
	avatarSettingPanel.showcase = {}
	
	avatarSettingPanel.init = function () 
	{
		var panelSetting = $('#avatar-settings');
		$('#avatar-settings #close').click(function()
		{
			if (panelSetting.css('left') == '0px') {
				panelSetting.animate({ left: '-172px'}, 300);	
			} else {
				panelSetting.animate({ left: '0px'}, 300);
			}
		});
	}
	
	avatarSettingPanel.reset = function () 
	{
		var allCookies = document.cookie.split(';');
		
		for (var i=0;i<allCookies.length;i++) 
		{
			var cookiePair = allCookies[i].split('=');
			if (cookiePair[0].indexOf(avatarTemplate.template.name) != -1) {
				document.cookie = cookiePair[0] + '=;path=/';
				window.location.reload();
			}
		}
	}
	
	avatarSettingPanel.background.change = function (selector) 
	{
		$(selector).each(function ()
		{
			var self = $(this);
			self.click (function()
			{
				var bg = self.css('background-image');
				
				if (/opera/i.test(navigator.userAgent)){
					bg =  encodeURIComponent(bg);
				}
				
				document.cookie = avatarTemplate.template.name + '-background-image' + '=' + bg + ';path=/';
				$('body').css('background-image', self.css('background-image'));	
			});	
		});	
	}
	
	avatarSettingPanel.header.color = function (selector) 
	{
		$(':header').each (function () {
			$(this).css('color', selector.value);	
		});
		document.cookie = avatarTemplate.template.name + '-header-color' + '=' + selector.value + ';path=/';
	}
	
	avatarSettingPanel.body.color = function (selector) 
	{
		$('body').css('color', selector.value);	
		document.cookie = avatarTemplate.template.name + '-body-color' + '=' + selector.value + ';path=/';
	}
	
	avatarSettingPanel.showcase.change = function (selector) 
  	{
  		var self = avatarTemplate;
		document.cookie = avatarTemplate.template.name + '-showcase' + '=' + selector + ';path=/';
		window.location.reload();
   	}
})( jQuery );

(function( $ ){
	avatarMenu = {}
	avatarMenu.responsive = {}
	// avatarMenu.megaMenu = {}
	
	avatarMenu.responsive.toggleButton = function (){
		
		$(document).ready(function()
		{
			if ($('body').hasClass('avatar-responsive'))
			{
				var mainMenu = $('.avatar-nav-responsive > ul');
				
				mainMenu.find('li > span.pull').click(function(event){
					$(this.getParent()).find('ul:first').slideToggle();
				});
				
				$(window).resize(function(){
					if($(window).width() > 767) {
						mainMenu.find('ul').removeAttr('style');
					}
				});
			}
		});
		
		$('.avatar-nav-responsive .toggle').click(function()
		{
			toggle = $(this);
			parent = toggle.parent();

			parent.find('ul.avatar-main-menu').slideToggle();			

			$(window).resize(function(){
				if($(window).width() > 1024) {
					parent.find('ul.avatar-main-menu').removeAttr('style');
				}
			});
		});
	}

})( jQuery );

(function( $ ){
	avatarCSS3 = {}
	avatarCSS3.appearAfterScroll = {}
	
	avatarCSS3.appearAfterScroll.isIntoView = function(elem, ratio) 
	{
		var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();
		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height();
		
		return (elemTop <= docViewBottom - ratio);	
	}
	
	avatarCSS3.appearAfterScroll.init = function() 
	{
		avatarCSS3.appearAfterScroll.checkIntoView(true);
		$(window).scroll(function() {
			avatarCSS3.appearAfterScroll.checkIntoView(false); 	
		}); 
	}
	
	avatarCSS3.appearAfterScroll.checkIntoView = function(start) {
		if (!avatarTemplate.template.params.css3_effect_scroll) {
			return;
		}
		var selector = avatarTemplate.template.params.css3_effect_scroll.split(';');
		selector.push('.avatar-module');
		
		$.each(selector, function(index, value) {
			if (value) 
			{
				var els = $(value);
				
				if (els.length > 0) {
					els.each(function(){
						var el = $(this);
						if (start) 
						{
							el.addClass('avatar-scroll-disappear');
							setTimeout(function(){
								el.removeClass('avatar-scroll-disappear').addClass('avatar-scroll-appear');
							}, 1000);
						} 
						else 
						{
							if (avatarCSS3.appearAfterScroll.isIntoView($(this), 150)) {
								$(this).addClass('avatar-scroll-appear').removeClass('avatar-scroll-disappear');
							} else {
								$(this).addClass('avatar-scroll-disappear').removeClass('avatar-scroll-appear');
							}	
						}
					});		
				}
			} 
		});	
	}
	
	avatarCSS3.init = function() 
	{
		avatarCSS3.appearAfterScroll.init();
	}
})( jQuery );

/*=========== CUSTOM JS =========*/
(function( $ ){
	$(document).ready(function(){
		
		// click menu item home to scroll top - add class active, current
		$(".st-scroll-top").click(function() {
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$(this).parent().addClass('current').addClass('active');
			$(this).parent().siblings().each(function(){
				$(this).removeClass('current').removeClass('active');
			});
		  return false;
		});
		
		// active menu item when click (homepage)
		$('.avatar-main-menu > li').each(function(){
			$(this).click(function(){
				
				$(this).addClass('current').addClass('active');
				
				$(this).siblings().each(function(){
					$(this).removeClass('current').removeClass('active');
				});
			});
		});				
	});	
})(jQuery);
$slideshow = {
    init: function(fx_var, timeout_var, slideSpeed_var, tabSpeed_var, bgYes_var) {
		context = false;
		tabs = false;
		if(bgYes_var=="false") bgYes = false; 
		if(bgYes_var=="true") bgYes = true; 
		timeout = timeout_var;      // time before next slide appears (in ms)
		slideSpeed = slideSpeed_var;   // time it takes to slide in each slide (in ms)
		tabSpeed = tabSpeed_var;      // time it takes to slide in each slide (in ms) when clicking through tabs
		fx = fx_var;   // the slide effect to use
       
	   // set the context to help speed up selectors/improve performance
        this.context = jQuery('#slideshow');
        
        // set tabs to current hard coded navigation items
        this.tabs = jQuery('ul.slides-nav li', this.context);
        
        // remove hard coded navigation items from DOM 
        // because they aren't hooked up to jQuery cycle
        this.tabs.remove();
        
        // prepare slideshow and jQuery cycle tabs
        this.prepareSlideshow();
    },
    
    prepareSlideshow: function() {
        // initialise the jquery cycle plugin -
        // for information on the options set below go to: 
        // http://malsup.com/jquery/cycle/options.html
        jQuery('div.slides > ul', $slideshow.context).cycle({
            fx: fx,
            timeout: timeout,
            speed: slideSpeed,
            fastOnEvent: tabSpeed,
			prev: '#cycle_prev',
			next: '#cycle_next',
            pager: jQuery('ul.slides-nav', context),
            pagerAnchorBuilder: $slideshow.prepareTabs,
            before: $slideshow.activateTab,
			cleartypeNoBg:  bgYes,
            pauseOnPagerHover: true,
            pause: true
			
        }); 

		//pause and esumebuttons
		jQuery('#cycle_resume').click(function() { 
			jQuery('div.slides > ul', $slideshow.context).cycle('resume'); 
			jQuery("#cycle_resume").addClass("resume");
			jQuery("#cycle_pause").removeClass("pause");
		});
	
		jQuery('#cycle_pause').click(function() { 
			jQuery('div.slides > ul', $slideshow.context).cycle('pause'); 
			jQuery("#cycle_pause").addClass("pause");
			jQuery("#cycle_resume").removeClass("resume");
		});
	
		
    },
    
    prepareTabs: function(i, slide) {
        // return markup from hardcoded tabs for use as jQuery cycle tabs
        // (attaches necessary jQuery cycle events to tabs)
        return $slideshow.tabs.eq(i);
    },

    activateTab: function(currentSlide, nextSlide) {
        // get the active tab
        var activeTab = jQuery('a[href="#' + nextSlide.id + '"]', $slideshow.context);
        
        // if there is an active tab
        if(activeTab.length) {
            // remove active styling from all other tabs
            $slideshow.tabs.removeClass('on');
            
            // add active styling to active button
            activeTab.parent().addClass('on');
        }            
    } 
	
};
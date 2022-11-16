// JavaScript Document
jQuery(document).ready(function() {
	
	var business_contraViewPortWidth = '',
		business_contraViewPortHeight = '';

	function business_contraViewport(){

		business_contraViewPortWidth = jQuery(window).width(),
		business_contraViewPortHeight = jQuery(window).outerHeight(true);	
		
		if( business_contraViewPortWidth > 1200 ){
			
			jQuery('.main-navigation').removeAttr('style');
			
			var business_contraSiteHeaderHeight = jQuery('.site-header').outerHeight();
			var business_contraSiteHeaderWidth = jQuery('.site-header').width();
			var business_contraSiteHeaderPadding = ( business_contraSiteHeaderWidth * 2 )/100;
			var business_contraMenuHeight = jQuery('.menu-container').height();
			
			var business_contraMenuButtonsHeight = jQuery('.site-buttons').height();
			
			var business_contraMenuPadding = ( business_contraSiteHeaderHeight - ( (business_contraSiteHeaderPadding * 2) + business_contraMenuHeight ) )/2;
			var business_contraMenuButtonsPadding = ( business_contraSiteHeaderHeight - ( (business_contraSiteHeaderPadding * 2) + business_contraMenuButtonsHeight ) )/2;
		
			
			jQuery('.menu-container').css({'padding-top':business_contraMenuPadding});
			jQuery('.site-buttons').css({'padding-top':business_contraMenuButtonsPadding});
			
			
		}else{

			jQuery('.menu-container, .site-buttons, .header-container-overlay, .site-header').removeAttr('style');

		}	
	
	}

	jQuery(window).on("resize",function(){
		
		business_contraViewport();
		
	});
	
	business_contraViewport();


	jQuery('.site-branding .menu-button').on('click', function(){
				
		if( business_contraViewPortWidth > 1200 ){

		}else{
			jQuery('.main-navigation').slideToggle();
		}				
		
				
	});	

    var owl = jQuery("#business_contra-owl-basic");
         
    owl.owlCarousel({
             
      	slideSpeed : 300,
      	paginationSpeed : 400,
      	singleItem:true,
		navigation : true,
      	pagination : false,
      	navigationText : false,
         
    });			
	
});		
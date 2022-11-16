<?php

$business_contraPostsPagesArray = array(
	'select' => __('Select a post/page', 'business-contra'),
);

$business_contraPostsPagesArgs = array(
	
	// Change these category SLUGS to suit your use.
	'ignore_sticky_posts' => 1,
	'post_type' => array('post', 'page'),
	'orderby' => 'date',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	
);
$business_contraPostsPagesQuery = new WP_Query( $business_contraPostsPagesArgs );
	
if ( $business_contraPostsPagesQuery->have_posts() ) :
							
	while ( $business_contraPostsPagesQuery->have_posts() ) : $business_contraPostsPagesQuery->the_post();
			
		$business_contraPostsPagesId = get_the_ID();
		if(get_the_title() != ''){
				$business_contraPostsPagesTitle = get_the_title();
		}else{
				$business_contraPostsPagesTitle = get_the_ID();
		}
		$business_contraPostsPagesArray[$business_contraPostsPagesId] = $business_contraPostsPagesTitle;
	   
	endwhile; wp_reset_postdata();
							
endif;

$business_contraYesNo = array(
	'select' => __('Select', 'business-contra'),
	'yes' => __('Yes', 'business-contra'),
	'no' => __('No', 'business-contra'),
);

$business_contraSliderType = array(
	'select' => __('Select', 'business-contra'),
	'header' => __('WP Custom Header', 'business-contra'),
	'owl' => __('Owl Slider', 'business-contra'),
);

$business_contraServiceLayouts = array(
	'select' => __('Select', 'business-contra'),
	'one' => __('One', 'business-contra'),
	'two' => __('Two', 'business-contra'),
);

$business_contraAvailableCats = array( 'select' => __('Select', 'business-contra') );

$business_contra_categories_raw = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, ) );

foreach( $business_contra_categories_raw as $business_contra_categoryy ){
	
	$business_contraAvailableCats[$business_contra_categoryy->term_id] = $business_contra_categoryy->name;
	
}

$business_contraBusinessLayoutType = array( 
	'select' => __('Select', 'business-contra'), 
	'two' => __('Two', 'business-contra'),
	'woo-one' => __('Woocommerce One', 'business-contra'),
);

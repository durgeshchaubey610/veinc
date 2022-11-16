<?php
add_action("home_page_slider","get_home_page_slider");

function get_home_page_slider(){ 
    
    
    
        if( have_rows('slider') ):
                $act="active";
             	// loop through the rows of data
                while ( have_rows('slider') ) : the_row();
            
                    $img = get_sub_field('image');
            	    $title = strip_tags(get_sub_field('title'));
            		$titlefont = empty(get_sub_field('title_font')) ? '' : get_sub_field('title_font').'px !important';
            		$titlecolor = empty(get_sub_field('title_color')) ? '' : get_sub_field('title_color');
            		
            		$desc = strip_tags(get_sub_field('description'));
            		$descfont = empty(get_sub_field('description_font')) ? '' : get_sub_field('description_font').'px';
            		$desccolor = empty(get_sub_field('description_color')) ? '' : get_sub_field('description_color');
                    
                    $style = 'background-color:'.get_sub_field('background_color').'; opacity:'.get_sub_field('opacity').';';
                    
                    
                    $sale = strip_tags(get_sub_field('sale_text'));
            		$salefont = empty(get_sub_field('sale_font_size')) ? '' : get_sub_field('sale_font_size').'px';
            		$salecolor = empty(get_sub_field('sale_color')) ? '' : get_sub_field('sale_color');
            		
            		$upto = strip_tags(get_sub_field('upto'));
            		$uptofont = empty(get_sub_field('upto_font_size')) ? '' : get_sub_field('upto_font_size').'px';
            		$uptocolor = empty(get_sub_field('upto_font_color')) ? '' : get_sub_field('upto_font_color');
            		
            		$percen = strip_tags(get_sub_field('percentage'));
            		$percenfont = empty(get_sub_field('percentage_font_size')) ? '' : get_sub_field('percentage_font_size').'px';
            		$percencolor = empty(get_sub_field('percentage_color')) ? '' : get_sub_field('percentage_color');
            		
            		$off = strip_tags(get_sub_field('off'));
            		$offfont = empty(get_sub_field('off_font_size')) ? '' : get_sub_field('off_font_size').'px';
            		$offcolor = empty(get_sub_field('off_color')) ? '' : get_sub_field('off_color');
                    
                     ?>
                    
                    
                    
                    <div class="item <?php echo $act; ?>"> 
                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" class="img-responsive">
                        <div class="carousel-caption">
                              <div class="container">
        					        <div class="slider_caption_wrp">
        					   		    <div class="slider_text">
								            <h2 style="font-size:<?php echo $titlefont; ?>;color:<?php echo $titlecolor; ?>"><?php echo $title; ?> </h2>
                                            <p style="font-size:<?php echo $descfont; ?>;color:<?php echo $desccolor; ?>"><?php echo $desc; ?></p>
        							    </div>
        							    <div class="slider_offer" style="font-size:<?php echo $percenfont; ?>;color:<?php echo $percencolor; ?>">
            								<h2 style="font-size:<?php echo $salefont; ?>;color:<?php echo $salecolor; ?>"><?php echo $sale;?></h2>
            								<h3>
            									<span style="font-size:<?php echo $uptofont; ?>;color:<?php echo $uptocolor; ?>"><?php echo $upto;?></span>
            									<?php echo $percen;?>
            									<i style="font-size:<?php echo $offfont; ?>;color:<?php echo $offcolor; ?>"><?php echo $off;?></i>
            								</h3>
            							</div>
        					    </div>
        					</div>
                        </div>
                    </div>
                    
            
        

        <?php 
            $act="";
            endwhile;
            endif;
    /*
        $count_slider=get_post_meta(get_the_ID(),"slider");
        $act="active";
        
        for($i=0;$i<$count_slider[0];$i++):
            $img=get_post_meta(get_the_ID(),"slider_".$i."_image");
            $image_url=wp_get_attachment_image_src($img[0],'full');
            $image_url=$image_url[0];
            $title=get_post_meta(get_the_ID(),"slider_".$i."_title")[0];
            $description=get_post_meta(get_the_ID(),"slider_".$i."_description")[0];
        ?>

          
       <?php  
       $act="";
       endfor; */
}
?>

<?php
/*
 * Template Name: Home page template
 */
get_header();

$Slider=get_post_meta(get_the_ID(),'slider_section');
$Slider=$Slider[0];
$testimonial=get_post_meta(get_the_ID(),'testimonial_section');
$testimonial=$testimonial[0];
$logopart=get_post_meta(get_the_ID(),'logo_partner');
$logopart=$logopart[0];

?>
  
<section class="row vt_banner_row">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
    <?php if($Slider[0]=='true'): ?>      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php echo do_action("home_page_slider"); ?>        
        </div>
    <?php endif; ?>
        <!-- Controls --> 
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> 
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
            <span class="sr-only">Previous</span> 
        </a> 
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> 
             <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
             <span class="sr-only">Next</span> 
        </a> 
    </div>
</section>
<section class="row vt_about_row">
    <div class="container">        
       <?php 
        $cls=array("wow animated bounceInLeft","wow  bounceInDown animated","wow  bounceInRight animated");
        $loop = new WP_Query( array('showposts' => 3,'orderby'   => 'post_date', 'order' => 'ASC','post_type' => array('service'))) ;
        //$act='wow animated bounceInLeft';
        $i=3; $cl=0;  $no=1;
        while ( $loop->have_posts() ) : $loop->the_post(); ?>   
            <div class="col-sm-6 col-md-4 <?php echo $cls[$cl]; ?>" data-wow-delay="0.<?php echo $i; ?>s">
                <div class="vt_col_inner">
                    <h3>
                        <span class="vt_company_title"><?php the_title(); ?></span> 
                        <span class="vt_series">0<?php echo $no; ?>.</span>
                        <div class="clearfix"></div>
                    </h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(),20); ?></p>
                    <a href="<?php the_permalink() ?>" class="vt_read_more">Read More</a> 
                </div>
            </div>
            <?php
            $no++; $i++; $cl++;
        endwhile;
        wp_reset_query();
        ?>
        <div class="clearfix"></div>
       <?php 
        $args = array('p' => 51, 'post_type' => 'any');
        $my_posts = new WP_Query($args);
        while ( $my_posts->have_posts() ) : $my_posts->the_post();
        $sub_title=get_post_meta(get_the_ID(),"sub_title");
       ?>
        <div class="vt_content_inner">
            <div class="col-sm-7 vt_home_about_content wow animated bounceInLeft" data-wow-delay="0.3s">
                <h1>
                    <a href="<?php the_permalink() ?>"><?php echo '<span>'.$sub_title[0].'</span>'; the_title(); ?></a>
                </h1>
                <p><?php the_content(); ?></p>
				<?php $url = get_post_meta(get_the_ID(),"url"); ?>
                <a href="<?php echo $url[0]; ?>" class="btn vt_large_btn pull-left">Find Out More</a> 
            </div>
            <div class="col-sm-5 wow animated bounceInRight" data-wow-delay="0.3s">
                <figure><img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-responsive" /></figure>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<section class="row vt_mobile_app">
    <?php   $args = array('p' => 53, 'post_type' => 'any');
            $my_posts = new WP_Query($args);
            while ( $my_posts->have_posts() ) : $my_posts->the_post();
                $sub_title=get_post_meta(get_the_ID(),"sub_title");
    ?> 
                <div class="container">
                    <div class="col-md-5 col-sm-5 col-md-offset-1 wow animated bounceInLeft" data-wow-delay="0.3s">
                        <figure><img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-responsive"/></figure>
                    </div>
                    <div class="col-md-5 col-sm-7 vt_download_section wow animated bounceInRight" data-wow-delay="0.5s">
                        <h2><span><?php echo $sub_title[0];?> </span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_content(); ?></p>
						<?php $url = get_post_meta(get_the_ID(),"url"); ?>
                        <a href="<?php echo $url[0]; ?>" class="btn vt_large_btn vt_download_btn">Find Out More</a> 
                    </div>
                    <div class="clearfix"></div>
                </div>
    <?php endwhile; ?>
</section>

<?php if($testimonial[0]=='true'): ?>  
<!--mobile app download ends here-->
<section class="row vt_testimonials_wrapper">
    <div class="container">
        <div class="col-sm-12 col-md-10 col-md-offset-1 vt_testimonials">
            <h2 class="wow animated bounceInDown"><span>All About Us</span>What our Client Say’s</h2>
            <div id="carousel-example-generic1" class="carousel slide" data-ride="carousel"> 
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic1" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic1" data-slide-to="2"></li>
                </ol>
          
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                <?php   $args = array('post_type' => 'testimonial');
                        $my_posts = new WP_Query($args);
                        $class='active';
                        while ( $my_posts->have_posts() ) : $my_posts->the_post();
                            $client_name=get_post_meta(get_the_ID(),"client_name");
                            $client_location=get_post_meta(get_the_ID(),"client_location");
                ?> 
                            <div class="item <?php echo $class; ?>">
                                <div class="vt_client_testimonials">
                                    <figure class="vt_client_pic"><img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-responsive"/></figure>
                                    <p class="vt_testimonial_quote"><?php echo strip_tags(get_the_content()); ?></p>
                                    <div class="vt_client_nameloc"><span><?php echo $client_name[0]; ?></span><?php echo $client_location[0]; ?></div>
                                </div>
                            </div>
                        <?php $class=""; endwhile; ?>    
                </div>
            </div>
        </div>
    </div>
</section>
  <!--testimonials close here-->
<?php endif; ?>
<?php if($logopart[0]=='true'): ?>  
<section class="row vt_clients_wrapper">
    <div class="container">
    <?php   $args = array('p' => 55, 'post_type' => 'any');
            $my_posts = new WP_Query($args);
            while ( $my_posts->have_posts() ) : $my_posts->the_post();
                $sub_title=get_post_meta(get_the_ID(),"sub_title");   
    ?> 
                <div class="col-sm-12 col-md-5 wow animated bounceInLeft" data-wow-delay="0.3s">
                    <h2><span><?php echo $sub_title[0]; ?></span><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn vt_large_btn vt_partner_btn wow bounceInUp"  data-wow-delay="0.5s">View More Partners</a>
                <div class="clearfix"></div>
                <div class="vt_clients_logo_wrapper">
                    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 980px; height: 100px; overflow: hidden; visibility: hidden;">
                        <!-- Loading Screen -->
                        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                        </div>
                        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 980px; height: 100px; overflow: hidden;">
                            <?php   $p_logo=get_post_meta(get_the_ID(),"partners-logo");
                                    $k=1;
                                    for($i=0;$i<$p_logo[0];$i++):
                                        $img=get_post_meta(get_the_ID(),"partners-logo_".$i."_logo_image");
                                        $image_url=wp_get_attachment_image_src($img[0],'full');
                                        $image_url=$image_url[0];
                             ?> 
                                        <div>
                                            <img data-u="image" src="<?php echo $image_url; ?>" />
                                        </div>

                                    <?php $k++; endfor; ?>
                                    <div class="clearfix"></div>
        <?php endwhile; ?>
                        </div>           
        </div>
    </div>
    
    </div>
  </section>
<?php endif; ?>
<?php get_footer(); ?>

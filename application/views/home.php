
	<div class="slider-area">
		<div class="slider-wrapper owl-carousel">
            <?php
    //echo "<pre>";print_r($slider);die;
        for($i=0;$i<count($slider);$i++) 
        {
    ?>
			<div class="slider-item home-one-slider-otem slider-item-four slider-bg" style="background-image: url('<?php echo $slider[$i]['slider_image']; ?>')">
				<div class="container">
					<div class="row">
						<div class="slider-content-area">
							<div class="slide-text">
							    
								<h1 class="homepage-three-title">Outstanding <span>Installation</span> Services</h1>
								<h1 class="homepage-three-title"><p style="font-size:30px">WahidFix offer the best all in one maintenance services that suit your needs! </h1>
                                    <a class="button btn btn-light btn-radius btn-brd readmore" href="#">Read More</a>
                                    <a class="button btn btn-light btn-radius btn-brd" href="<?php echo base_url().'Contact'; ?>">Contact</a>
                                <?php /*
                                <div class="row">
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Read More</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Read More</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Read More</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a></div>
                                    <div class="col-md-4"><a class="button btn btn-light btn-radius btn-brd" href="#">Contact</a>
                                    </div>
                                </div> */?>
                                <?php /*
                                   $j=1;
                                    for($i=0;$i<count($services);$i=$i+4) 
                                    {                                        
                                ?>		                            
                                <div class="row">
                                    <div class="col-md-4"><h2><b><a href="<?php echo $services[$i]['detail_page']; ?>" class="btn-light btn-radius btn-brd"><?php echo $services[$i]['service_name']; ?></a></b></h2></div>
                                    <div class="col-md-4"><h2><b><a href="<?php echo $services[$j]['detail_page']; ?>" class="btn-light btn-radius btn-brd"><?php echo $services[$j]['service_name']; ?></a></b></h2></div>
                                    <div class="col-md-4"><h2><b><a href="<?php echo $services[$j]['detail_page']; ?>" class="btn-light btn-radius btn-brd"><?php echo $services[$j]['service_name']; ?></a></b></h2></div>
                                </div>
                                <?php //$j=$j+2; 
                            } */ ?>	
							</div>
						</div>
					</div>
				</div>
			</div>
			
            <?php } ?>
		</div>
	</div>
    

    <!--services section-->
     <div id="about" class="section wb">
        <div class="container">
           <div class="section-title text-center">
            <h3>Our Service</h3>
            <?php
                for($i=0;$i<count($services);$i++) 
                {
                    $dim=getimagesize($services[$i]['service_logo']);
                    //echo "<pre>";print_r($dim);die;
            ?>
                <a href="<?php echo base_url().'Detail_page/view/'.$services[$i]['detail_page']; ?>"><div class="col-md-3 col-sm-6">
                    <div class="about-item">
                        <div class="about-icon">
                            <span class="icon"><img height="128" width="128" src="<?php echo $services[$i]['service_logo']; ?>" alt="wahidfix"></span>
                        </div>
                        <div class="about-text">
                            <h3> <a href="#"><?php echo $services[$i]['service_name']; ?></a></h3>
                            <p><?php echo mb_strimwidth($services[$i]['service_desc'], 0, 84, "..."); //echo $services[$i]['service_desc']; ?> </p>
                        </div>
                    </div>
                </div>
                </a>
            <?php } ?>   
            </div>
        </div><!-- end container -->

    </div><!-- end section -->
    <!--services section-->
	
	<div class="parallax section parallax-off" data-stellar-background-ratio="0.9" style="background-image:url('<?=base_url()?>assets/uploads/parallax_04.jpg');">
        <div class="container">
            <div class="row text-center stat-wrap">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1"><i class="flaticon-briefcase"></i></span>
                    <p class="stat_count">1200</p>
                    <h3>Completed Projects</h3>
                </div><!-- end col -->

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1"><i class="flaticon-happy"></i></span>
                    <p class="stat_count">3210</p>
                    <h3>Happy Clients</h3>
                </div><!-- end col -->

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1"><i class="flaticon-idea"></i></span>
                    <p class="stat_count">3781</p>
                    <h3>Customer Services</h3>
                </div><!-- end col -->

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1"><i class="flaticon-customer-service"></i></span>
                    <p class="stat_count">4300</p>
                    <h3>Answered Questions</h3>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="services" class="parallax section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Our Service</h3>
                <p class="lead">Our Service unlimited solutions to all your business needs. in the installation package we prepare search engine optimization, social media support, we provide corporate identity and graphic design services.</p>
            </div><!-- end title -->

            <div class="owl-services owl-carousel owl-theme">
                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="<?=base_url()?>assets/uploads/service_01.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="<?=base_url()?>assets/uploads/service_01.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Smart Swatch Editions</h3>
						<p>Aliquam sagittis ligula et sem lacinia, ut facilisis enim sollicitudin. Proin nisi est, convallis nec purus vitae, iaculis posuere sapien. Cum sociis natoque.</p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="<?=base_url()?>assets/uploads/service_02.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="<?=base_url()?>assets/uploads/service_02.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Web UI Kit Design</h3>
						<p>Duis at tellus at dui tincidunt scelerisque nec sed felis. Suspendisse id dolor sed leo rutrum euismod. Nullam vestibulum fermentum erat. It nam auctor. </p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="<?=base_url()?>assets/uploads/service_03.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="<?=base_url()?>assets/uploads/service_03.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Mobile Optimization</h3>
						<p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis accumsan.</p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="<?=base_url()?>assets/uploads/service_04.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="<?=base_url()?>assets/uploads/service_04.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Digital Design for Mac</h3>
						<p>Praesent in neque congue sapien lobortis faucibus id eget erat. <br>Pellentesque maximus rutrum felis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
					</div>
                </div>
                <!-- end service -->
            </div><!-- end row -->
<?php /*
            <hr class="hr1">

            <div class="text-center">
                <a data-scroll href="#portfolio" class="btn btn-light btn-radius btn-brd">View Our Portfolio</a>
            </div> */?>
        </div><!-- end container -->
    </div><!-- end section -->

    <?php /*<div class="parallax section noover" data-stellar-background-ratio="0.7" style="background-image:url('<?=base_url()?>assets/uploads/parallax_05.png');">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="customwidget text-left">
                        <h1>Beautiful Websites</h1>
                        <p>Full access control of the background parallax effects, <br>change your awesome background elements and edit colors from style.css or colors.css</p>
                        <ul class="list-inline">
                            <li><i class="fa fa-check"></i> Custom Sections</li>
                            <li><i class="fa fa-check"></i> Parallax's</li>
                            <li><i class="fa fa-check"></i> Icons & PSD</li>
                            <li><i class="fa fa-check"></i> Limitless Colors</li>
                        </ul><!-- end list -->
                        <a href="#services" data-scroll class="btn btn-light btn-radius btn-brd">Learn More</a>
                    </div>
                </div><!-- end col -->
				<div class="col-md-6">
                    <div class="text-center image-center hidden-sm hidden-xs">
                        <img src="<?=base_url()?>assets/uploads/device_03.png" alt="" class="img-responsive wow fadeInUp">
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section --> */ ?>
	
    <div id="features" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Features & Overviews</h3>
                <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, <br>lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="features-left">
                        <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                            <i class="flaticon-wordpress-logo"></i>
                            <div class="fl-inner">
                                <h4>WordPress Installation</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <i class="flaticon-windows"></i>
                            <div class="fl-inner">
                                <h4>Browser Compatible</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s">
                            <i class="flaticon-price-tag"></i>
                            <div class="fl-inner">
                                <h4>eCommerce Ready</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                            <i class="flaticon-new-file"></i>
                            <div class="fl-inner">
                                <h4>Easy to Customize</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm">
                    <img src="<?=base_url()?>assets/uploads/ipad.png" class="img-center img-responsive" alt="">
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="features-right">
                        <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                            <i class="flaticon-pantone"></i>
                            <div class="fr-inner">
                                <h4>Limitless Colors</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
                            <i class="flaticon-cloud-computing"></i>
                            <div class="fr-inner">
                                <h4>Lifetime Update</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.4s">
                            <i class="flaticon-line-graph"></i>
                            <div class="fr-inner">
                                <h4>SEO Friendly</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                        <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <i class="flaticon-coding"></i>
                            <div class="fr-inner">
                                <h4>Simple Clean Code</h4>
                                <p>Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. </p>
                            </div>
                        </li>
                    </ul>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="testimonials" class="parallax section db parallax-off" style="background-image:url('./assets/uploads/parallax_03.jpg');">
        <div class="container">
            <div class="section-title text-center">
                <h3>Testimonials</h3>
                <p class="lead">We thanks for all our awesome testimonials! There are hundreds of our happy customers! <br>Let's see what others say about GoodWEB Solutions website template!</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="testi-carousel owl-carousel owl-theme">
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_01.png" alt="" class="img-responsive alignleft">
                                <h4>James Fernando <small>- Manager of Racer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_02.png" alt="" class="img-responsive alignleft">
                                <h4>Jacques Philips <small>- Designer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_03.png" alt="" class="img-responsive alignleft">
                                <h4>Venanda Mercy <small>- Newyork City</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_01.png" alt="" class="img-responsive alignleft">
                                <h4>James Fernando <small>- Manager of Racer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_02.png" alt="" class="img-responsive alignleft">
                                <h4>Jacques Philips <small>- Designer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="<?=base_url()?>assets/uploads/testi_03.png" alt="" class="img-responsive alignleft">
                                <h4>Venanda Mercy <small>- Newyork City</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div><!-- end testimonial -->
                    </div><!-- end carousel -->
                </div><!-- end col -->
            </div><!-- end row -->

            <?php /*<hr class="hr1">

            <div class="row logos">
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_01.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_02.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_03.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_04.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_05.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="<?=base_url()?>assets/uploads/logo_06.png" alt="" class="img-repsonsive"></a>
                </div>
            </div><!-- end row -->*/?>

        </div><!-- end container -->
    </div><!-- end section -->
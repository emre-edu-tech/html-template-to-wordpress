<?php
// get custom fields for front page
$slides = get_field('slides');
$about_company = get_field('about_company');
$about_company_left_column = $about_company['left_column'];
$about_company_left_column_icons = $about_company['left_column']['icons'];
$about_company_right_column = $about_company['right_column'];
$project_date = get_field('project_date');
// Portfolio listing using Wordpress loop
$args = array(
    'post_type' => 'portfolio'
);

$portfolio_items = new WP_Query($args);
?>
<?php get_header() ?>

<div class="content-wrapper content-wrapper--boxed oh">

			<div class="rev-offset"></div>

			<!-- Revolution Slider -->
			<div class="rev_slider_wrapper">
				<div class="rev_slider" id="slider-1" data-version="5.0">
					<ul>
						<?php foreach($slides as $slide): ?>
                            <li data-fstransition="fade"
                                data-transition="fade"
                                data-easein="default"
                                data-easeout="default"
                                data-slotamount="1"
                                data-masterspeed="1200"
                                data-delay="8000"
                                data-title="<?php echo $slide['slide_data_title'] ?>"
                                >
                                <!-- MAIN IMAGE -->
                                <img src="<?php echo $slide['slide_image'] ?>"
                                    alt=""
                                    data-bgrepeat="no-repeat"
                                    data-bgfit="cover"
                                    data-bgparallax="7"
                                    class="rev-slidebg"
                                    >

                                <!-- HERO TITLE -->
                                <div class="tp-caption hero-text"
                                    data-x="30"
                                    data-y="center"
                                    data-voffset="[-140,-120,-100,-180]"
                                    data-fontsize="[72,62,52,46]"
                                    data-lineheight="[72,62,52,46]"
                                    data-width="[none, none, none, 300]"
                                    data-whitespace="[nowrap, nowrap, nowrap, normal]"
                                    data-frames='[{
                                        "delay":1000,
                                        "speed":900,
                                        "frame":"0",
                                        "from":"y:150px;opacity:0;",
                                        "ease":"Power3.easeOut",
                                        "to":"o:1;"
                                        },{
                                        "delay":"wait",
                                        "speed":1000,
                                        "frame":"999",
                                        "to":"opacity:0;","ease":"Power3.easeOut"
                                    }]'
                                    data-splitout="none"><?php echo $slide['slide_title'] ?>
                                </div>

                                <!-- HERO SUBTITLE -->
                                <div class="tp-caption small-text"
                                    data-x="30"
                                    data-y="center"
                                    data-voffset="[-40,-30,-20,0]"
                                    data-fontsize="[21,21,21,21]"
                                    data-lineheight="34"
                                    data-width="[none, none, none, 300]"
                                    data-whitespace="[nowrap, nowrap, nowrap, normal]"
                                    data-frames='[{
                                        "delay":1100,
                                        "speed":900,
                                        "frame":"0",
                                        "from":"y:150px;opacity:0;",
                                        "ease":"Power3.easeOut",
                                        "to":"o:1;"
                                        },{
                                        "delay":"wait",
                                        "speed":1000,
                                        "frame":"999",
                                        "to":"opacity:0;","ease":"Power3.easeOut"
                                    }]'
                                    ><?php echo $slide['slide_subtitle'] ?>
                                </div>

                                <!-- BUTTON -->
                                <div class="tp-caption"
                                        data-x="30"
                                        data-y="center"
                                        data-voffset="[60,60,60,100]"
                                        data-lineheight="55"
                                        data-hoffset="0"
                                        data-frames='[{
                                            "delay":1200,
                                            "speed":900,
                                            "frame":"0",
                                            "from":"y:150px;opacity:0;",
                                            "ease":"Power3.easeOut",
                                            "to":"o:1;"
                                            },{
                                            "delay":"wait",
                                            "speed":1000,
                                            "frame":"999",
                                            "to":"opacity:0;","ease":"Power3.easeOut"
                                        }]'
                                        ><a href='<?php echo $slide['slide_button_url'] ?>' class='btn btn--lg btn--color'><?php echo $slide['slide_button_text'] ?></a>
                                </div>

                            </li> <!-- end slide 1 -->
                        <?php endforeach; ?>               
					</ul>
				</div>
			</div>

			<!-- Intro -->
			<section class="section-wrap intro pb-40">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<h2 class="intro__title"><?php echo $about_company_left_column['column_title'] ?></h2>
							<?php echo $about_company_left_column['column_description'] ?>
							<div class="row mb-lg-48">
                                <?php foreach($about_company_left_column_icons as $icon): ?>
                                    <div class="col-sm-4">
                                        <div class="feature">
                                            <?php echo $icon['icon_code'] ?>
                                            <h4 class="feature__title"><?php echo $icon['icon_title'] ?></h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
							</div>
						</div>
						<div class="col-lg-5">
							<img src="<?php echo $about_company_right_column['column_image'] ?>" class="img-full-width" alt="">
						</div>
					</div>
				</div>
			</section> <!-- end intro -->


			<!-- Portfolio -->
			<section class="section-wrap pt-72 pb-72 pb-lg-40">
				<div class="container">
					<div class="title-row">
						<h2 class="section-title">Discover Recent Works</h2>
					</div>					

					<!-- Filter -->
					<div class="masonry-filter">
						<a href="#" class="filter active" data-filter="*">All</a>
                        <?php
                            $terms = get_terms('portfolio-category');
                        ?>
                        <?php foreach($terms as $term): ?>
						    <a href="#" class="filter" data-filter=".<?php echo $term->slug ?>"><?php echo $term->name ?></a>
                        <?php endforeach; ?>
					</div> <!-- end filter -->

					<div class="row masonry-grid">
						<?php while($portfolio_items->have_posts()): ?>
                            <?php $portfolio_items->the_post() ?>
                            <?php
                                $portfolio_categories = get_the_terms(get_the_ID(), 'portfolio-category');
                                $portfolio_categories_str = "";
                                foreach($portfolio_categories as $category){
                                    $portfolio_categories_str .= $category->slug . ' ';
                                }
                            ?>
                            <div class="masonry-item col-lg-4 project hover-trigger <?php echo $portfolio_categories_str ?>">
                                <div class="project__container">
                                    <div class="project__img-holder">
                                        <a href="<?php the_permalink() ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title() ?>" class="project__img">
                                            <div class="hover-overlay">
                                                <div class="project__description">
                                                    <h3 class="project__title"><?php the_title() ?></h3>
                                                    <!-- <span class="project__date">2018</span> -->
                                                </div>
                                            </div>
                                        </a>              
                                    </div>                  
                                </div> 
                            </div> <!-- end project -->
                        <?php endwhile; ?>
					</div>
				</div>
			</section> <!-- end portfolio -->

			<!-- Testimonials -->
			<section class="section-wrap bg-dark-overlay" style="background-image: url(img/testimonials/bg.jpg);">
				<div class="container">
					<div class="title-row text-center">
						<p class="subtitle">Testimonials</p>
						<h2 class="section-title">What clients say about us</h2>
						<i class="quote">“</i>
					</div>					

					<div class="slick-slider slick-testimonials">

						<div class="testimonial clearfix">
							<div class="testimonial__body">
								<p class="testimonial__text">“I have witnessed and admired the work for years. I highly recommend this work for anyone seeking to increase.”</p>
							</div>
							<div class="testimonial__info">
								<span class="testimonial__author">Joeby Ragpa</span>
								<span class="testimonial__company">DeoThemes</span>
							</div>
						</div>

						<div class="testimonial clearfix">
							<div class="testimonial__body">
								<p class="testimonial__text">“Every detail has been taken care these team are realy amazing and talented! I will work only to help your sales goals.”</p>
							</div>
							<div class="testimonial__info">
								<span class="testimonial__author">Alexander Samokhin</span>
								<span class="testimonial__company">DeoThemes</span>
							</div>
						</div>

						<div class="testimonial clearfix">
							<div class="testimonial__body">
								<p class="testimonial__text">“I have witnessed and admired the work for years. I highly recommend this work for anyone seeking to increase.”</p>
							</div>
							<div class="testimonial__info">
								<span class="testimonial__author">Joeby Ragpa</span>
								<span class="testimonial__company">DeoThemes</span>
							</div>
						</div>

						<div class="testimonial clearfix">
							<div class="testimonial__body">
								<p class="testimonial__text">“Every detail has been taken care these team are realy amazing and talented! I will work only to help your sales goals.”</p>
							</div>
							<div class="testimonial__info">
								<span class="testimonial__author">Alexander Samokhin</span>
								<span class="testimonial__company">DeoThemes</span>
							</div>
						</div>

					</div> <!-- end slider -->

				</div>
			</section> <!-- end testimonials -->

			<!-- Partners -->
			<div class="partners bg-light text-center">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/1.png" alt="">
							</a>
						</div>
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/2.png" alt="">
							</a>
						</div>
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/3.png" alt="">
							</a>
						</div>
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/4.png" alt="">
							</a>
						</div>
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/5.png" alt="">
							</a>
						</div>
						<div class="col-sm-2">
							<a href="#">
								<img src="img/partners/6.png" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- From Blog -->
			<section class="section-wrap blog-grid">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<div class="blog-grid__title-col d-flex flex-column mb-lg-48">
								<div class="title-row">
									<p class="subtitle">From Blog</p>
									<h2 class="section-title">Specialized news</h2>
									<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequun tur magni dolores eos qui
									ratione</p>
								</div>
								<div class="call-us mt-auto">
									<i class="icon-Dispacher-2 call-us__icon"></i>
									<span class="call-us__title">Call us anytime</span>
									<a href="tel:1-800-995-3959" class="call-us__phone-number"> 1-800-995-3959</a>
								</div>
							</div>							
						</div>						

						<div class="col-lg-7 offset-lg-1">
							<div class="from-blog">
								<div class="row row-60">
									<div class="col-lg-6">
										<article class="entry">
											<div class="entry__img-holder">
												<a href="single-post.html">
													<img src="img/blog/from_blog_1.jpg" class="entry__img" alt="">
												</a>
											</div>
											<div class="entry__body">
												<ul class="entry__meta">
													<li class="entry__meta-date">
														<span>15 November 2018</span>
													</li>
												</ul>
												<h4 class="entry__title">
													<a href="single-post.html">Best buildings of 2018 revealed at day one of World Architecture Festival 2018.</a>
												</h4>
											</div>
										</article>
									</div>
									<div class="col-lg-6">
										<article class="entry">
											<div class="entry__img-holder">
												<a href="single-post.html">
													<img src="img/blog/from_blog_2.jpg" class="entry__img" alt="">
												</a>
											</div>
											<div class="entry__body">
												<ul class="entry__meta">
													<li class="entry__meta-date">
														<span>15 November 2018</span>
													</li>
												</ul>
												<h4 class="entry__title">
													<a href="single-post.html">Sunken washroom by Studio 304 allows residents to bathe in a garden setting.</a>
												</h4>
											</div>
										</article>
									</div>
								</div>
								<div class="from-blog__recent-posts">
									<ul class="from-blog__recent-posts-list">
										<li class="from-blog__recent-posts-item">
											<span class="from-blog__post-number">1</span>
											<a href="single-post.html" class="from-blog__post-url">Guadalajara offers "extraordinary opportunities" for young architects</a>
										</li>
										<li class="from-blog__recent-posts-item">
											<span class="from-blog__post-number">2</span>
											<a href="single-post.html" class="from-blog__post-url">Lacy Brick by Pamphilon ArchitectsResidentialPamphilon Architects adds textured
											brick extension to Edwardian house in London</a>
										</li>
										<li class="from-blog__recent-posts-item">
											<span class="from-blog__post-number">3</span>
											<a href="single-post.html" class="from-blog__post-url">Guadalajara offers "extraordinary opportunities" for young architects</a>
										</li>
									</ul>
								</div>								 
							</div>
						</div>

					</div>
				</div>
			</section> <!-- end from blog -->

<?php get_footer() ?>
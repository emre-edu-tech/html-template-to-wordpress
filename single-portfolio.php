<?php
    global $post;   // important to get the id of the current post
    $image_gallery = get_field('image_gallery');
    $client = get_field('client');
    $project_date = get_field('project_date');
    $project_location = get_field('project_location');
    $share_icons = get_field('share_icons');
?>
<?php get_header() ?>
<div class="content-wrapper content-wrapper--boxed oh">

<!-- Portfolio Single -->
<div class="slick-slider slick-single-image">
    <?php foreach($image_gallery as $image): ?>
    <img src="<?php echo $image ?>" class="project__featured-img" alt="">
    <?php endforeach; ?>
</div>			

<section class="section-wrap pt-72 pb-32">
    <div class="container">
        <div class="row">
    
            <div class="col-lg-8 project__info mb-md-40">
                <?php the_content(); ?>
            </div> <!-- project info -->
    
            <div class="col-lg-4 project__details">
                <ul class="project__meta">
                    <li class="project__meta-item">
                        <span class="project__meta-label">Client:</span>
                        <span class="project__meta-value"><?php echo $client; ?></span>
                    </li>
                    <li class="project__meta-item">
                        <span class="project__meta-label">Date:</span>
                        <span class="project__meta-value"><?php echo $project_date ?></span>
                    </li>								
                    <li class="project__meta-item">
                        <span class="project__meta-label">Category:</span>
                        <?php
                            $terms = get_the_terms($post->ID, 'portfolio-category');
                            $terms_arr = array();
                            $terms_name_str = "";
                            foreach($terms as $term) {
                                $terms_arr[] = $term->name;
                            }
                            $terms_name_str = implode(' ', $terms_arr);
                        ?>
                        <?php foreach($terms as $term): ?>
                            <span class="project__meta-value"><?php echo $terms_name_str ?></span>
                        <?php endforeach; ?>
                    </li>
                    <li class="project__meta-item">
                        <span class="project__meta-label">Location:</span>
                        <span class="project__meta-value"><?php echo $project_location ?></span>
                    </li>
                </ul>
                <h6 class="share-label">Share:</h6>
                <div class="socials">
                    <?php foreach($share_icons as $icon): ?>
                        <a href="<?php echo $icon['icon_url'] ?>" class="social <?php echo $icon['icon_class'] ?>" aria-label="<?php echo $icon['icon_aria_label'] ?>" title="<?php $icon['icon_title'] ?>" target="_blank"><?php echo $icon['icon_code'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
    
        </div>
    </div>
</section> <!-- end portfolio single -->


<!-- Related Projects -->
<?php
$portfolio_categories = get_the_terms( $post->id, 'portfolio-category');
if($portfolio_categories) {
    $portfolio_category_names = array();
    foreach ($portfolio_categories as $portfolio_category) {
        $portfolio_category_names[] = $portfolio_category->slug;
    }
}

$args = array(
    'post_type' => 'portfolio',
    'tax_query' => array(
        array(
            'taxonomy' => 'portfolio-category',
            'field' => 'slug',
            'terms' => $portfolio_category_names,
        )
    )
);
$query = new WP_Query($args);
?>
<?php if($query->have_posts()): ?>
<section class="section-wrap pt-32">
    <div class="container">
        <div class="title-row mb-48">
            <h2 class="section-title"><?php _e('Related Projects', 'mcp-archtitect') ?></h2>
        </div>
        <div class="row">
            <?php while($query->have_posts()): ?>
                <?php $query->the_post() ?>
                <div class="masonry-item col-lg-4 project hover-trigger commercial">
                    <div class="project__container">
                        <div class="project__img-holder">
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>" alt="<?php the_title() ?>" class="project__img">
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
</section> <!-- end related projects -->
<?php endif; ?>
<?php get_footer() ?>
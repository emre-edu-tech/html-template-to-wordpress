<?php get_header() ?>
<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php the_post() ?>
        <a href="<?php the_permalink() ?>">
            <h2><?php the_title(); ?></h2>
        </a>
        <div class="post-content">
            <?php the_excerpt(); ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer() ?>
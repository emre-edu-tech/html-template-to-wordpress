<?php
    // this code gets the current global post object and retrieves the post author id
    global $post;
    $author_id = $post->post_author;
?>
<?php get_header() ?>

    <?php if(has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>
    <h2><?php the_title() ?></h2>
    <p class="post-author">Posted by: <strong><?php the_author_meta('display_name', $author_id) ?></p></strong>
    <div class="post-content">
        <?php the_content() ?>
    </div>
    <div class="post-comment-form" style="width: 80%">
        <?php comment_form() ?>
    </div>

<?php get_footer() ?>
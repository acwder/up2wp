<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php
            // Check for post thumbnail
            if (has_post_thumbnail($post->ID)) {
                ?>
                <div id="post-thumbnail">
                <?php echo get_the_post_thumbnail($post->ID, 'post-thumbnail'); ?>
                </div>
        <?php } ?>

            <h2><?php the_title(); ?></h2>



            <div class="entry group">

                <?php the_content(); ?>

                    <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                <div class="the_tags">
        <?php the_tags('Taggar: ', ', ', ''); ?>
                </div>
            </div>

            <div class="entrymetacont">
                <div class="socialmedia">
        <?php get_template_part('/inc/socialbuttons', ''); ?>

                </div>
            <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
            </div>
        <?php /* edit_post_link('Ändra inlägget','','.'); */ ?>

        </div>

        <?php comments_template('', true); ?>


    <?php endwhile;
endif; ?>
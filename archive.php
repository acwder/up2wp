<?php get_header(); ?>
<div id="rscontent">
    <?php $paged = get_query_var('paged'); ?>
    <?php query_posts($query_string . '&paged' . $paged); ?>
    <?php if (have_posts()) : ?>

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <div class="info-h2">
            <?php /* If this is a category archive */ if (is_category()) { ?>

                <h2>Arkiv för kategorin &#8216;<?php single_cat_title(); ?>&#8217;</h2>

            <?php /* If this is a tag archive */
            } elseif (is_tag()) { ?>
                <h2>Artiklar taggade &#8216;<?php single_tag_title(); ?>&#8217;</h2>

    <?php /* If this is a daily archive */
    } elseif (is_day()) { ?>
                <h2>Arkiv för <?php the_time('F jS, Y'); ?></h2>

            <?php /* If this is a monthly archive */
            } elseif (is_month()) { ?>
                <h2>Arkiv för <?php the_time('F, Y'); ?></h2>

            <?php /* If this is a yearly archive */
            } elseif (is_year()) { ?>
                <h2 class="pagetitle">Arkiv för <?php the_time('Y'); ?></h2>

    <?php /* If this is an author archive */
    } elseif (is_author()) { ?>
                <h2 class="pagetitle">Arkiv för författaren</h2>

        <?php /* If this is a paged archive */
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2 class="pagetitle">Bloggarkiv</h2>

            <?php } ?>
        </div>

                <?php while (have_posts()) : the_post(); ?>

            <div <?php post_class() ?>>
                <?php
                // Check for post thumbnail
                if (has_post_thumbnail($post->ID)) {
                    ?>
                    <div id="post-thumbnail">
                        <?php echo get_the_post_thumbnail($post->ID, 'post-thumbnail'); ?>
                    </div>
                <?php } ?>
                <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>



                <div class="entry">
            <?php the_content(); ?>
                </div>
            <?php include (TEMPLATEPATH . '/inc/postmeta.php' ); ?>
            </div>

        <?php endwhile; ?>

    <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

<?php else : ?>
        <div class="info-h2">
            <h2>Det du försökte nå kunde inte hittas</h2>
        </div>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>


<?php get_footer(); ?>

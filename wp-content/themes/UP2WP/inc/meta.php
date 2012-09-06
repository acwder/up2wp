<div class="meta">
	Publicerat <?php the_time('d F, Y') ?>
	av <?php the_author() ?>
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info" class="group">
						<div id="author-avatar">
                                                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), '60' ); ?>
							
						</div>
						<div id="author-description">
							<?php the_author_meta( 'description' ); ?>
						</div></div>
                                                        <?php endif; ?>
</div>
<?php

/**
 * FooWidget Class
 */
class UpNsWidget extends WP_Widget {

    /** constructor */
    function UpNsWidget() {
        parent::WP_Widget(false, $name = 'UP Nivo Slider Widget');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract($args);
        $titleupns = apply_filters('widget_title', $instance['title']);
        ?>
        <?php echo '<div class="widget_upnswidget">'; ?>
        <?php echo '<div id="slider">'; ?>
        <?php
        $args = array('post_type' => 'upns_slider', 'numberposts' => -1);
        $upns_slider = get_posts($args);
        if ($upns_slider) {
            foreach ($upns_slider as $upns_post) {
                if (has_post_thumbnail($upns_post->ID)) {
                    $src = wp_get_attachment_image_src(get_post_thumbnail_id($upns_post->ID), array(300, 300), false, '');
                    $thumbnailSrc = $src[0];
                    global $blog_id;
	if (isset($blog_id) && $blog_id > 0) {
		$imageParts = explode('/files/', $thumbnailSrc);
		if (isset($imageParts[1])) {
			$thumbnailSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
		}
	}
                    echo '<a href="' . get_permalink($upns_post->ID) . '">';
                    ?>
                    <img src="<?php bloginfo('template_directory'); ?>/inc/timthumb/timthumb.php?src=<?php echo $thumbnailSrc; ?>&amp;h=300&amp;w=205&amp;zc=1q=100" width="205px" height="300px" alt="" title="#upnscap-<?php echo $upns_post->ID; ?>" />
                    <?php
                    //   echo '<a href="' . get_permalink( $upns_post->ID ) . '" title="' . get_the_title( $upns_post->post_title ) . '">';
                    //  echo get_the_post_thumbnail($upns_post->ID, 'upns-thumb');
                    echo '</a>';
                    ?>
                    <div id="upnscap-<?php echo $upns_post->ID; ?>" class="nivo-html-caption">
                        <strong><?php echo $titleupns; ?>:</strong><br />
                    <?php echo get_the_title($upns_post->ID); ?>
                    </div>
                <?php
                }
            }
        }
        ?>
        <?php echo '</div>'; ?>
        <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr($instance['title']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }

}

// class FooWidget

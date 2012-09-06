<?php
// Translations (which is in progress)
load_theme_textdomain('ungpirat', TEMPLATEPATH . '/lang');
// Add RSS links to <head> section
automatic_feed_links();

// Load jQuery
if (!is_admin()) {
    wp_enqueue_script('jquery');
}

// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

add_action('init', 'create_upns_post_type');

function create_upns_post_type() {
    register_post_type('upns_slider', array(
        'labels' => array(
            'name' => __('Slider'),
            'singular_name' => __('Slider')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats'),
        'rewrite' => array('slug' => 'slider')
            )
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widgets',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Right Footer Widget',
        'id' => 'right-footer-widget',
        'description' => 'This is a large widget for the footer.',
        'before_widget' => '<div id="%1$s" class="right_footer_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
     register_sidebar(array(
        'name' => 'Left Footer Widget',
        'id' => 'left-footer-widget',
        'description' => 'This is a widget for the footer.',
        'before_widget' => '<div id="%1$s" class="left_footer_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}

require_once ('inc/widget/upnswidget.php' );

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("UpNsWidget");'));

require_once ('inc/theme-options.php' );

add_custom_image_header('header_style', 'admin_header_style');
add_action('init', 'register_my_menu');

function register_my_menu() {
    register_nav_menu('primary-menu', __('Primary Menu'));
}

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(480, 150, true);
}

if (function_exists('add_image_size')) {
    add_image_size('upns-thumb', 200, 300);
}

function new_excerpt_more($more) {
    global $post;
    return ' <a href="' . get_permalink($post->ID) . '">[Läs mer]</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

add_filter('tiny_mce_before_init', create_function('$a', '$a["extended_valid_elements"] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $a;'));

function ungpirat_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    echo '<li ', comment_class(), ' id="li-comment-', comment_ID(), '">';
    echo '<div id="comment-', comment_ID(), '">';
    echo '<div class="comment-author vcard">';
    echo get_avatar($comment, $size = '64', $default = '');
    printf(__('<cite class="fn">%s</cite> <span class="says">säger:</span>'), get_comment_author_link());
    echo '</div>';
    if ($comment->comment_approved == '0') {
        echo '<em>', _e('Din kommentar väntar på moderation'), '</em>';
        echo '<br />';
    }

    echo '<div class="comment-meta commentmetadata"><a href="', htmlspecialchars(get_comment_link($comment->comment_ID)), '">';
    printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time());
    echo '</a>', edit_comment_link(__('(Ändra)'), '  ', ''), '</div>';

    comment_text();

    echo '<div class="reply">';
    comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
    echo '</div></div>';
}

function ungpirat_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo '<li id="comment-', comment_ID(), '">', comment_author_link(), '';
}

function new_custom_background_cb() {
    $background = get_background_image();
    $color = get_background_color();
    if (!$background && !$color)
        return;

    $style = $color ? "background-color: #$color;" : '';

    if ($background) {
        $image = " background-image: url('$background');";
        $repeat = get_theme_mod('background_repeat', 'repeat');
        if (!in_array($repeat, array('no-repeat', 'repeat-x', 'repeat-y', 'repeat')))
            $repeat = 'repeat';
        $repeat = " background-repeat: $repeat;";

        $position = get_theme_mod('background_position_x', 'left');
        if (!in_array($position, array('center', 'right', 'left')))
            $position = 'left';
        $position = " background-position: top $position;";

        $attachment = get_theme_mod('background_attachment', 'scroll');
        if (!in_array($attachment, array('fixed', 'scroll')))
            $attachment = 'scroll';
        $attachment = " background-attachment: $attachment;";

        $style .= $image . $repeat . $position . $attachment;
    }
    ?><style type="text/css">
        #container_bg {
            <?php echo trim($style); ?>
        }
    </style>
    <?php
}

add_custom_background(new_custom_background_cb, '', '');

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/default_banner.png'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 830); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', 170);
define('NO_HEADER_TEXT', true);

// gets included in the site header
function header_style() {
    ?><style type="text/css">
        #header_img {
            background: url(<?php header_image(); ?>) left bottom no-repeat;
        }
    </style><?php
}

// gets included in the admin header
function admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo $HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo $HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style><?php
}?>
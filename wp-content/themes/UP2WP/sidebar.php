        <?php include (TEMPLATEPATH . '/inc/submenu.php' ); ?>
   
    <div id="sidebar">
        
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>

            <?php wp_list_pages('title_li=<h2>Sidor</h2>'); ?>

        <?php endif; ?>

    </div>

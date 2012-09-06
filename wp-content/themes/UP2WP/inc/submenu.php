<?php if (is_front_page()) { ?>
<div>
    <?php } elseif (is_category() || is_single()) { ?>
        <div id="submenu">
            <?php
            
            $options = get_option('ungpirat_theme_options');
            $up_maincat = $options['maincategory'];
            $up_maincat_id = get_cat_ID($up_maincat);

            $args = array(
                'child_of' => $up_maincat_id,
                'orderby' => 'name',
                'order' => 'ASC'
            );
            $current_category_submenu = get_the_category(); 
            $ccs = $current_category_submenu[0]->cat_name;
            $ccs_check = single_cat_title("", false);
            
            ?>
            
            <h2><a href=""><?php echo $up_maincat ?></a></h2>
            <ul>
                <?php
                $categories = get_categories($args);
                foreach ($categories as $category) {
                    if ($category->name == $ccs && $ccs_check != 'Kategorier') {
                        echo '<li class="current_page_item"><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '>' . $category->name . '</a> </li>';
                    } else {
                        echo '<li><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '>' . $category->name . '</a> </li>';
                    }
                }
               
                ?>
            </ul>
        <?php } else { ?>        
            <div id="submenu">
                <?php
                //if the post has a parent
                if ($post->post_parent) {
                    //collect ancestor pages
                    $relations = array();
                    //get the main top page (ancestors is sorted desc)
                    $firstancestor = current($post->ancestors);
                    $ancestor = end($post->ancestors);


                    //get the child pages for the main top page (depth 1)
                    $result_top_pages = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_parent = $ancestor AND post_type='page'");
                    if ($result_top_pages) {
                        foreach ($result_top_pages as $pageID) {
                            array_push($relations, $pageID->ID);
                        }
                    }
                    //get child pages (depth 2)
                    $result_child_pages = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_parent = $post->ID AND post_type='page'");
                    if ($result_child_pages) {
                        foreach ($result_child_pages as $pageID) {
                            array_push($relations, $pageID->ID);
                        }
                    }
                    //get sibling pages (depth 2)
                    $result_sibling_pages = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_parent = $firstancestor AND post_type='page'");
                    if ($result_sibling_pages) {
                        foreach ($result_sibling_pages as $pageID) {
                            array_push($relations, $pageID->ID);
                        }
                    }
                    //add current post to pages
                    array_push($relations, $post->ID);
                    //get comma delimited list of children and parents and self
                    $relations_string = implode(",", $relations);
                    //use include to list only the collected pages.
                    $sidelinks = wp_list_pages("title_li=&echo=0&include=" . $relations_string);

                    $titlename = get_the_title($ancestor);
                    $titlenameurl = $ancestor;
                } else {
                    // display only main level and children
                    $sidelinks = wp_list_pages("title_li=&echo=0&depth=1&child_of=" . $post->ID);
                    $titlename = get_the_title($post->ID);
                    $titlenameurl = $post->ID;
                }

                if ($sidelinks) {
                    ?>

                    <h2><a href="<?php echo get_permalink($titlenameurl); ?>"><?php echo $titlename; ?></a></h2>
                    <ul>
                        <?php echo $sidelinks; ?>
                    </ul>

                <?php }
            } ?>


        </div>

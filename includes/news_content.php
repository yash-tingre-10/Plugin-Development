<?php
function hwy_add_news_location_to_content($content){
        if(is_singular('news')){
            
            $location = hwy_get_news_location( get_the_ID() );
            $content = '<p class="news-lat-lon">'.  esc_html($location->lat) . ',' . esc_html($location->lon) . '</p>' . $content;
            $content = '<p class="news-location">'. esc_html(get_post_meta(get_the_ID(), '_news_location', true)) .'</p>'. $content;
        }
        return $content;

    }
    add_filter('the_content', 'hwy_add_news_location_to_content');

    function hwy_add_posts_to_end_of_content( $content ){
        global $post;
        if(is_singular('news') && get_option('hwy_show_related', true)){
            $args = array(
                'numberposts' => intval(get_option('hwy_related_news_amount', 3)),
                'post_type' => 'news',
                'post__not_in' =>array(get_the_ID()),
                'meta_key' => '_news_location',
                'meta_value' => get_post_meta(get_the_ID(), '_news_location', true)
            );
            $wp_query=new WP_Query($args);
            if($wp_query->have_posts()){
            ob_start();
            ?>
            <h3><?php echo esc_html(get_option('hwy_news_related_title', __('Related News','hello-world-yo'))) ?></h3>
            <ul class="latest-posts">
                <?php while($wp_query->have_posts() ): $wp_query->the_post(); ?>
                    <li><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
            <?php
            $content .= ob_get_clean();
            wp_reset_postdata();
            }
        }
        return $content;
    }
    add_filter('the_content', 'hwy_add_posts_to_end_of_content');
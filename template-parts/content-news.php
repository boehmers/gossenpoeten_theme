<?php
/**
 * Created by IntelliJ IDEA.
 * User: Manuel
 * Date: 06.04.2017
 * Time: 14:11
 */

$args = array (
    'category_name' => 'news',
    'posts_per_page' => -1,
    'orderby' => 'date',
);

$cat_posts = new WP_query($args);

if ($cat_posts->have_posts()) : while ($cat_posts->have_posts()) : $cat_posts->the_post();
    get_template_part( 'template-parts/content', get_post_format() );
endwhile; endif;
?>


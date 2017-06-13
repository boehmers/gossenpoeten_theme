<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gossenpoeten_theme
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar('sidebar-1');
    if ( has_nav_menu('social') ) : ?>
    </section>
    <div id="social-media-menu">
        <ul class="social-network social-circle">
            <?php
            $menu_name = 'social';
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
            $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

            foreach ($menuitems as $item) {
                $link = $item->url;
                $title = $item->title;
                echo '<li><a href="'.$link.'" class="ico'.$title.'" title="'.$title.'"><i class="fa fa-'.strtolower($title).'"></i></a></li>';
            }
            ?>
        </ul>
    </div>
    <?php endif; ?>
</aside><!-- #secondary -->

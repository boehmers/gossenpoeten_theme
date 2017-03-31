<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gossenpoeten_theme_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__( 'Sidebar', 'gossenpoeten_theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'gossenpoeten_theme' ),
        'before_widget' => '<section id="%1$s" class="panel panel-default widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="panel-heading"><h3 class="panel-title widget-title">',
        'after_title'   => '</h3></div>',
    ));
}

add_action('widgets_init', 'gossenpoeten_theme_widgets_init');
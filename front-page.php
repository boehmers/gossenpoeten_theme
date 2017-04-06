<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package gossenpoeten_theme
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <h1>Neues</h1>
            <hr>
            <div class="content-area-1">
            <?php
            $args = array(
                'posts_per_page' => 1, // we need only the latest post, so get that post only
                'category_name' => 'news',
            );
            $q = new WP_Query( $args);

            if ( $q->have_posts() ) {
                while ( $q->have_posts() ) {
                    $q->the_post();
                    //Your template tags and markup like:
                    get_template_part( 'template-parts/content', get_post_format() );
                }
                wp_reset_postdata();
            }
            ?>
            </div>
            <div class="content-area-2">
                <h2><a href="https://www.facebook.com/gossenpoeten/">Facebook</a></h2>
                <div
                        class="fb-page"
                        data-href="https://www.facebook.com/gossenpoeten"
                        data-tabs="timeline, events, messages"
                        data-small-header="false"
                        data-adapt-container-width="true"
                        data-hide-cover="false"
                        data-show-facepile="true"
                >
                    <blockquote cite="https://www.facebook.com/gossenpoeten" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/gossenpoeten">Gossenpoeten</a>
                    </blockquote>
                </div>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();

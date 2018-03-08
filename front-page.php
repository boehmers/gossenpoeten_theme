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
            <div>
                <div
                        class="fb-page"
                        data-href="https://www.facebook.com/gossenpoeten"
                        data-tabs="timeline, events, messages"
                        data-small-header="false"
                        data-adapt-container-width="true"
                        data-hide-cover="false"
                        data-show-facepile="true"
                        data-width="500"
                        data-height="700"
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

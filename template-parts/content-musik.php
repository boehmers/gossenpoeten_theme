<?php
require_once ('modal.php');
$args = array (
    'category_name' => 'alben',
    'posts_per_page' => -1,
    'orderby' => 'date',
);

$cat_posts = new WP_query($args);

?>
<div class="row">
    <h1 class="col-xs-3" style="margin-top:0;">Musik</h1>
    <div class="col-xs-9" style="text-align: right;">
        <ul class="social-network social-circle">
            <li>
                <a href="https://www.spotify.com//" class="icoSpotify" title="Spotify" style="display: inline-block;">
                    <i class="fa fa-spotify"></i></a>
            </li>
            <li>
                <a href="https://www.amazon.de" class="icoAmazon" title="Spotify" style="display: inline-block;">
                    <i class="fa fa-amazon"></i></a>
            </li>
            <li>
                <a href="https://www.itunes.com" class="icoItunes" title="iTunes" style="display: inline-block;">
                    <i class="fa fa-apple"></i></a>
            </li>
         </ul>
    </div>
</div>
<?php
    if ($cat_posts->have_posts()) : while ($cat_posts->have_posts()) : $cat_posts->the_post();
    ?>
        <h2 class="page-header">Alben</h2>
    <div class="gallery-wrapper">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php



            the_title( '<h2 class="entry-title" style="color: #1bb569;">','</h2>' );?>
            <div class="gallery-thumbnail"  onclick="openModal(<?php the_ID() ?>);">
                <img src="<?php the_post_thumbnail_url(); ?>" class="hover-shadow">
            </div>


            <div id="myModal<?php the_ID() ?>" class="modal" style="background-color: rgb(0, 0, 0);">
                <span class="close cursor" onclick="closeModal(<?php the_ID(); ?>)">&times;</span>
                <div class="modal-content" style="background-color: black ;">
                    <div class="row">
                        <div class="col-xs-3"></div>
                        <div class="col-xs-4" style="width: 256px; height: 256px; margin:0 auto;">
                            <img src="<?php the_post_thumbnail_url(); ?>" style=" position: relative;top: 50%;transform: translateY(-50%);">
                        </div>
                        <div class="col-xs-3" style="height: 256px;">
                            <?php the_title( '<h2 class="entry-title" style="color: #1bb569; position: relative;top: 50%;transform: translateY(-50%); margin-top: 0px;">','</h2>' );?>
                        </div>
                        <div class="col-xs-2"></div>
                    </div>

                    <div class="" style="margin-left: 25px; margin-top: 25px;">
                        <?php
                            the_content();

                        ?>
                    </div>

                </div>
            </div>
        </article><!-- #post-## -->
    </div>
<?php
endwhile; endif;

$args2 = array (
    'category_name' => 'musik',
    'posts_per_page' => -1,
    'orderby' => 'date',
);

$cat_posts2 = new WP_query($args2);
if ($cat_posts2->have_posts()) : while ($cat_posts2->have_posts()) : $cat_posts2->the_post();
    ?>
    <h2 class="page-header">Neuigkeiten</h2>
<?php
    get_template_part( 'template-parts/content', get_post_format() );
endwhile; endif;

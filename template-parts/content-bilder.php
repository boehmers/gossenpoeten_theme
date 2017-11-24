<?php
require_once ('modal.php');
$args = array (
'category_name' => 'bilder',
'posts_per_page' => -1,
'orderby' => 'date',
);

$cat_posts = new WP_query($args);
?>
    <h1 style="margin-top:0;">Bilder</h1>
<?php

if ($cat_posts->have_posts()) : while ($cat_posts->have_posts()) : $cat_posts->the_post();
?>
    <div class="gallery-wrapper">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php
            $media = get_post_gallery(null,false);
            $mediaIds =explode(",",$media["ids"]);
            $caption =[];
            foreach ($mediaIds as $id) {
                array_push($caption,wp_get_attachment($id));
            }

            the_title( '<h2 class="entry-title" style="color: #1bb569;">','</h2>' );?>
            <div class="gallery-thumbnail"  onclick="openModal(<?php the_ID() ?>);currentSlide(1,<?php the_ID(); ?>)" style="">
                <img src="<?php the_post_thumbnail_url(); ?>" class="hover-shadow">
            </div>
            <div style="float: left;">
                    <?php
                   
                    $text = wpautop( $post->post_content );

                    $text = strip_shortcodes( $text );
                    echo $text;
                    ?>
            </div>

            <div id="myModal<?php the_ID() ?>" class="ownmodal">
                <span class="close cursor" onclick="closeModal(<?php the_ID(); ?>)">&times;</span>
                <div class="modal-content">
                    <?php  $counter = 1;
                    foreach ($media["src"] as $value)
                    {

                    ?>
                        <div class="mySlides" name="slides<?php the_ID(); ?>">
                            <div>
                                <div class="numbertext"><?php echo $counter ?>/<?php echo count($media["src"])?></div>
                                <img src="<?php echo $value; ?>" style="width:100%">
                                <a class="prev" onclick="plusSlides(-1,<?php the_ID(); ?>)" onkeydown="arrowkey(event,<?php the_ID(); ?>)">
                                    <div class="gallery-control"> &#10094;</div>
                                </a>
                                <a class="next" onclick="plusSlides(1, <?php the_ID(); ?>)">
                                    <div class="gallery-control"> &#10095;</div>
                                </a>
                            </div>

                            <div class="caption-container"><?php echo $caption[$counter-1]["caption"]; ?></div>

                        </div>
                    <?php
                        $counter=$counter+1;
                    }
                    ?>





                </div>
            </div>
        </article><!-- #post-## -->
    </div>
<?php
endwhile; endif;
function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,

    );
}


?>
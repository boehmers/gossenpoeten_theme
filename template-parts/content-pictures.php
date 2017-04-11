<?php
require_once ('modal.php');
$args = array (
'category_name' => 'pictures',
'posts_per_page' => -1,
'orderby' => 'date',
);

$cat_posts = new WP_query($args);

if ($cat_posts->have_posts()) : while ($cat_posts->have_posts()) : $cat_posts->the_post();
?>
    <div class="gallery-wrapper">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php $media = get_post_gallery_images();
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );?>
            <img src="<?php the_post_thumbnail_url(); ?>" onclick="openModal(<?php the_ID() ?>);currentSlide(1,<?php the_ID(); ?>)" class="hover-shadow">
            <div id="myModal<?php the_ID() ?>" class="modal">
                <span class="close cursor" onclick="closeModal(<?php the_ID(); ?>)">&times;</span>
                <div class="modal-content">
                    <?php  $counter2 = 1;
                    foreach ($media as $value)
                    {

                    ?>
                        <div class="mySlides" name="slides<?php the_ID(); ?>">
                            <div class="numbertext"><?php echo $counter2 ?>/<?php echo count($media)?></div>
                            <img src="<?php echo $value; ?>" style="width:100%">
                        </div>
                    <?php
                        $counter2=$counter2+1;
                    }
                    ?>
                    <a class="prev" onclick="plusSlides(-1,<?php the_ID(); ?>)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1, <?php the_ID(); ?>)">&#10095;</a>

                </div>
            </div>
        </article><!-- #post-## -->
    </div>
<?php
endwhile; endif;
?>
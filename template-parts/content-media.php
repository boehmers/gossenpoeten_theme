
<?php
//get current page-id
$pageid = get_the_ID();
$page_link = get_page_link($pageid);
?>


<?php
//filter pictures and store in $posts_array
$args = array (
  'category_name' => 'bilder',
  'orderby' => 'date',
  'post_type' => 'post',
  'posts_per_page' => 3
);
$posts_array = get_posts($args); 
?>
<?php
$bilder_url = $page_link."/bilder";
?>
<h2>
    <a href="<?php echo $bilder_url ?>" class="media-header" style="display: block;"><u>Bilder</u></a>
</h2>

<?php
/******************************VIDEO************************************************/
?>

<?php
//filter videos and store in $posts_array
$args = array (
    'category_name' => 'videos',
    'orderby' => 'date',
    'post_type' => 'post',
    'posts_per_page' => 3
);
$posts_array = get_posts($args);
?>

<h2 class="media-header">Videos</h2>

<?php
//check if there is content
if(!empty($posts_array)) : ?>

    <div class="row" style="margin-left: 1%">
        <?php
        //loop through posts
        foreach( $posts_array as $post ) :
            //to get URL as String
            $src=$post->post_content;
            $content=apply_filters('the_content', get_post_field('post_content', $my_postid));

            //Thumbnail-Picture
            $thumb;
            // check if the post has a Post Thumbnail assigned to it.
            if ( has_post_thumbnail() ) {
                $thumb_id = get_post_thumbnail_id( $post);
                $thumb=wp_get_attachment_image_url($thumb_id, array('700', '600'));
                ?>

                <!-- video content -->
                <div class= "col-xs-4" style="padding-left: 0">
                    <div id="post-<?php the_ID(); ?>"  class="video-gallery">
                        <div><a data-toggle="modal" data-target="#myModal<?php the_ID(); ?>"><img src="<?php echo $thumb ?> " /> </a></div>
                        <h2 class="media-capture" ><?php the_title(); ?> </h2>
                    </div>
                </div>


                <!-- modal content -->
                <div class="modal fade" id="myModal<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close modal-close-button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="media-capture" id="myModalLabel"><?php the_title(); ?></h4>
                            </div>
                            <div class="modal-body">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
            }
        endforeach;
        ?>
    </div>
    <?php
    //link to video-page
    $video_url = $page_link."/videos";
    ?>
    <a class="mediaLink" target="_blank" href=<?php echo $video_url;?>>Weitere Videos</a>

    <?php
endif;
?>


<?php
/******************************Music************************************************/
?>



<?php

//filter videos and store in $posts_array
$args = array (
    'category_name' => 'alben',
    'orderby' => 'date',
    'post_type' => 'post',
    'posts_per_page' => 3
);
$posts_array = get_posts($args);
?>
<h2 class="media-header">Musik</h2>

<?php
//check if there is content
if(!empty($posts_array)) : ?>
    <div class="row" style="margin-left: 1%">
        <?php
        //loop through posts
        foreach( $posts_array as $post ) :
            //to get URL as String
            $src=$post->post_content;
            $content=apply_filters('the_content', get_post_field('post_content', $my_postid));

            //Thumbnail-Picture
            $thumb;
            // check if the post has a Post Thumbnail assigned to it.
            if ( has_post_thumbnail() ) {
                $thumb_id = get_post_thumbnail_id( $post);
                $thumb=wp_get_attachment_image_url($thumb_id, array('700', '600'));
                ?>

                <!-- video content -->
                <div class= "col-xs-4" style="padding-left: 0">
                    <div id="post-<?php the_ID(); ?>"  class = "video-gallery" style="cursor:pointer">
                        <div><a data-toggle="modal" data-target="#myModal<?php the_ID(); ?>"><img src="<?php echo $thumb ?> " /> </a></div>
                        <h2 class="media-capture"  ><?php the_title(); ?> </h2>
                    </div>
                </div>


                <!-- modal content -->
                <div class="modal fade" id="myModal<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close modal-close-button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="media-capture" id="myModalLabel"><?php the_title(); ?></h4>
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo $thumb; ?>" style=""/>
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
            }
        endforeach;
        ?>
    </div>
    <?php

//link to alben-page
    $musik_url = $page_link."/musik";
    ?>

    <a class="mediaLink" href=<?php echo $musik_url;?>>Mehr Musik</a>
    <?php
endif;
?>





    





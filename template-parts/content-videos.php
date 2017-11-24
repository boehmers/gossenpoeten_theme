
<?php
//filter videos and store in $posts_array
$args = array (
  'category_name' => 'videos',
  'orderby' => 'date',
  'post_type' => 'post'
);


$rowElementsCounter=0;
$filter_array=array();
$posts_array = get_posts($args);
?>
<h1 style="margin-top:0;">Videos</h1>
<?php

//check if there is content
if(!empty($posts_array)) :
  //loop through posts
  foreach( $posts_array as $post ) :

    //to get URL as String
    $src=$post->post_content;
    $content=apply_filters('the_content', get_post_field('post_content', $my_postid));

    //Thumbnail-picture
    $thumbnail ;


    // check if the post has a Post Thumbnail assigned to it.
    if ( has_post_thumbnail() ) {
      $thumbnail_id = get_post_thumbnail_id( $post);
      $thumbnail=wp_get_attachment_image_url($thumbnail_id, array('700', '600'));



    //Create new row (= 3 elements)
    if($rowElementsCounter == 0) {
      ?>
      <div class="row">
      <?php } ?>

    <!-- video-content -->
    <div class= "col-md-4">
    <div id="post-<?php the_ID(); ?>"  class = "video-gallery" style="cursor:pointer">
        <?php
        the_title( '<h2 class="entry-title" style="color: #1bb569;">','</h2>' );?>
      <div>
         <a data-toggle="modal" data-target="#myModal<?php the_ID(); ?>"><img src="<?php echo $thumbnail ?> " />  </a>
      </div>
    </div>
  </div>

  <?php
  $rowElementsCounter++ ;
  if($rowElementsCounter==3) {
      $rowElementsCounter = 0 ; ?>
    </div>
  <?php  } ?>


  <!-- modal content -->
  <div class="modal fade" id="myModal<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close modal-close-button videoModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
endforeach; endif;
?>


<script>
    jQuery('.videoModal').on('click', function(e) {
        var $if = jQuery(e.delegateTarget).parent().parent().parent().parent().find('iframe');
        var src = $if.attr("src");
        $if.attr("src", '/empty.html');
        $if.attr("src", src);
    });
</script>









<?php
require_once ('modal-video.php');
/*
Template Name: content-videos
*/ 

//filter videos and store in $posts_array

$args = array (
'category' => 'videos',
// 'orderby' => 'date',
'post_type' => 'post'
);


$rowElementsCounter=0; 
$filter_array=array(); 
$posts_array = get_posts($args); 


//print_r($posts_array); 
 //check if there is content
  if(!empty($posts_array)) : 
  //loop through posts
  foreach( $posts_array as $post ) : 


    
    //to get URL as String
  $src=$post->post_content; 
  $content=apply_filters('the_content', get_post_field('post_content', $my_postid));
//Thumbnailbild verarbeiten 
  $thumb; 

// check if the post has a Post Thumbnail assigned to it.
if ( has_post_thumbnail() ) {
  $thumb_id = get_post_thumbnail_id( $post);
  $thumb=wp_get_attachment_image_url($thumb_id, array('700', '600')); 
} 
//if there is no thumbpic use standard pic - ersetzte $thumb_id mit src
else 
{  $thumb=wp_get_attachment_image_url($thumb_id, array('700', '600')); }



  
  if($rowElementsCounter == 0) {
    
    ?>
    <div class="row">

    <?php } 
     ?>


<div class= "col-md-4">
  <div id="post-<?php the_ID(); ?>"  class = "video-gallery" style="cursor:pointer">
    <figure>
       <a data-toggle="modal" data-target="#myModal-<?php the_ID(); ?>"><img src="<?php echo $thumb ?> " /> </a>
    </figure>
    <?php  //the_date(); ?>  
    <h2 class="videoTitle"  ><?php the_title(); ?> </h2>
  </div>
</div>

<?php 
 $rowElementsCounter++ ; 
if($rowElementsCounter==3) { 
    $rowElementsCounter = 0 ; ?> 
  </div>
<?php  } ?>



    <!-- Modal -->
<div class="modal fade" id="myModal-<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


     <?php
endforeach; endif; ?>


    






<?php
 /* ****************************** VIDEO ******************************+ */


require_once ('modal-video.php');
/*
Template Name: content-videos
*/ 

//filter videos and store in $posts_array

$args = array (
'category_name' => 'videos',
'posts_per_page' => 3,
'orderby' => 'date',

);
$counter=0; 
 $posts_array = get_posts($args); 
//print_r($posts_array); 
 //check if there is content
  if(!empty($posts_array)) : ?>
<h1 class="videoTitle">Videos</h1>
  <?php
  //loop through posts
  foreach( $posts_array as $post ) : 
    // to get URL asString  
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

  
  if($counter == 0) {
    $counter++ ; 
    ?>
    <div class="row">

    <?php } ?>


<div class= "col-3">
  <article id="post-<?php the_ID(); ?>"  class = "video-gallery" style="cursor:pointer">
    <figure>
       <img onclick="openModal(<?php the_ID()?>)"  src="<?php echo $thumb ?> " /> 
    </figure>
    <?php  //the_date(); ?>  
    <h2 class="videoTitle"  ><?php the_title(); ?> </h2>
  </article>
</div>
<?php if($counter==2) { 
    $counter = 0 ; ?> 
  </div>
<?php  } ?>

    <div id = "myModal<?php the_ID()?>" class="modal">
      <span class="close"  onclick="closeModal(<?php the_ID() ?>)">&times;</span>
      <span class="modal-content" id="modal-content<?php the_ID()?>"> 
         <?php  
          echo $content; 
           ?> 
      </span> 
    </div>


     <?php
endforeach; endif; ?>



<?php  /* ****************************** Pics ******************************+ */ ?> 

    





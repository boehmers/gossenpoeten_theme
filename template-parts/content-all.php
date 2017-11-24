</br>

<h1>Bilder</h1>
<?php


global $postPictures; 

$args = array('posts_per_page' => 3, 'orderby' => 'date', 'category_name' => 'pictures'); 
$postslist = get_posts($args); 
?>
<div class = 'allGallery'>
<?php
foreach($postslist as $post): 
	setup_postdata($post); ?>

<div class = 'picGallery-item'> 

	<?php the_date(); ?> <br />
	<?php the_title(); ?>
	<?php the_content(); ?>
</div>

<?php endforeach; wp_reset_postdata(); ?> 

</div>

</br>

<h1>Videos</h1>
<?php





global $postVideos; 

$args = array('posts_per_page' => 3, 'orderby' => 'date', 'category_name' => 'Videos'); 
$postslist = get_posts($args); 

?>
<div class = 'allGallery'>
<?php


foreach($postslist as $post): 
	setup_postdata($post); ?>

<div class = 'vidGallery-item'> 

	<?php the_date(); ?> <br />
	<?php the_title(); ?>
	<?php the_content(); ?>
</div>

<?php endforeach; wp_reset_postdata(); ?> 


</div>


<?php


global $postMusic; 

$args = array('posts_per_page' => 3, 'orderby' => 'date', 'category_name' => 'Music'); 
$postslist = get_posts($args); 
foreach($postslist as $post): 
	setup_postdata($post); ?>

<div class = 'picGallery-item'> 
	<?php the_date(); ?> <br />
	<?php the_title(); ?>
	<?php the_content(); ?>
</div>

<?php endforeach; wp_reset_postdata(); ?> 







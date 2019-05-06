<?php 
/**
Template Page for the album overview (extended)

Follow variables are useable :

	$album     	 : Contain information about the album
	$galleries   : Contain all galleries inside this album
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) : ?>

<div class="photos">	
	<!-- List of galleries -->
	<?php foreach ($galleries as $gallery) : ?>

	<div class="photoblock">
		<div class="photoalbum"><a href="<?php echo $gallery->pagelink ?>"><img class="thumb" alt="<?php echo $gallery->title ?>" src="<?php echo $gallery->previewurl ?>"/></a></div>
		<div class="albumtitle"><a href="<?php echo $gallery->pagelink ?>"><?php echo $gallery->title ?></a></div>
	</div>

 	<?php endforeach; ?>
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>
 	
</div>
<div class="clear"><hr /></div>

<?php endif; ?>
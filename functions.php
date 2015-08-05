<?php
// --------------------
// Basic Setup
// --------------------
function zenSetup(){
  add_theme_support( 'title-tag' );
  // Thumbnails
  add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 480,true);
	add_image_size('smallThumb', 400, 240, true ); // For Sidebars
	add_image_size('pageThumb', 1200, 720, true ); // Image for post
  // Theme
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	));
}
// Install basic functions
add_action( 'after_setup_theme', 'zenSetup' );

// --------------------
// Thumbs more simple
// --------------------
function zenThumb($type="thumbnail",$print=true,$fallback=true){
	// $type can be "thumbnail" (Default 600x320), "smallThumb" (300x160), "pageThumb" (970x320), "altText" (descriptive text)
	// Default echo url w/support of fallback
	if ( has_post_thumbnail() ) {
		$image_id = get_post_thumbnail_id();

		if($type=="altText"){
			$theThumbnail = get_the_title($image_id);
			$theThumbnail = str_replace("-", " ", $theThumbnail);

			if($theThumbnail=="" OR is_null($theThumbnail) ){
				$theThumbnail= the_title("","", FALSE);
			}
		}
		else{
			$theThumbnail = wp_get_attachment_image_src($image_id, $type, true);
			$theThumbnail = $theThumbnail[0];
		}
	}
	else {
		if($type=="altText"){
			$theThumbnail = get_bloginfo('name');
		}
		elseif($fallback){
			$theThumbnail = get_bloginfo('stylesheet_directory' )."/img/postThumb.jpg";
		}
	}
	if($print){
		// bazedThumb($var)
		echo $theThumbnail;
	}
	else{
		// bazedThumb($var,false)
		return $theThumbnail;
	}
}
?>

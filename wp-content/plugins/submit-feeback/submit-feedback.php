<?php
/*
Plugin Name: Submit Feedback
Plugin URI: 
Description: Allows users to submit feedback.
Version: 1.0
License: GPLv2
Author: Argon Design
Author URI: http://argondesign.com.au/
*/



// Setup custom post type 'Feedback'
add_action('init', 'sf_plugin_init');
 
function sf_plugin_init(){
 
  $feedback_type_labels = array(
    'name' => _x('Feedback', 'post type general name'),
    'singular_name' => _x('Feedback', 'post type singular name'),
    'add_new' => _x('Add New Feedback', 'feedback'),
    'add_new_item' => __('Add New Feedback'),
    'edit_item' => __('Edit Feedback'),
    'new_item' => __('Add New Feedback'),
    'all_items' => __('View Feedback'),
    'view_item' => __('View Feedback'),
    'search_items' => __('Search Feedback'),
    'not_found' =>  __('No Feedback found'),
    'not_found_in_trash' => __('No Feedback found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Feedback'
	
  );
   
  $feedback_type_args = array(
    'label' => 'Feedback',
	'labels' => $feedback_type_labels,
	'description' => 'Client submitted feedback',
    'public' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
	'exclude_from_search' => true,
	'menu_icon' => 'dashicons-format-status',
    'supports' => array('title', 'editor', 'thumbnail')
  );
   
  register_post_type('feedback', $feedback_type_args);
     
}

// Add shortcode to display the form
add_shortcode('sf_form', 'sf_form_shortcode');


// Function to upload images
function insert_attachment($file_handler,$post_id,$setthumb='false') {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
	return $attach_id;
}


// Form shortcode function
function sf_form_shortcode(){
 
	if ( isset( $_POST['sf_form_create_feedback_submitted'] ) && wp_verify_nonce($_POST['sf_form_create_feedback_submitted'], 'sf_form_create_feedback') && $_POST['sf_is_human'] == '' ){
 
	  $sf_name = trim($_POST['sf_name']);
	  $sf_text = trim($_POST['sf_text']); 
	  $sf_company = trim($_POST['sf_company']); 
	  $sf_state = trim($_POST['sf_state']); 
	  $sf_file = $_FILES['sf_file'];
	 
	  if($sf_name != '' && $sf_text != '' && $sf_company != '' && $sf_state != ''){
	  
		$feedback_data = array(
		  'post_title' => $sf_name,
		  'post_content' => $sf_text,
		  'post_status' => 'pending',
		  'post_type' => 'feedback'    
		);
		
		if($feedback_id = wp_insert_post($feedback_data)){
		  echo '<div class="form-sent">Thank you for your feedback. Once approved it will be visible on our <a href="/client-feedback/">Client Feedback</a> page.</div>';
		}
		
		// Update ACF Fields
		update_field( 'field_53b87ec14dfc4', $sf_company, $feedback_id );
		update_field( 'field_53b87ef04dfc5', $sf_state, $feedback_id );
		
		// If a file was uploaded
		if ($_FILES) {
			foreach ($_FILES as $file => $array) {
				$newupload = insert_attachment($file,$feedback_id);
				set_post_thumbnail( $feedback_id , $newupload);
			}
		}
		
		// Send email notification
		$to = get_field('feedback_notification_address', 'option');
		$msg = '<p>One of your clients has added a new feedback post to your website.</p>';
		$msg .= '<p>View and approve the new content here: <a href="http://'.$_SERVER['HTTP_HOST'].'/wp-admin/post.php?post='.$feedback_id.'&action=edit">'.$sf_name.' - '.$sf_company.'</a></p>';
		$headers = 'From: Feedback <feedback@artra.com.au>' . "\r\n";
		$headers .= 'Content-type: text/html' . "\r\n";
		wp_mail($to, 'New client feedback has been created on your website', $msg, $headers );
	 
	  }else{
		//Text fields are empty
		echo '<p><span class="wpcf7-not-valid-tip">Please enter your name, company and select your state.</span></p>';   
	  }
	  
	}
	
	// Output the form
	echo sf_get_create_feedback_form();
	
}


// Create form function
function sf_get_create_feedback_form(){
  
  $out .= '<form id="feedback-form" method="post" action="" enctype="multipart/form-data">';
  $out .= '<input type="text" name="is_human" style="display:none" />';
  $out .= wp_nonce_field('sf_form_create_feedback', 'sf_form_create_feedback_submitted');
  $out .= '<div class="form-item">';
  $out .= '<label for="sf_name">Name<span class="required">*</span></label>';
  $out .= '<input type="text" id="sf_name" name="sf_name" value="" required/>';
  $out .= '</div>';
  $out .= '<div class="form-item">';
  $out .= '<label for="sf_company">Company<span class="required">*</span></label>';
  $out .= '<input type="text" id="sf_company" name="sf_company" value="" required/>';
  $out .= '</div>';
  $out .= '<div class="form-item">';
  $out .= '<label for="sf_state">State<span class="required">*</span></label>';
  $out .= '<select name="sf_state" required><option></option><option value="ACT">Australian Capital Territory</option><option value="NSW">New South Wales</option><option value="NT ">Northern Territory</option><option value="QLD">Queensland</option><option value="SA ">South Australia</option><option value="TAS">Tasmania</option><option value="VIC">Victoria</option><option value="WA ">Western Australia</option></select>';
  $out .= '</div>';
  $out .= '<div class="form-item">';
  $out .= '<label for="sf_file">Logo</label>';         
  $out .= '<input type="file" name="sf_file" accept="image/*"> ';    
  $out .= '</div>'; 
  $out .= '<div class="form-item">';
  $out .= '<label for="sf_text">Feedback<span class="required">*</span></label>';         
  $out .= '<textarea id="sf_text" name="sf_text" required /></textarea>';    
  $out .= '</div>';     
  $out .= '<div class="form-submit">';
  $out .= '<input type="submit" id="sf_submit" name="sf_submit" value="Submit Feedback">';
  $out .= '</div>';
  $out .= '</form>';
 
  return $out;
   
}
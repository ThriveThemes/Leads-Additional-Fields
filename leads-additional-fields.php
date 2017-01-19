<?php
/*
Plugin Name: Leads Additional Fields
Plugin URI: http://www.thrivethemes.com
Description: An example plugin demonstrating how you can interact with Thrive Leads to create dynamic forms
Author: Thrive Team
Version: 0.01

This plugin is an example of how you can use filters and shortcodes to create dynamic web forms with
Thrive Leads and Thrive Content Builder

You can use the examples below to generate your own dynamic information that you want to send to your autoresponder,
whether that be tracking data, cookie data or anything else you would like to appear.

Docs here:- http://thrivethemes.com/?post_type=tkb_item&p=61122
*/


/**
 * Filter Example 1 - Attach to every form in TCB and Leads
 *
 * @param $lead_group     - (WP Post Object) Lead Group content type
 * @param $form_type      - (WP Post Object) Form Type content type
 * @param $form_variation - (Array) Form variation data
 *
 * @return string - additional dynamic code to appear before </form> tag
 */
function leads_additional_fields_ex1( $additional_content, $lead_group, $form_type, $form_variation ) {
	return $additional_content . "<input type='hidden' name='additional_leads_field_ex1' value='success'>";
}

add_filter( "tve_additional_fields", "leads_additional_fields_ex1", 10, 4 );


/**
 * Filter Example 2 - Only apply logic to a lead group with a particular name
 *
 * @param $additional_content - Might be empty or string added bug other filters before
 * @param $lead_group         - (WP Post Object) Lead Group content type
 * @param $form_type          - (WP Post Object) Form Type content type
 * @param $form_variation     - (Array) Form variation data
 *
 * @return string - additional dynamic code to appear before </form> tag
 */
function leads_additional_fields_ex2( $additional_content, $lead_group, $form_type, $form_variation ) {

	if ( empty( $lead_group ) ) {
		return $additional_content;
	}

	$my_group_name = 'My Group 1';

	if ( is_object( $lead_group ) && $lead_group->post_title === $my_group_name ) {
		return $additional_content . '<input type="hidden" name="additional_leads_field_ex2" value="success">';
	}

	return $additional_content;
}

add_filter( 'tve_additional_fields', 'leads_additional_fields_ex2', 10, 4 );


/**
 * Filter Example 3 - Only apply logic to a lead group with a particular name and an individual form type
 *
 * @param $additional_content - Might be empty or string added bug other filters before
 * @param $lead_group         - (WP Post Object) Lead Group content type
 * @param $form_type          - (WP Post Object) Form Type content type
 * @param $form_variation     - (Array) Form variation data
 *
 * @return string - additional dynamic code to appear before </form> tag
 */
function leads_additional_fields_ex3( $additional_content, $lead_group, $form_type, $form_variation ) {
	if ( empty( $lead_group ) || empty( $lead_group ) ) {
		return $additional_content;
	}

	$my_group_name        = 'My Group 1';
	$particular_form_type = 'Ribbon';
//    $particular_form_type = 'Lightbox';
//    $particular_form_type = 'Widget';
//    $particular_form_type = 'Post Footer';
//    $particular_form_type = 'Slide in';
//    $particular_form_type = 'In content';

	if ( is_object( $lead_group ) && $lead_group->post_title === $my_group_name && is_object( $form_type ) && $form_type->post_title === $particular_form_type ) {
		return $additional_content . '<input type="hidden" name="additional_leads_field_ex3" value="success">';
	}

	return $additional_content;
}

add_filter( "tve_additional_fields", "leads_additional_fields_ex3", 10, 4 );

/**
 * Shortcode example 1 - return entire hidden input
 *
 * Use this shortcode to return a dynamic code (perhaps additional fields) or tracking pixesl
 * Useage: [tve_fields_shortcode]
 */
function leads_fields() {
	return '<input type="hidden" name="additional_leads_field" value="success">';
}

add_shortcode( 'tve_fields_shortcode', 'leads_fields' );

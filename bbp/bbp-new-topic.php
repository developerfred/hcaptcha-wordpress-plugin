<?php
/**
 * BBPress new topic form file.
 *
 * @package hcaptcha-wp
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * BBPress new topic form.
 */
function hcap_display_bbp_new_topic() {
	hcap_form_display();
	wp_nonce_field( 'hcaptcha_bbp_new_topic', 'hcaptcha_bbp_new_topic_nonce' );
}

add_action( 'bbp_theme_after_topic_form_content', 'hcap_display_bbp_new_topic', 10, 0 );

/**
 * Verify BBPress new topic captcha.
 *
 * @return bool
 */
function hcap_verify_bbp_new_topic_captcha() {
	$error_message = hcaptcha_get_verify_message(
		'hcaptcha_bbp_new_topic_nonce',
		'hcaptcha_bbp_new_topic'
	);
	if ( null === $error_message ) {
		return true;
	}

	bbp_add_error( 'hcap_error', $error_message );

	return false;
}

add_action( 'bbp_new_topic_pre_extras', 'hcap_verify_bbp_new_topic_captcha' );

<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Elegant_Pink_Pro
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://raratheme.com', // Site where EDD is hosted
		'item_name'      => 'Travel Agency Pro', // Name of theme
		'theme_slug'     => 'travel-agency-pro', // Theme slug
		'version'        => '2.0.8', // The current version of this theme
		'author'         => 'Rara Theme', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'travel-agency-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'travel-agency-pro' ),
		'license-key'               => __( 'License Key', 'travel-agency-pro' ),
		'license-action'            => __( 'License Action', 'travel-agency-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'travel-agency-pro' ),
		'activate-license'          => __( 'Activate License', 'travel-agency-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'travel-agency-pro' ),
		'renew'                     => __( 'Renew?', 'travel-agency-pro' ),
		'unlimited'                 => __( 'unlimited', 'travel-agency-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'travel-agency-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'travel-agency-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'travel-agency-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'travel-agency-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'travel-agency-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'travel-agency-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'travel-agency-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'travel-agency-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'travel-agency-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'travel-agency-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'travel-agency-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'travel-agency-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'travel-agency-pro' ),
	)

);
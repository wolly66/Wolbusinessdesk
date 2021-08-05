<?php
/**
 * Template loader for PW Sample Plugin.
 *
 * Only need to specify class properties here.
 *
 */
 
 namespace Wolbusinessdesk\Includes;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}
	
class Template_Loader extends Abstracts\Wol_Template_Loader {

	/**
	 * Prefix for filter names.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $filter_prefix = 'wol';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $theme_template_directory = 'wolbusinessdesk-templates';

	/**
	 * Reference to the root directory path of this plugin.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $plugin_directory = WOLBUSINESSDESK_PLUGIN_PATH;

}
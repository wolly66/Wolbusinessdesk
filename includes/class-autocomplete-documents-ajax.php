<?php
/**
 * Function ajax class
 *
 * @package    Wpit The Cooking Hacks
 * @since      1.0.0
 */

/**
 * Class Wpit_Ajax_Calls
 */
class Wolbusinessdesk_Autocomplete_Documents {

	/**
	 * A static member variable representing the class instance
	 *
	 * @var null
	 */
	private static $_instance = NULL;

	/**
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 */
	private function __construct() {

		/** Set ajax actions */

		// Example test action
		add_action( 'wp_ajax_call_test', array( $this, 'call_test' ) );

		add_action( 'wp_ajax_relationship_autocomplete', array(
			$this,
			'relationship_autocomplete'
		) );
		
		add_action( 'wp_ajax_nopriv_relationship_autocomplete', array(
			$this,
			'relationship_autocomplete'
		) );


		add_action( 'wp_ajax_delete_relationship', array(
			$this,
			'delete_relationship'
		) );
		
		add_action( 'wp_ajax_nopriv_delete_relationship', array(
			$this,
			'delete_relationship'
		) );



	}

	/**
	 * Prevent any object or instance of that class to be cloned
	 *
	 */
	public function __clone() {

		trigger_error( "Cannot clone instance of Singleton pattern ...", E_USER_ERROR );

		return;
	}

	/**
	 * Prevent any object or instance to be deserialized
	 *
	 * @return null
	 */
	public function __wakeup() {

		trigger_error( 'Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );

		return;
	}

	/**
	 * Have a single globally accessible static method
	 *
	 * @param array $args
	 *
	 * @return null|Wpit_Tch_Admin_Ajax_Calls instance
	 */
	public static function getInstance() {
		if ( ! is_object( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * action_name example function
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 * @return
	 */
	public function call_test() {

		$test_data = [
			[
				'id'    => 1,
				'label' => "c++",
				'value' => "c++",
			],
			[
				'id'    => 2,
				'label' => "java",
				'value' => "java",
			],
			[
				'id'    => 3,
				'label' => "php",
				'value' => "php",
			],
			[
				'id'    => 4,
				'label' => "python",
				'value' => "python",
			],
			[
				'id'    => 5,
				'label' => "javascript",
				'value' => "javascript",
			],
			[
				'id'    => 6,
				'label' => "asp",
				'value' => "asp",
			],
			[
				'id'    => 7,
				'label' => "ruby",
				'value' => "ruby",
			],
		];

		wp_send_json_success( $test_data );
		exit;

	}

	/**
	 * Get data from tutorial for autocomplete
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 * @return
	 */
	public function relationship_autocomplete() {

		$results = array();
		$post_type = $_REQUEST['method'];

		global $wpdb;

		$query = $wpdb->get_results( "
			SELECT
				p.ID,
				p.post_title
			FROM
				$wpdb->posts AS p
			WHERE
				p.post_type = '{$post_type}'
				AND p.post_title LIKE '%{$_REQUEST['term']}%'
				AND p.post_status = 'publish'
			ORDER BY
				p.post_title ASC
			LIMIT 25;
				 
		" );

		foreach ( $query as $item ) {

			$results[] = array(
				'id'    => $item->ID,
				'label' => "$item->post_title",
				'value' => "$item->post_title",
			);

		}

		wp_send_json_success( $results );
		exit;

	}

	/**
	 * Delete a relationship by it's ID
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param
	 *
	 * @return
	 */
	public function delete_relationship() {

		$rel_id = $_REQUEST['rel_id'];
		
		$all_data = wolbusinessdesk()->relationship->get( $rel_id );
		
		$result   = wolbusinessdesk()->relationship->delete( $rel_id );

		if ( FALSE == $result ) {

			$response = array(
				'status'  => 'ko',
				'message' => __( 'Error deleting the relationship', 'wpit_tch' )
			);

			wp_send_json_error( $response );
			exit;

		}  else {

		$response = array(
			'status'  => 'ok',
			'message' => __( 'Relationship deleted', 'wpit_tch' )
		);

		wp_send_json_success( $response );
		exit;
		}
	}

}

// Instantiate all the radio buttons metabox needed
Wolbusinessdesk_Autocomplete_Documents::getInstance();
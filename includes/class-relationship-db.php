<?php

namespace Wolbusinessdesk\Includes;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}
	
//if ( ! class_exists('Wol_Db' ) ){
//	
//	require_once WOLBUSINESSDESK_PLUGIN_PATH . 'abstracts\class-wol-db.php';
//}
	
	
	if ( ! class_exists( 'Relationship_Db' ) ){
		
		/**
		 * Database class to manage measure units table and method
		 *
		 * @package    Wpit The Cooking Hacks
		 * @since      1.0.0
		 */
		class Relationship_Db extends abstracts\Wol_Db {
		
		   /**
		    * The table name for this special DB table
		    *
		    * @access private
		    * @since  1.0
		    * @var    string
		    */
		   public $table_name;
		
		   /**
		    * The primary key for the special table
		    *
		    * @access private
		    * @since  1.0
		    * @var    string
		    */
		   public $primary_key;
		
		   /**
		    * The version number of the table structure
		    *
		    * @access private
		    * @since  1.0
		    * @var    string
		    */
		   public $version;
		
		   /**
		    * Get things started
		    *
		    * @access  public
		    * @since   1.0
		    */
		   public function __construct() {
		   
		   	global $wpdb;
		
		   	$this->table_name  = $wpdb->prefix . 'relationships';
		   	$this->primary_key = 'ID';
		   	$this->version     = '1.0.0';
		
		   	// Check for update table schema
		   	add_action( 'init', array( $this, 'update_check' ) );
		   	// Register the table
		   	//add_action( 'plugins_loaded', array( $this, 'register_table' ) );
		
		   }

		   /**
		    * Return the option name with the DB version for the timeslot tables
		    *
		    * @since  1.0.0
		    * @access public
		    *
		    * @return string the name of the option vith version db table
		    */
		   public function get_option_name_table_ver() {
		   
		   	return get_option( 'wol-' . $this->table_name . '-db-ver', 0 );
		   
		   }
		   
		   /**
		    * Get columns and formats
		    *
		    * @access  public
		    * @since   1.0
		    */
		   public function get_columns() {
		   	return array(
		   		'ID'            => '%d',
		   		'relation_type' => '%s',
		   		'from_id'       => '%d',
		   		'to_id'         => '%d',
		   	);
		   }
		   
		   /**
		    * Get default column values
		    *
		    * @access  public
		    * @since   1.0
		    */
		   public function get_column_defaults() {
		   	return array(
		   		'ID'            => '0',
		   		'relation_type' => '',
		   		'from_id'       => '',
		   		'to_id'         => '',
		   	);
		   }

		   /**
		    * update_UTILITY_check function.
		    *
		    * @access public
		    * @return void
		    */
		   public function update_check() {
		   	
		   	// Do checks only in backend
		   	if ( is_admin() ) {
		   
		   		// Check if DB is UPDATED
		   		if ( version_compare( $this->get_option_name_table_ver(), $this->version ) != 0 ) {
		   
		   			$this->create_db_table();
		   
		   		}
		   	}
		   }
		   
		   /**
		    * Registers the table with $wpdb to make use easy.
		    *
		    * @access public
		    * @since  1.0
		    *
		    * @global wpdb $wpdb WordPress database abstraction object.
		    */
		   public function register_table() {
		   
		   	global $wpdb;
		   
		   	//register the new table with the wpdb object
		   	if ( ! isset( $wpdb->um_conversion ) ) {
		   		$wpdb->um_conversion = $this->table_name;
		   		//add the shortcut so you can use $wpdb->stats
		   		$wpdb->tables[] = str_replace( $wpdb->prefix, '', $this->table_name );
		   	}
		   }

		   /**
		    * Create the table
		    *
		    * @access  public
		    * @since   1.0
		    */
		   public function create_db_table() {
		   
		   	global $wpdb;
		   
		   	/**
		   	 * The database character collate.
		   	 */
		   	$charset_collate = $wpdb->get_charset_collate();
		   
		   	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		   
		   	$sql = "CREATE TABLE " . $this->table_name . " (
		   	ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		   	relation_type varchar(64) NOT NULL,
		   	from_id bigint(20) unsigned NOT NULL,
		   	to_id bigint(20) unsigned NOT NULL,
		   	PRIMARY KEY  (ID),
		   	UNIQUE KEY type_from_to (relation_type,from_id,to_id)
		   	) $charset_collate";
		   
		   	dbDelta( $sql );
		   
		   	update_option( 'wol-' . $this->table_name . '-db-ver', $this->version );
		   }

		   /**
		    * Set a relationship between two CPT or other elements
		    *
		    * @param array $args {
		    *     Array of insert data arguments
		    *
		    *     @type string $from    the CPT slug of the from side of the relationship
		    *     @type string $to      the CPT slug of the to side of the relationship
		    *     @type int    $from_id the ID of the from CPT
		    *     @type int    $to_id   the ID of the to CPT
		    * }
		    *
		    * @return bool|int|WP_Error WP_Error if parameters are incorrect, false on
		    *                           insert error or the ID of the inserted record
		    */
		   public function set_relationship ( $args = array() ) {
		   
		   	$defaults = array(
		   		'from'    => '',
		   		'to'      => '',
		   		'from_id' => 0,
		   		'to_id'   => 0,
		   	);
		   
		   	$args = wp_parse_args( $args, $defaults );
		   
		   	// Check if passed values exists and are correct
		   	if ( '' === $args['from'] || ! post_type_exists( $args['from'] ) ) {
		   
		   		return new WP_Error( 'no_from', __( 'The from CPT doesn\'t exist', 'wolbusinessdesk' ) );
		   
		   	} elseif ( '' === $args['to'] || ! post_type_exists( $args['to'] ) ) {
		   
		   		return new WP_Error( 'no_to', __( 'The to CPT doesn\'t exist', 'wolbusinessdesk' ) );
		   
		   	} elseif ( 0 === $args['from'] || 0 === $args['to'] ) {
		   
		   		new WP_Error( 'no_ids', __( 'Missing the from_id or the to_id', 'wolbusinessdesk' ) );
		   
		   	}
		   
		   	// Create the relationship
		   	$relation_type = $args['from'] . '_' . $args['to'];
		   
		   	// Prepare the data to insert
		   	$insert_data = array(
		   		'relation_type' => $relation_type,
		   		'from_id'       => $args['from_id'],
		   		'to_id'         => $args['to_id']
		   	);
		   
		   	// Insert the data
		   	$result = self::insert( $insert_data, 'relationship');
		   
		   	// Return the insert data result
		   	return $result;
		   
		   }

			/**
			 * Get related CTPs IDs or a count of them for a specific relationship for
			 * the given CPT ID
			 *
			 * @param array $args {
			 *     Array of insert data arguments
			 *
			 *     @type string $from    the CPT slug of the from side of the relationship
			 *     @type string $to      the CPT slug of the to side of the relationship
			 *     @type int $from_id    the ID to search fro the relationships
			 *     @type int $to_id      the ID to search fro the relationships alternative
			 *                           to he from_id if missing
			 *     @type string $orderby the column to use for ORDERBY clause
			 *     @type string $order   how to order the data ASC or DESC
			 * }
			 *
			 * @param bool  $count
			 *
			 * @return array|int|null|object|WP_Error WP_Error if parameters are incorrect,
			 *                                        null if not found, the number of
			 *                                        elements found on count or an array
			 *                                        of CPT ID related to the from ID
			 */
			public function get_related_cpt ( $args = array(), $count = FALSE ) {
		
				global $wpdb;
		
				$defaults = array(
					'from'    => '',
					'to'      => '',
					'from_id' => 0,
					'to_id' => 0,
					'orderby' => 'ID',
					'order'   => 'ASC',
				);
		
				$args = wp_parse_args( $args, $defaults );
		
				// Check if passed values exists and are correct
				if ( '' === $args['from'] || ! post_type_exists( $args['from'] ) ) {
		
					return new WP_Error( 'no_from', __( 'The from CPT doesn\'t exist', 'wolbusinessdesk' ) );
		
				} elseif ( '' === $args['to'] || ! post_type_exists( $args['to'] ) ) {
		
					return new WP_Error( 'no_to', __( 'The to CPT doesn\'t exist', 'wolbusinessdesk' ) );
		
				} elseif ( 0 === $args['from_id'] && 0 === $args['to_id'] ) {
		
					new WP_Error( 'no_id', __( 'Missing the from_id or the to_id, one is needed ', 'wolbusinessdesk' ) );
		
				}
		
				// Create the relationship
				$relation_type = $args['from'] . '_' . $args['to'];
		
				$where          = '';
				$extract_column = '';
		
				// specific referrals
				if ( 0 != $args['from_id'] ) {
					$where .= "WHERE `relation_type` = '{$relation_type}' AND `from_id` = {$args['from_id']}";
					$extract_column = 'ID, to_id';
				} elseif ( 0 != $args['to_id'] ) {
					$where .= "WHERE `relation_type` = '{$relation_type}' AND `to_id` = {$args['to_id']}";
					$extract_column = 'ID, from_id';
				}
		
				
				$args['orderby'] = ! array_key_exists( $args['orderby'], $this->get_columns() ) ? $this->primary_key : $args['orderby'];
		
				if ( TRUE === $count ) {
		
					$results = absint( $wpdb->get_var( "SELECT COUNT({$this->primary_key}) FROM {$this->table_name} {$where};" ) );
		
				} else {
					
					$query = "SELECT {$extract_column} FROM {$this->table_name} {$where} ORDER BY {$args['orderby']} {$args['order']}";
					
					
					$results = $wpdb->get_results( $query, ARRAY_A);
		
				}
		
				return $results;
		
			}
		
			/**
			 * Get the count of related CTPs for a specific relationship and a given CPT ID
			 *
			 * @param array $args    {
			 *     Array of insert data arguments
			 *
			 *     @type string $from    the CPT slug of the from side of the relationship
			 *     @type string $to      the CPT slug of the to side of the relationship
			 *     @type int    $from_id the ID to search fro the relationships
			 *     @type int    $to_id   the ID to search fro the relationships alternative
			 *                           to he from_id if missing
			 *     @type string $orderby the column to use for ORDERBY clause
			 *     @type string $order   how to order the data ASC or DESC
			 * }
			 *
			 * @return array|int|null|object|WP_Error WP_Error if parameters are incorrect,
			 *                                        null if not found, the number of
			 *                                        elements found on count or an array
			 *                                        of CPT ID related to the from ID
			 */
			public function get_related_cpt_cnt( $args = array() ) {
				return $this->get_related_cpt( $args, TRUE );
			}
		
			/**
			 * Get all related CTPs IDs for all the relationship for the given CPT ID
			 *
			 * @param array $args {
			 *     Array of select data arguments
			 *
			 *     @type int    $from_id the ID to search fro the relationships
			 *     @type int    $to_id   the ID to search fro the relationships alternative
			 *                           to he from_id if missing
			 * }
			 *
			 * @return array|int|null|object|WP_Error WP_Error if parameters are incorrect,
			 *                                        null if not found, the number of
			 *                                        elements found on count or an associative
			 *                                        array of the relationship with the related
			 *                                        CPTs IDs
			 */
			public function get_all_relationship ( $args = array() ) {
		
				global $wpdb;
		
				$defaults = array(
					'from_id' => 0,
					'to_id'   => 0,
				);
		
				$args = wp_parse_args( $args, $defaults );
		
				// Check if passed values exists and are correct
				if ( 0 === $args['from_id'] && 0 === $args['to_id'] ) {
		
					new WP_Error( 'no_id', __( 'Missing the from_id or the to_id, one is needed ', 'wolbusinessdesk' ) );
		
				}
		
				$where          = '';
				$order_column = '';
		
				// define where
				if ( 0 != $args['from_id'] ) {
					$where .= "WHERE `from_id` = {$args['from_id']}";
					$order_column = 'to_id';
				} elseif ( 0 != $args['to_id'] ) {
					$where .= "WHERE `to_id` = {$args['to_id']}";
					$order_column = 'from_id';
				}
		
				$results = array();
		
				$datas = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM {$this->table_name} {$where} ORDER BY `relation_type` ASC, {$order_column} ASC",
							array()
						),
						ARRAY_N
					);
		
				if ( empty( $datas ) ) {
					return $results;
				}
		
				foreach ( $datas as $data ) {
					$results[ $data['relation_type'] ][] = $data[ $order_column ];
				}
		
				return $results;
		
			}
		
			/**
			 * Delete a relationship for the given CPTs IDs from e to
			 *
			 * @param array $args    {
			 *                       Array of insert data arguments
			 *
			 * @type string $from    the CPT slug of the from side of the relationship
			 * @type string $to      the CPT slug of the to side of the relationship
			 * @type int    $from_id the ID of from to delete
			 * @type int    $to_id   the ID of to to delete
			 * }
			 *
			 * @return int|boolean|WP_Error WP_Error if parameters are incorrect, false
			 *                              on error or the number fo row deleted
			 */
			public function delete_relationship( $args = array() ) {
		
				global $wpdb;
		
				$defaults = array(
					'from'    => '',
					'to'      => '',
					'from_id' => 0,
					'to_id'   => 0,
				);
		
				$args = wp_parse_args( $args, $defaults );
		
				// Check if passed values exists and are correct
				if ( '' === $args['from'] || ! post_type_exists( $args['from'] ) ) {
		
					return new WP_Error( 'no_from', __( 'The from CPT doesn\'t exist', 'wolbusinessdesk' ) );
		
				} elseif ( '' === $args['to'] || ! post_type_exists( $args['to'] ) ) {
		
					return new WP_Error( 'no_to', __( 'The to CPT doesn\'t exist', 'wolbusinessdesk' ) );
		
				} elseif ( 0 === $args['from_id'] || 0 === $args['to_id'] ) {
		
					new WP_Error( 'no_id', __( 'Missing the from_id or the to_id, both are needed ', 'wolbusinessdesk' ) );
		
				}
		
				// Create the relationship
				$relation_type = $args['from'] . '_' . $args['to'];
		
				$where = array(
					'relation_type' => $relation_type,
					'from_id'       => $args['from_id'],
					'to_id'         => $args['to_id'],
				);
		
				$where_format = array(
					'%s',
					'%d',
					'%d',
				);
		
		
				$results = $wpdb->delete( $this->table_name, $where, $where_format );
				 
				
				return $results;
		
			}
		
			//TODO: sistemare commenti
			/**
			 * Create the code to be inserted into a metabox for creating a single relationship
			 *
			 * @param array $args    {
			 *                       Array of insert data arguments
			 *
			 * @type string $from    the CPT slug of the from side of the relationship
			 * @type string $to      the CPT slug of the to side of the relationship
			 * @type int    $from_id the ID of from to delete
			 * @type int    $to_id   the ID of to to delete
			 * }
			 *
			 * @return string|WP_Error the HTML code for the metabox or WP error
			 *
			 */
			public function generate_single_relationship_code( $args = array() ) {
		
				$html = '';
		
				$defaults = array(
					'to'    => '',
					'label' => '',
					'title' => '',
				);
		
		
				$args = wp_parse_args( $args, $defaults );
		
				// Check if passed values exists and are correct
				if ( '' === $args['to'] || ! post_type_exists( $args['to'] ) ) {
		
					return new WP_Error( 'no_to', __( "The to CPT doesn't exist", 'wolbusinessdesk' ) );
		
				}
		
				$relationship = array();
				if ( is_admin(  ) ){
					
					if ( isset ( $_GET['post'] ) ) {
		
						// Check if there is a relationship of this type
		
						$get_rel_args = array(
							'from'    => get_post_type( $_GET['post'] ),
							'to'      => $args['to'],
							'from_id' => $_GET['post'],
						);
		
						$relationship = $this->get_related_cpt( $get_rel_args );
		
					}
					
					} else {
						
						$get_rel_args = array(
							'from'    => get_post_type( get_the_id( ) ),
							'to'      => $args['to'],
							'from_id' => get_the_id( ),
						);
		
						$relationship = $this->get_related_cpt( $get_rel_args );
						
						
					}
		
				if ( ! empty( $relationship ) ) {
		
					$html .= '
						<table class="form-table existing-relationship">
							<tbody>';
		
					foreach ( $relationship as $item ) {
		
						$post_title = get_the_title( $item['to_id'] );
						$post_link  = get_edit_post_link( $item['to_id'] );
						$rel_id     = $item['ID'];
						$label = sprintf(
							__( 'Existing %1$s name', 'wolbusinessdesk' ),
							$args['label']
						);
		
						$html .= sprintf( '
								<tr>
									<th scope="row">
										<label for="rel_%4$s_title">%5$s:</label>
									</th>
									<td>
									<a href="%1$s" target="_blank" data>%2$s</a><span class="dashicons dashicons-no delete_single_relationship" data-rel_id="%3$s"></span>
									</td>
								</tr>',
							$post_link, // 1
							$post_title, // 2
							$rel_id, //3
							$args['label'], // 4
							$label
		
						);
		
					}
		
					$html .= '
							</tbody>
						</table>';
		
					$html .= sprintf( '
						<table class="form-table new-relationship" hidden>
							<tbody>
								<tr>
									<th scope="row">
										<label for="rel_%1$s_title">%2$s:</label>
		 	                        </th>
									<td>',
						$args['to'],
						sprintf( __( '%1$s name', 'wolbusinessdesk' ), $args['title'] )
					);
		
		
					$html .= sprintf( '
					<input type="text" name="rel_%1$s[title]" id="rel_%1$s_title" value="" class="regular-text wol-relationships" data-method="%1$s" data-elem_id="rel_%1$s_id" >
					<input type="text" name="rel_%1$s[to_id]" id="rel_%1$s_id" value="" class="small-text" readonly>
					<input type="hidden" name="rel_%1$s[to]" id="rel_%1$s_to" value="%1$s" >',
						$args['to']
					);
		
					$html .= '
									</td>
								</tr>
							</tbody>
						</table>';
		
		
				} else {
		
					$html .= sprintf( '
						<table class="form-table new-relationship">
							<tbody>
								<tr>
									<th scope="row">
										<label for="rel_%1$s_title">%2$s:</label>
		 	                        </th>
									<td>',
						$args['to'],
						sprintf( __( '%1$s name', 'wolbusinessdesk' ), $args['title'] )
					);
		
		
					$html .= sprintf( '
					<input type="text" name="rel_%1$s[title]" id="rel_%1$s_title" value="" class="regular-text wol-relationships" data-method="%1$s" data-elem_id="rel_%1$s_id" >
					<input type="text" name="rel_%1$s[to_id]" id="rel_%1$s_id" value="" class="small-text" readonly>
					<input type="hidden" name="rel_%1$s[to]" id="rel_%1$s_to" value="%1$s" >',
						$args['to']
					);
		
					$html .= '
									</td>
								</tr>
							</tbody>
						</table>';
		
				}
		
				return $html;
		
			}
		
			//TODO: sistemare commenti
			/**
			 * Create the code to be inserted into a metabox for creating a multiple relationships
			 *
			 * @param array $args    {
			 *                       Array of insert data arguments
			 *
			 * @type string $from    the CPT slug of the from side of the relationship
			 * @type string $to      the CPT slug of the to side of the relationship
			 * @type int    $from_id the ID of from to delete
			 * @type int    $to_id   the ID of to to delete
			 * }
			 *
			 * @return string|WP_Error the HTML code for the metabox or WP error
			 *
			 */
			public function generate_multi_relationship_code( $args = array() ) {
		
				global $wpdb;
		
				$html = '';
		
				$defaults = array(
					'to'    => '',
					'label' => '',
					'title' => '',
				);
		
				$args = wp_parse_args( $args, $defaults );
		
				// Check if passed values exists and are correct
				if ( '' === $args['to'] || ! post_type_exists( $args['to'] ) ) {
		
					return new WP_Error( 'no_to', __( "The to CPT doesn't exist", 'wolbusinessdesk' ) );
		
				}
		
				$relationship = array();
		
				if ( isset ( $_GET['post'] ) ) {
		
					// Check if there is a relationship of this type
		
					$get_rel_args = array(
						'from'    => get_post_type( $_GET['post'] ),
						'to'      => $args['to'],
						'from_id' => $_GET['post'],
					);
		
					$relationship = $this->get_related_cpt( $get_rel_args );
		
				}
		
				if ( ! empty( $relationship ) ) {
		
					$html .= '
						<table class="form-table existing-relationship">
							<tbody>';
		
					foreach ( $relationship as $item ) {
		
						$post_title = get_the_title( $item['to_id'] );
						$post_link  = get_edit_post_link( $item['to_id'] );
						$post_id    = $item['to_id'];
						$rel_id     = $item['ID'];
		
						$html .= sprintf( '
								<tr>
									<th scope="row">
										<label for="recipe_rel_%4$s_title">' .
						                sprintf(
						                	__( 'Existing %1$s name', 'wolbusinessdesk' ),
											$args['label']
							            )
						                . ':</label>
									</th>
									<td>
									<a href="%1$s" target="_blank" data>%2$s</a><span class="dashicons dashicons-no delete_multi_relationship" data-rel_id="%3$s"></span>
									</td>
								</tr>',
							$post_link, // 1
							$post_title, // 2
							$rel_id, // 3
							$args['label'] // 4
		
						);
		
					}
		
					$html .= '
							</tbody>
						</table>';
		
				}
		
				$html .= sprintf( '
					<table class="form-table new-relationship">
						<tbody>
							<tr>
								<th scope="row">
									<label for="rel_%1$s_title">%2$s:</label>
		                        </th>
								<td>',
					$args['to'],
					sprintf( __( 'New %1$s name', 'wolbusinessdesk' ), $args['label'] )
				);
		
		
				$html .= sprintf( '
				<input type="text" name="rel_%1$s_title[]" id="rel_%1$s_title" value="" class="regular-text wol-relationships to_reset" data-method="%1$s" data-elem_id="rel_%1$s_id" >
				<input type="text" name="rel_%1$s_id[]" id="rel_%1$s_id" value="" class="small-text to_reset" readonly>
				<input type="hidden" name="rel_%1$s_to[]" id="rel_%1$s_to" value="%1$s" >
				<span class="dashicons dashicons-plus add_new_relationship" style="padding-top:7px;"></span>
				<span class="dashicons dashicons-no delete_new_relationship" style="padding-top:7px; display: none;" ></span>',
					$args['to']
				);
		
				$html .= '
								</td>
							</tr>
						</tbody>
					</table>';
		
				return $html;
		
			}
		
		}

	} //END IF ! CLASS EXISTS



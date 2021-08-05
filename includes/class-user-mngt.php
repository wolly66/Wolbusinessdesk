<?php
	
namespace Wolbusinessdesk\Includes;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}

if ( ! class_exists( 'User_Mngt' ) ){
	
	
	class User_Mngt{
		
		
		public function __construct(){
			
			add_action( 'show_user_profile', array( 
					$this, 
					'promote_to_agent' 
				) );
				
				add_action( 'edit_user_profile', array( 
					$this, 
					'promote_to_agent' 
				) );
				
				add_action( 'personal_options_update', array( 
					$this, 
					'save_custom_user_profile_fields' 
				) );
				
				add_action( 'edit_user_profile_update', array( 
					$this, 
					'save_custom_user_profile_fields' 
				) );
				
		}
	
		public function promote_to_agent( $user ){
		
			if ( is_wol_user_creator() ) {
			
				$is_agent = is_wol_agent( $user );
				
				$is_super_agent = is_wol_super_agent( $user );	
					
		
			?>
			
		
			<h2><?php _e( 'Agents', 'wolbusinessdesk' ); ?></h2>
			
			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<?php _e( 'This user can assign Agent to ticket', 'wolbusinessdesk' ); ?>
						</th>
						<td>
							<input type="checkbox" name="wol_can_assign_owner" value="1" <?php checked( $is_super_agent, 1 ); ?> /> <?php _e( 'Check this if he/she can assign Agent to ticket', 'wolbusinessdesk' ); ?>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e( 'This user is an Agent', 'wolbusinessdesk' ); ?>
						</th>
						<td>
							<input type="checkbox" name="wol_can_own_ticket" value="1" <?php checked( $is_agent, 1 ); ?> /> <?php _e( 'Check this if he/she is an Agent', 'wolbusinessdesk' ); ?>
						</td>
					</tr>
		
				</tbody>
			</table>
			<?php	}
		
		}
	
		public function save_custom_user_profile_fields( $user_id ) {
				
			if ( isset( $_POST['wol_can_assign_owner'] ) && 1 == $_POST['wol_can_assign_owner'] ) {
				
				//to add capability to user
				$user = new WP_User( $user_id );
				$user->add_cap( 'wol_can_assign_owner' );
		
			} else {
		
				//to remove capability from user
				$user = new WP_User( $user_id );
				$user->remove_cap( 'wol_can_assign_owner');
			}
		
			if ( isset( $_POST['wol_can_own_ticket'] ) && 1 == $_POST['wol_can_own_ticket'] ) {
				
				//to add capability to user
				$user = new WP_User( $user_id );
				$user->add_cap( 'wol_can_own_ticket' );
		
			} else {
		
				//to remove capability from user
				$user = new WP_User( $user_id );
				$user->remove_cap( 'wol_can_own_ticket');
			}
		}
	
	}

	
}
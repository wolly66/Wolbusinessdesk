<?php

namespace Wolbusinessdesk\Includes;
use function Wolbusinessdesk\wol;
 
	// If this file is accessed directory, then abort.
	if ( ! defined( 'WPINC' ) ) {
	    die;
	}
	
if ( ! class_exists( 'Custom_Nav_Menus' ) ){	
	
	class Custom_Nav_Menus{
		
		
		public function __construct(){
			
			add_action( 'load-nav-menus.php', array( $this, 'add_meta_box' ) );

		}
		
		public function add_meta_box(){
			
			add_meta_box( 'wolbusinessdesk-id', 'WolBusinessDesk', array( $this, 'wol_menu_callback' ) , 'nav-menus', 'side', 'low' );
		
		}
		
		public function wol_menu_callback(){
			
		
		// Get items from account menu.
		$endpoints = wol()->endpoints->return_end_points();

		// Remove dashboard item.
		if ( isset( $endpoints['dashboard'] ) ) {
			unset( $endpoints['dashboard'] );
		}

		// Include missing lost password.
		//$endpoints['lost-password'] = __( 'Lost password', 'woocommerce' );

		$endpoints = apply_filters( 'woocommerce_custom_nav_menu_items', $endpoints );
		// ! TODO DEBUG DA RIMUOVERE
		echo '<pre>' . print_r( $endpoints , 1 ) . '</pre>';
		?>
		<div id="posttype-woocommerce-endpoints" class="posttypediv">
			<div id="tabs-panel-woocommerce-endpoints" class="tabs-panel tabs-panel-active">
				<ul id="woocommerce-endpoints-checklist" class="categorychecklist form-no-clear">
					<?php
					$i = -1;
					foreach ( $endpoints as $key => $value ) :
						?>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $i ); ?>" /> <?php echo esc_html( $value ); ?>
							</label>
							<input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-type]" value="custom" />
							<input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-title]" value="<?php echo esc_attr( $value ); ?>" />
							<input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-url]" value="<?php //echo esc_url( wc_get_account_endpoint_url( $key ) ); ?>" />
							<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-classes]" />
						</li>
						<?php
						$i--;
					endforeach;
					?>
				</ul>
			</div>
			<p class="button-controls">
				<span class="list-controls">
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&selectall=1#posttype-woocommerce-endpoints' ) ); ?>" class="select-all"><?php esc_html_e( 'Select all', 'woocommerce' ); ?></a>
				</span>
				<span class="add-to-menu">
					<button type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu', 'woocommerce' ); ?>" name="add-post-type-menu-item" id="submit-posttype-woocommerce-endpoints"><?php esc_html_e( 'Add to menu', 'woocommerce' ); ?></button>
					<span class="spinner"></span>
				</span>
			</p>
		</div>
		<?php
	
		}
		
	}
}
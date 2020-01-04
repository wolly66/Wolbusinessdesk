<h1>General Settings</h1>

<?php  $settings = wol_get_cockpit_settings_query(); 
	
	// ! TODO DEBUG DA RIMUOVERE
	//echo '<pre>' . print_r( $settings , 1 ) . '</pre>';
?>

<?php 
	
if ( ! empty( $settings ) ){
	
	foreach ( $settings as $key => $set ){
					
		if ( ! empty( $set ) ) {
			
			echo '<h3>' . $key . '</h3>';
								
			echo '<ul>';
			
			foreach ( $set as $s ){
							
				echo '<li>' . $s->name . '</li>';
							
			}
						
			echo '</ul>';
		}
					
	}
}
				
?>

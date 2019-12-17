<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
	}

if ( ! class_exists( 'Wolbusinessdesk_Company_info' ) ){
	
	class Wolbusinessdesk_Company_info{
		
		public function show_company_fields(){
			
			$html = '';
			if ( isset( $_POST['submit'] ) ) {
				
				$html .=  '<pre>' . print_r( $_POST , 1 ) . '</pre>';
				
				$this->save_company_fields();
			}
			
			$company_fields = $this->company_fields();
			
			$companies_nr = ( ! empty( get_option( 'wol_company_fields_option' ) ) ) ? 
				count( get_option( 'wol_company_fields_option' ) ) :
				'0';
			
			// ! TODO DEBUG DA RIMUOVERE
			$html .= '<pre>' . print_r( get_option( 'wol_company_fields_option' ) , 1 ) . '</pre>';
			$company_id= $companies_nr + 1;
			
			
			
			$html .= '<form name=add_company" action="" method="post">';
			foreach ( $company_fields as $key => $cf ){
				
				$html .= '<label for="' . $key . '">' . $cf['label'] . '</label>';
				
				$html .= '<input id="' . $key . '" type="text" name="company_info[' . $key . ']" value="" />';
				
				
			}
			
			$html .= '<input type="submit" name="submit" value="SUBMIT" />';
			$html .= '</form>';
			return $html;
			
		}
		public function company_fields(){
			
			
			$company_fields = array( 
				
				'name' => array(
					'label' 	=> __( 'Company Name', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				'address' => array(
					'label'	=> __( 'Address', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				'city'	=> array(
					'label'	=> __( 'City', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				'telephone'	=> array(
					'label'	=> __( 'Phone', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				
			);
			
			
			$company_fields = apply_filters( 'wol_company_fields', $company_fields );
			
			
			return $company_fields;
		}
		
		public function client_fields(){
			
			
			$company_fields = array( 
				
				'client_name' => array(
					'label' 	=> __( 'Company Name', 'wolbusinessdesk' ),
					'type'	=> 'title',
				),
				
				'client_address' => array(
					'label'	=> __( 'Address', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				'client_city'	=> array(
					'label'	=> __( 'City', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				'client_telephone'	=> array(
					'label'	=> __( 'Phone', 'wolbusinessdesk' ),
					'type'	=> 'text',
				),
				
				
			);
			
			
			$company_fields = apply_filters( 'wol_client_fields', $company_fields );
			
			
			return $company_fields;
		}

		
		
		public function save_company_fields(){
			
			//  TODO VALIDATION
			
			$company_name = sanitize_title_with_dashes( $_POST['company_info']['name'] );
			$company_fields_option = get_option( 'wol_company_fields_option' );
			$company_fields_option[$company_name] = $_POST['company_info'];
			
			
			update_option( 'wol_company_fields_option', $company_fields_option  );
		}
		
		
	} // END Class
} // END if class exists
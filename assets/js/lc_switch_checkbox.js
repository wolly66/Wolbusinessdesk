  
    jQuery(document).ready(function($) {
        $('input').lc_switch();
    
        // triggered each time a field changes status
        $(document).on('lcs-statuschange', '.lcs_check', function() {
            var status 	= ($(this).is(':checked')) ? 'checked' : 'unchecked',
				subj 	= ($(this).attr('type') == 'radio') ? 'radio #' : 'checkbox #',
				num		= $(this).val(); 
            
			$('#third_div ul').prepend('<li><em>[lcs-statuschange]</em>'+ subj + num +' changed status: '+ status +'</li>');
        });
        
        
        // triggered each time a field is checked
        $(document).on('lcs-on', '.lcs_check', function() {
			var subj 	= ($(this).attr('type') == 'radio') ? 'radio #' : 'checkbox #',
				num		= $(this).val(); 
			
			$('#third_div ul').prepend('<li><em>[lcs-on]</em>'+ subj + num +' is checked</li>');
        });
        
        
        // triggered each time a is unchecked
        $(document).on('lcs-off', '.lcs_check', function() {
            var subj 	= ($(this).attr('type') == 'radio') ? 'radio #' : 'checkbox #',
				num		= $(this).val(); 
			
			$('#third_div ul').prepend('<li><em>[lcs-off]</em>'+ subj + num +' is unchecked</li>');
        });
    });
	
	
	
	// clean events log
	jQuery('#third_div small').click(function() {
		$('#third_div ul').empty();
	});
   
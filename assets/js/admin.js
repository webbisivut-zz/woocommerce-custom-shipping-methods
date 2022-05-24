jQuery(document).ready(function ($) {
	$('#uf_pro_tallenna_avain').click(function() {
        $('.uf_pro_license_loader').show();
        $('.uf_pro_license_checking').show();
        
        var lisenssi = $('#uf_pro_validate_license').val();

        var data = {
			'action': 'uf_pro_validate_license',
			'sendData': lisenssi
		};

		data = $(this).serialize() + '&' + $.param(data);
		$.ajax({
			type: 'POST',
			url: lisenssiAdminAjax.ajaxurl,
			data: data,
			success: function(data) {
                var message = $.parseJSON(data);

                if(message.message == 'success') {
                    $('.uf_pro_license_valid').show();
                    
                    setTimeout(function() {
                        $('.uf_pro_license_valid').fadeOut('fast');

                        location.reload();
                    }, 3000);
                } else if(message.message == 'kaytossa') {
                    $('.uf_pro_license_inuse').show();
                } else {
                    $('.uf_pro_license_invalid').show();
    
                    setTimeout(function() {
                        $('.uf_pro_license_invalid').fadeOut('fast');
                    }, 3000);
                }
                
                $('.uf_pro_license_loader').hide();
                $('.uf_pro_license_checking').hide();
			}
		});
		return false;
    });

    $('#uf_pro_poista_avain').click(function() {
        $('.uf_pro_license_loader').show();
        $('.uf_pro_license_checking').show();
        
        var lisenssi = $('#uf_pro_validate_license').val();

        var data = {
			'action': 'uf_pro_remove_license',
			'sendData': lisenssi
		};

		data = $(this).serialize() + '&' + $.param(data);
		$.ajax({
			type: 'POST',
			url: lisenssiAdminAjax.ajaxurl,
			data: data,
			success: function(data) {
                var message = $.parseJSON(data);

                if(message.message == 'success') {
                    $('.uf_pro_license_poistettu').show();
                    
                    setTimeout(function() {
                        $('.uf_pro_license_poistettu').fadeOut('fast');

                        location.reload(); 
                    }, 3000);
                } else {
                    $('.uf_pro_license_invalid').show();
    
                    setTimeout(function() {
                        $('.uf_pro_license_invalid').fadeOut('fast');
                    }, 3000);
                }
                
                $('.uf_pro_license_loader').hide();
                $('.uf_pro_license_checking').hide();
			}
		});
		return false;
    });

    $('#uf_pro_save_mapping').click(function() {
        $('.uf_pro_mapping_loader').show();

        var methods = document.getElementsByClassName('unifaun_mapping_shipping_methods_class');
        var uf_methods = document.getElementsByClassName('unifaun_mapping_shipping_methods');

        var setMethods = [];

        for(var x=0; x < methods.length; x++) {
            setMethods.push({
                method_id: methods[x].id,
                uf_id: uf_methods[x].value
            });
        }

        var data = {
			'action': 'uf_pro_map_methods',
            'sendData': JSON.stringify(setMethods)
		};

		data = $(this).serialize() + '&' + $.param(data);
		$.ajax({
			type: 'POST',
			url: lisenssiAdminAjax.ajaxurl,
			data: data,
			success: function(data) {
                var message = $.parseJSON(data);

                if(message.message == 'success') {
                    $('.uf_pro_saving_valid').show();
                    
                    setTimeout(function() {
                        $('.uf_pro_saving_valid').fadeOut('fast');
                    }, 3000);
                } else {
                    $('.uf_pro_saving_invalid').show();
    
                    setTimeout(function() {
                        $('.uf_pro_saving_invalid').fadeOut('fast');
                    }, 3000);
                }
                
                $('.uf_pro_mapping_loader').hide();
			}
		});
		return false;
    });
});